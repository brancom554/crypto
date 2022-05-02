<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoCurrency;
use App\Models\CryptoPair;
use App\Models\ExchangeLogs;
use App\Models\GeneralSetting;
use App\Models\KYC;
use App\Models\PracticeLog;
use App\Models\Wallet;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{

	public function btcRate(Request $request)
    {
	    $cryptoRate = getCoinRate($request->coinSymbol);
	    return $cryptoRate;
    }

    public function home(Request $request)
    {
        $page_title = 'Exchange Dashboard';
        $user = Auth::user();
        $user_kyc = KYC::where('userId', $user->id)->first();
        if(Wallet::where('user_id', $user->id)->sum('balance') > 0){
            $wallets = Wallet::where('user_id', $user->id)->where('balance','!=','0')->get();

        } else {
            $wallets = Wallet::where('user_id', $user->id)->get();
        }
        $exchanges = ExchangeLogs::where('user_id', $user->id)->get();

        return view('user.dashboard.exchange', compact('page_title', 'user','user_kyc', 'exchanges','wallets'));
    }

	public function index()
	{
		$page_title = "Exchange Now";
		$empty_message = "No Data Found";
        $user = Auth::user();
		return view('user.contract.index', compact('page_title', 'empty_message'));
	}

    public function exchange($symbol, $pair)
    {
        $user = Auth::user();
        $from = $symbol;
        $to = $pair;
        if(Wallet::where('user_id', $user->id)->where('symbol', $symbol)->exists()){
            $fromW = Wallet::where('user_id', $user->id)->where('symbol', $symbol)->first();
            $from_balance = getAmount($fromW->balance);
        } else {
            $fromW = '0';
            $from_balance = 'Wallet Dont Exist';
        }
        if(Wallet::where('user_id', $user->id)->where('symbol', $pair)->exists()){
            $toW = Wallet::where('user_id', $user->id)->where('symbol', $pair)->first();
            $to_balance = getAmount($toW->balance);
        } else {
            $toW = '0';
            $to_balance = 'Wallet Dont Exist';
        }
    	$currency = CryptoCurrency::where('symbol', $symbol)->firstOrFail();
    	$pairs = CryptoPair::where('symbol', $pair)->firstOrFail();
    	$page_title = "Exchange With " . $currency->symbol;

        $contracts = ExchangeLogs::where('user_id', $user->id)->where('from', $currency->symbol)->latest()->limit(10)->get();
    	return view('user.contract.exchange', compact('page_title', 'currency', 'symbol','contracts','pairs','from','to','from_balance','to_balance','fromW','toW'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
    		'amount' => 'required|numeric'
    	]);
        $user = Auth::user();
        $fee = (GeneralSetting::first()->exchange_fee / 100) * $request->amount;
        if(Wallet::where('user_id', $user->id)->where('symbol', $request->to)->exists()){
            if(Wallet::where('user_id', $user->id)->where('symbol', $request->from)->exists()){
                if($request->type == '1') {
                    $toW = Wallet::where('user_id', $user->id)->where('symbol', $request->from)->first();
                    $fromW = Wallet::where('user_id', $user->id)->where('symbol', $request->to)->first();
                    if(($request->amount * getCoinRate($toW->symbol)) > ($fromW->balance * getCoinRate($fromW->symbol) ) ){
                        $notify[] = ['warning', 'Your ' . $fromW->symbol .' Balance Not Enough! Please Add Deposit Firstly'];
                        return back()->withNotify($notify);
                    } else {
                        $toW->balance += $request->amount ;
                        $toW->save();
                        $fromW->balance -= ($request->amount + $fee) * (getCoinRate($toW->symbol) / getCoinRate($fromW->symbol));
                        $fromW->save();
                        $exchangeLog = new ExchangeLogs();
                        $exchangeLog->user_id = $user->id;
                        $exchangeLog->from = $fromW->symbol;
                        $exchangeLog->to = $toW->symbol;
                        $exchangeLog->amount_from = $request->amount;
                        $exchangeLog->price_was = getCoinRate($toW->symbol);
                        $exchangeLog->status = '1';
                        $exchangeLog->type = '1';
                        $exchangeLog->save();
                        $notify[] = ['success', 'You Bought ' .$request->amount.' '. $toW->symbol .' Successfully'];
                        return back()->withNotify($notify);
                    }
                } else {
                    $toW = Wallet::where('user_id', $user->id)->where('symbol', $request->to)->first();
                    $fromW = Wallet::where('user_id', $user->id)->where('symbol', $request->from)->first();
                    if($request->amount > $fromW->balance){
                        $notify[] = ['warning', 'Your ' . $fromW->symbol .' Balance Is Not Enough! Please Add Deposit Firstly'];
                        return back()->withNotify($notify);
                    } else {
                        $toW->balance += $request->amount * (getCoinRate($fromW->symbol) / getCoinRate($toW->symbol));
                        $toW->save();
                        $fromW->balance -= $request->amount + $fee;
                        $fromW->save();
                        $exchangeLog = new ExchangeLogs();
                        $exchangeLog->user_id = $user->id;
                        $exchangeLog->from = $fromW->symbol;
                        $exchangeLog->to = $toW->symbol;
                        $exchangeLog->amount_from = $request->amount;
                        $exchangeLog->price_was = getCoinRate($fromW->symbol);
                        $exchangeLog->status = '1';
                        $exchangeLog->type = '2';
                        $exchangeLog->save();
                        $notify[] = ['success', 'You Sold ' .$request->amount.' '. $fromW->symbol .' Successfully'];
                        return back()->withNotify($notify);
                    }
                }
            } else {
                $fromW = new Wallet();
                $fromW->user_id = $user->id;
                $fromW->symbol = $request->from;
                $fromW->save();
                $notify[] = ['warning', 'Your ' . $fromW->symbol .' Balance '.getAmount($fromW->balance) .' Not Enough! Please Add Deposit Firstly'];
                return back()->withNotify($notify);
            }
        } else {
            $toW = new Wallet();
            $toW->user_id = $user->id;
            $toW->symbol = $request->to;
            $toW->save();
            $notify[] = ['success', 'Your ' . $toW->symbol .' Wallet Created Successfully'];
            return back()->withNotify($notify);
        }
    }

    public function exchangeLog()
    {
        $user = Auth::user();

        $exchanges = ExchangeLogs::where('user_id', $user->id)->get();
        $page_title = "Practice Trade History";
        $empty_message = "No Data Found";
        return view('user.contract.log', compact('page_title', 'empty_message','exchanges'));
    }

}
