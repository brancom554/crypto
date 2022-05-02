<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoCurrency;
use App\Models\CryptoPair;
use App\Models\GeneralSetting;
use App\Models\PracticeLog;
use App\Models\Wallet;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PracticeController extends Controller
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
        $user = Auth::user();

		return view('user.contract.index', compact('page_title', 'empty_message'));
	}

    public function trade($symbol, $pair)
    {
        $from = $symbol;
        $to = $pair;
    	$currency = CryptoCurrency::where('symbol', $symbol)->firstOrFail();
    	$pairs = CryptoPair::where('symbol', $pair)->firstOrFail();
    	$page_title = "Trade With " . $currency->symbol;
        $user = Auth::user();

        $contracts = PracticeLog::where('user_id', $user->id)->where('coin_id', $currency->id)->latest()->limit(10)->get();
    	return view('user.contract.trade', compact('page_title', 'currency', 'symbol','contracts','pairs','from','to'));
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
        $general = GeneralSetting::first();
        if($request->amount > $user->practice_balance){
            $response = [
                'value'         => 2,
                'message' => 'Your Practice Balance '.getAmount($user->practice_balance) . ' ' . $general->cur_text .' Not Enough! Please Add Practice Amount',
            ];
            return response()->json($response);
        }
        $user->practice_balance -= $request->amount;
        $user->save();
        if ($request->highlow == 1) {
            $highlow = 'High';
        }else{
            $highlow = 'Low';
        }
        $practiceLog = new PracticeLog();
        $practiceLog->user_id = $user->id;
        $practiceLog->coin_id = $request->coinId;
        $practiceLog->amount = $request->amount;
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
        $practiceLog->duration = $duration;
        $practiceLog->in_time = $time;
        $practiceLog->hilow = $request->highlowType;
        $practiceLog->price_was = getCoinRate($crypto->symbol);
        $practiceLog->save();
        $response = [
            'tradeLogId' => $practiceLog->id,
            'value'     => 1,
            'trade'     => $practiceLog->price_was,
        ];
        return response()->json($response);
    }

    public function tradeResult(Request $request)
    {
    	$validate = Validator::make($request->all(), [
            'tradeLogId' => 'required|exists:practice_logs,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $user = Auth::user();
        $practiceLog = PracticeLog::where('id', $request->tradeLogId)->where('user_id', $user->id)->firstOrFail();
        $gnl = GeneralSetting::first();
        $cryptoRate = getCoinRate($practiceLog->crypto->symbol);
        // Read File
        if (!file_exists(public_path('data/practice/u00'.$user->id.'.json'))) {
            $json_data = '{"'.$user->id.'": {"1": []}}';
            file_put_contents(public_path('data/practice/u00'.$user->id.'.json'), $json_data);
        }
        $jsonString = file_get_contents(public_path('data/practice/u00'.$user->id.'.json'));
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
        file_put_contents(public_path('data/practice/u00'.$user->id.'.json'), stripslashes($newJsonString));
        if($practiceLog->result == 0)
        {
            if($practiceLog->hilow == 1)
            {
                if($practiceLog->price_was < $cryptoRate)
                {
                    $user->practice_balance += $practiceLog->amount + (($practiceLog->amount / 100) * $gnl->profit);
                    $user->save();

                    $practiceLog->result = 1;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 1;
                }
                else if($practiceLog->price_was > $cryptoRate)
                {
                    $practiceLog->result = 2;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 2;
                }
                else{
                    $user->practice_balance += $practiceLog->amount;
                    $user->save();

                    $practiceLog->result = 3;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 3;
                }
            }
            else if($practiceLog->hilow == 2)
            {
                if($practiceLog->price_was > $cryptoRate)
                {
                    $user->practice_balance += $practiceLog->amount + (($practiceLog->amount / 100) * $gnl->profit);
                    $user->save();

                    $practiceLog->result = 1;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 1;
                }
                else if ($practiceLog->price_was < $cryptoRate) {
                    $practiceLog->result = 2;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 2;
                }else{
                    $user->practice_balance += $practiceLog->amount;
                    $user->save();

                    $practiceLog->result = 3;
                    $practiceLog->status = 1;
                    $practiceLog->save();
                    return 3;
                }
            }
        }
    }

    public function practiceLog()
    {
        $user = Auth::user();

        $page_title = "Practice Trade History";
        $empty_message = "No Data Found";
        $contracts = PracticeLog::where('user_id', $user->id)->latest()->paginate(getPaginate());
        return view('user.contract.log', compact('page_title', 'empty_message','contracts'));
    }
    public function practiceLogChart($tradeLogId)
    {
        $user = Auth::user();

        $page_title = "Practice Trade Preview";
        $empty_message = "No Data Found";
        $contract = PracticeLog::where('id', $tradeLogId)->where('user_id', $user->id)->firstOrFail();
        $jsonString = file_get_contents(public_path('data/practice/u00'.$user->id.'.json'));
        $datas = json_decode($jsonString, true);
        $data = $datas[$user->id][$tradeLogId];
        $duration = Carbon::parse($contract->in_time)
                            ->addSeconds($contract->duration)
                            ->format('Y-m-d H:i:s');
        return view('user.contract.preview', compact('page_title', 'empty_message', 'contract','data','tradeLogId','duration'));
    }

}
