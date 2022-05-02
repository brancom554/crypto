<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoCurrency;
use App\Models\CryptoPair;
use App\Models\TradeSetting;
use App\Models\TradeLog;
use App\Models\Transaction;
use App\Models\GeneralSetting;
use App\Models\Wallet;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{

    public function btcRate(Request $request)
    {
        $cryptoRate = getCoinRate($request->coinSymbol);
        return $cryptoRate;
    }

	public function index()
	{
		$page_title = "Trade Now";
		$empty_message = "No Data Found";
		$cryptos = CryptoCurrency::where('status', 1)->paginate(getPaginate());
        $user = Auth::user();

        $watched= Watchlist::where('user_id', $user->id)->pluck('symbol')->toArray();
		return view('user.contract.index', compact('page_title', 'empty_message', 'cryptos','watched'));
	}

    public function trade($symbol, $pair)
    {
    	$empty_message = "No Data Found";
    	$currency = CryptoCurrency::where('symbol', $symbol)->firstOrFail();
        $pairs = CryptoPair::where('symbol', $pair)->firstOrFail();
    	$page_title = "Trade With " . $currency->symbol;
        $user = Auth::user();

        $contracts = TradeLog::where('user_id', $user->id)->where('coin_id', $currency->id)->latest()->limit(10)->get();
    	return view('user.contract.trade', compact('page_title', 'empty_message', 'currency', 'symbol','contracts','pairs'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
            'coinId' => 'required|exists:crypto_currencies,id',
            'highlowType' => 'required|in:1,2'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $crypto = CryptoCurrency::find($request->coinId);
        $user = Auth::user();
        $wallet = Wallet::where('user_id',$user->id)->where('symbol','USDT')->first();
        $general = GeneralSetting::first();
        if($request->amount > $wallet->balance){
            $response = [
                'value'         => 2,
                'message' => 'Your Account Balance '.getAmount($wallet->balance) . ' ' . $general->cur_text .' Not Enough! Please Deposit Money',
            ];
            return response()->json($response);
        }
        $wallet->balance -= $request->amount;
        $wallet->save();
        if ($request->highlow == 1) {
            $highlow = 'High';
        }else{
            $highlow = 'Low';
        }
        $tradeLog = new TradeLog();
        $tradeLog->user_id = $user->id;
        $tradeLog->coin_id = $request->coinId;
        $tradeLog->amount = $request->amount;
        if($request->unit == "seconds")
        {
            $time = Carbon::now()->addSeconds($request->duration);
            $duration = $request->duration;
        }
        elseif($request->unit == "minutes")
        {
            $time = Carbon::now()->addMinutes($request->duration);
            $duration = $request->duration * 60;
        }
        /*elseif($request->unit == "hours")
        {
            $time = Carbon::now()->addHours($request->duration);
            $duration = $request->duration * 60 * 60;
        }*/
        $tradeLog->duration = $duration;
        $tradeLog->in_time = $time;
        $tradeLog->hilow = $request->highlowType;
        $tradeLog->price_was = getCoinRate($crypto->symbol);
        $tradeLog->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $tradeLog->amount;
        $transaction->post_balance = $wallet->balance;
        $transaction->trx_type = "-";
        $transaction->details = 'Trade ' . $crypto->name . ' ' . $highlow;
        $transaction->trx = getTrx();
        $transaction->save();
        $response = [
            'tradeLogId' => $tradeLog->id,
            'value'     => 1,
            'trade'     => $tradeLog->price_was,
        ];
        return response()->json($response);
    }

    public function tradeResult(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tradeLogId' => 'required|exists:trade_logs,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $user = Auth::user();
        $wallet = Wallet::where('user_id',$user->id)->where('symbol','USDT')->first();
        $gnl = GeneralSetting::first();
        $tradeLog = TradeLog::where('id', $request->tradeLogId)->where('user_id', $user->id)->firstOrFail();
        $cryptoRate = getCoinRate($tradeLog->crypto->symbol);
        // Read File
        if (!file_exists(public_path('data/trade/u00'.$user->id.'.json'))) {
            $json_data = '{"'.$user->id.'": {"1": []}}';
            file_put_contents(public_path('data/trade/u00'.$user->id.'.json'), $json_data);
        }
        $jsonString = file_get_contents(public_path('data/trade/u00'.$user->id.'.json'));
        $datas = json_decode($jsonString, true);
        // Update Key
        $i=0;
        foreach($request->obj as $obj) {
            foreach($datas as $data) {
                $datas[$user->id][$request->tradeLogId][] = [
                'time' => $request->obj[$i]['time'],
                'value' => $request->obj[$i]['value'],
                ];
                $i++;
            }
        }
        // Write File
        $newJsonString = json_encode($datas, JSON_PRETTY_PRINT);
        file_put_contents(public_path('data/trade/u00'.$user->id.'.json'), stripslashes($newJsonString));
        if($tradeLog->result == 0)
        {
            if($tradeLog->hilow == 1)
            {
                if($tradeLog->price_was < $cryptoRate)
                {
                    $wallet->balance += $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                    $wallet->save();

                    $details = "Trade " . $tradeLog->crypto->name . ' ' . "WIN";
                    $tradeLogAmount = $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                    $this->transactions($wallet, $tradeLogAmount, $details);

                    $tradeLog->result = 1;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 1;
                }
                else if($tradeLog->price_was > $cryptoRate)
                {
                    $tradeLog->result = 2;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 2;
                }
                else{
                    $wallet->balance += $tradeLog->amount;
                    $wallet->save();

                    $details = "Trade " . $tradeLog->crypto->name . ' ' .  "Refund";
                    $tradeLogAmount = $tradeLog->amount;
                    $this->transactions($wallet, $tradeLogAmount, $details);
                    $tradeLog->result = 3;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 3;
                }
            }
            else if($tradeLog->hilow == 2)
            {
                if($tradeLog->price_was > $cryptoRate)
                {
                    $wallet->balance += $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                    $wallet->save();

                    $details = "Trade " . $tradeLog->crypto->name . ' ' . "WIN";
                    $tradeLogAmount = $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                    $this->transactions($wallet, $tradeLogAmount, $details);

                    $tradeLog->result = 1;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 1;
                }
                else if ($tradeLog->price_was < $cryptoRate) {
                    $tradeLog->result = 2;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 2;
                }else{
                    $wallet->balance += $tradeLog->amount;
                    $wallet->save();

                    $details = "Trade " . $tradeLog->crypto->name . ' ' .  "Refund";
                    $tradeLogAmount = $tradeLog->amount;
                    $this->transactions($wallet, $tradeLogAmount, $details);

                    $tradeLog->result = 3;
                    $tradeLog->status = 1;
                    $tradeLog->save();
                    return 3;
                }
            }
        }

    }

    public function tradeContract()
    {
        $user = Auth::user();

        $page_title = "Trade History";
        $empty_message = "No Data Found";
        $contracts = TradeLog::where('user_id', $user->id)->latest()->paginate(getPaginate());
        return view('user.contract.log', compact('page_title', 'empty_message','contracts'));
    }

    public function ContractChart($tradeLogId)
    {
        $user = Auth::user();

        $page_title = "Trade Preview";
        $empty_message = "No Data Found";
        $contract = TradeLog::where('id', $tradeLogId)->where('user_id', $user->id)->firstOrFail();
        $jsonString = file_get_contents(public_path('data/trade/u00'.$user->id.'.json'));
        $datas = json_decode($jsonString, true);
        $data = $datas[$user->id][$tradeLogId];
        $duration = Carbon::parse($contract->in_time)
                            ->addSeconds($contract->duration)
                            ->format('Y-m-d H:i:s');
        return view('user.contract.preview', compact('page_title', 'empty_message', 'contract','data','tradeLogId','duration'));
    }

    public function winingTradeContract()
    {
        $user = Auth::user();

        $page_title = "Wining Trade History";
        $empty_message = "No Data Found";
        $contracts = TradeLog::where('user_id', $user->id)->where('result', 1)->latest()->paginate(getPaginate());
        return view('user.contract.log', compact('page_title', 'empty_message', 'contracts'));
    }

    public function losingTradeContract()
    {
        $user = Auth::user();

        $page_title = "Losing Trade History";
        $empty_message = "No Data Found";
        $contracts = TradeLog::where('user_id', $user->id)->where('result', 2)->latest()->paginate(getPaginate());
        return view('user.contract.log', compact('page_title', 'empty_message', 'contracts'));
    }

    public function drawTradeContract()
    {
        $user = Auth::user();

        $page_title = "Draw Trade History";
        $empty_message = "No Data Found";
        $contracts = TradeLog::where('user_id', $user->id)->where('result', 3)->latest()->paginate(getPaginate());
        return view('user.contract.log', compact('page_title', 'empty_message', 'contracts'));
    }

    private function transactions($wallet, $tradeLogAmount, $details)
    {
        $transaction = new Transaction();
        $transaction->user_id = $wallet->user_id;
        $transaction->amount = $tradeLogAmount;
        $transaction->post_balance = $wallet->balance;
        $transaction->trx_type = "+";
        $transaction->details = $details;
        $transaction->trx = getTrx();
        $transaction->save();
    }

}
