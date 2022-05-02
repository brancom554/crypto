<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\User;
use App\Models\WithdrawMethod;
use App\Models\Withdrawal;
use App\Models\TradeLog;
use App\Models\KYC;
use App\Models\PracticeLog;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Validator;
use App\Mail\EmailToUser;
use App\Models\Wallet;
use App\Notifications\BalanceAdmin;
use App\Notifications\Withdraw;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Lin\Binance\Binance;
use \Lin\Binance\BinanceWebSocket;

class UserController extends Controller
{
    public function __construct()
    {

    }
    public function market()
    {
        $page_title = 'Dashboard';
        $user = Auth::user();
        return view('user.market', compact('page_title', 'user'));
    }
    public function marketr()
    {
        /*$user = Auth::user();
        $route = get_setting('dash_route');
        if($user){
            if(KYC::where('userId',$user->id)->exists()){
                $status = KYC::where('userId',$user->id)->first();
                if ($status->status == 'approved') {
                    return redirect()->route('user.'.$route.'.market');
                } else {
                    return redirect()->route('user.'.$route.'.market');
                }
            } else {
                return redirect()->route('user.'.$route.'.market');
            }
        }*/
        return redirect()->route('user.practice.market');
    }
    public function home()
    {
        /*$user = Auth::user();
        $route = get_setting('dash_route');
        if($user){
            if(KYC::where('userId',$user->id)->exists()){
                $status = KYC::where('userId',$user->id)->first();
                if ($status->status == 'approved') {
                    return redirect()->route('user.home.'.$route);
                } else {
                    return redirect()->route('user.home.practice');
                }
            } else {
                return redirect()->route('user.home.practice');
            }
        }*/
        return redirect()->route('user.home.practice');
    }

    public function dash()
    {
        $page_title = 'Dashboard';
        $user = Auth::user();
        $user_kyc = KYC::where('userId', $user->id)->first();
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        $deposit = auth()->user()->deposits()->sum('amount');
        $withdraw = Withdrawal::where('user_id', $user->id)->where('status', '!=', 0)->sum('amount');
        $transaction = auth()->user()->transactions()->count();
        $tradeWon = TradeLog::where('user_id', $user->id)->where('result', 1)->sum('amount');
        $tradeLog = TradeLog::where('user_id', $user->id)->count();
        $tradeWin = TradeLog::where('user_id', $user->id)->where('result', 1)->count();
        $tradeLose = TradeLog::where('user_id', $user->id)->where('result', 2)->count();
        $tradeDraw = TradeLog::where('user_id', $user->id)->where('result', 3)->count();
        $perc['tradeWon_last_week'] = TradeLog::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('result', 1)->sum('amount');
        if($tradeWin > 0) {
            $perc['tradeWon_last_week_percentage'] = $perc['tradeWon_last_week'] > 0 ? ceil((($perc['tradeWon_last_week']) * 100) / $tradeWin) : 0;
        } else {
            $perc['tradeWon_last_week_percentage'] = 0;
        }
        $tradelogs = TradeLog::where('user_id', $user->id)->latest()->limit(10)->get();
        return view('user.dashboard', compact('page_title','user_kyc','perc', 'user','tradeWon' , 'deposit', 'withdraw', 'transaction', 'tradeLog', 'tradeWin', 'tradeLose', 'tradeDraw', 'tradelogs'));
    }
    public function practiceDash(Request $request)
    {
        $page_title = 'Dashboard';
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        $user = Auth::user();
        $user_kyc = KYC::where('userId', $user->id)->first();
        $deposit = auth()->user()->deposits()->sum('amount');
        $withdraw = Withdrawal::where('user_id', $user->id)->where('status', '!=', 0)->sum('amount');
        $transaction = auth()->user()->transactions()->count();
        $tradeWon = PracticeLog::where('user_id', $user->id)->where('result', 1)->sum('amount');
        $tradeLog = PracticeLog::where('user_id', $user->id)->count();
        $tradeWin = PracticeLog::where('user_id', $user->id)->where('result', 1)->count();
        $tradeLose = PracticeLog::where('user_id', $user->id)->where('result', 2)->count();
        $tradeDraw = PracticeLog::where('user_id', $user->id)->where('result', 3)->count();
        $tradelogs = PracticeLog::where('user_id', $user->id)->latest()->limit(10)->get();
        $perc['tradeWon_last_week'] = PracticeLog::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('result', 1)->sum('amount');
        if($tradeWin > 0) {
            $perc['tradeWon_last_week_percentage'] = $perc['tradeWon_last_week'] > 0 ? ceil((($perc['tradeWon_last_week']) * 100) / $tradeWin) : 0;
        } else {
            $perc['tradeWon_last_week_percentage'] = 0;
        }
        return view('user.dashboard', compact('page_title', 'user','perc','user_kyc', 'deposit','tradeWon' , 'tradeLog', 'tradeWin', 'tradeLose', 'tradeDraw', 'tradelogs', 'withdraw', 'transaction'));
    }

    public function send_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ], [
            'user_id.required' => __('Select a user first!'),
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                $msg = $validator->errors()->first();
            } else {
                $msg = __('messages.somthing_wrong');
            }

            $ret['msg'] = 'warning';
            $ret['message'] = $msg;
        } else {
            $user = User::FindOrFail($request->input('user_id'));

            if ($user) {
                $msg = $request->input('message');
                $msg = replace_with($msg, '[[user_name]]', $user->name);
                $data = (object) [
                    'user' => (object) ['name' => $user->name, 'email' => $user->email],
                    'subject' => $request->input('subject'),
                    'greeting' => $request->input('greeting'),
                    'text' => str_replace("\n", "<br>", $msg),
                ];
                $when = now()->addMinutes(2);

                try {
                    Mail::to($user->email)
                    ->later($when, new EmailToUser($data));
                    $ret['msg'] = 'success';
                    $ret['message'] = __('messages.mail.send');
                } catch (\Exception $e) {
                    $ret['errors'] = $e->getMessage();
                    $ret['msg'] = 'warning';
                    $ret['message'] = __('messages.mail.issues');
                }
            } else {
                $ret['msg'] = 'warning';
                $ret['message'] = __('messages.mail.failed');
            }

            if ($request->ajax()) {
                return response()->json($ret);
            }
            return back()->with([$ret['msg'] => $ret['message']]);
        }
    }

    public function addPracticeBalance()
    {
        $gnl = GeneralSetting::first();
        $user = Auth::user();
        $user->practice_balance = $gnl->practice_balance;
        $user->save();
        $notify[] = ['success','Practice Balance Add Successfully'];
        return back()->withNotify($notify);
    }

    /*
     * transaction History
     */
    public function transactionHistory()
    {
        $page_title = 'Transactions History';
        $empty_message = 'No transaction found.';
        $transactions = auth()->user()->transactions()->latest()->paginate(getPaginate());
        return view('user.transaction', compact('page_title', 'empty_message', 'transactions'));
    }


    public function commissions()
    {
        $user = Auth::user();
        $page_title = 'Commission History';
        $empty_message = 'No Commission found.';
        $commissions =Commission::where('user_id', $user->id)->latest()->paginate(getPaginate());
        return view('user.commissions', compact('page_title', 'empty_message', 'commissions'));
    }

    public function referralog()
    {
        $user = Auth::user();
        $page_title = 'Referral Log';
        $empty_message = 'No Referral User';
        $referrals = User::where('ref_by', $user->id)->latest()->paginate(getPaginate());
        return view('user.referral', compact('page_title', 'empty_message', 'referrals'));
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No history found.';
        $logs = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        return view('user.deposit_history', compact('page_title', 'empty_message', 'logs'));
    }
    /*
     * Withdraw Operation
     */
    public function withdrawMoney()
    {
        $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
        $data['page_title'] = "Withdraw Money";
        return view('user.withdraw.methods', $data);
    }

    public function withdrawStore(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        $wallet = Wallet::where('user_id',$user->id)->where('symbol','USDT')->first();
        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your Requested Amount is Smaller Than Minimum Amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your Requested Amount is Larger Than Maximum Amount.'];
            return back()->withNotify($notify);
        }

        if ($request->amount > $wallet->balance) {
            $notify[] = ['error', 'Your do not have Sufficient Balance For Withdraw.'];
            return back()->withNotify($notify);
        }

        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = getAmount($afterCharge * $method->rate);

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id;
        $withdraw->user_id = $user->id;
        $withdraw->amount = getAmount($request->amount);
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('user.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $data['withdraw'] = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->latest()->firstOrFail();
        $data['page_title'] = "Withdraw Preview";
        return view('user.withdraw.preview', $data);
    }


    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->latest()->firstOrFail();
        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        $this->validate($request, $rules);
        $user = Auth::user();
        $wallet = Wallet::where('user_id',$user->id)->where('symbol','USDT')->first();

        if (getAmount($withdraw->amount) > $wallet->balance) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Your Current Balance.'];
            return back()->withNotify($notify);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }

        $withdraw->status = 2;
        $withdraw->save();
        $wallet->balance  -=  $withdraw->amount;
        $wallet->save();

        if ($wallet->save()) {
            $transaction = new Transaction();
            $transaction->user_id = $withdraw->user_id;
            $transaction->amount = getAmount($withdraw->amount);
            $transaction->post_balance = getAmount($wallet->balance);
            $transaction->charge = getAmount($withdraw->charge);
            $transaction->trx_type = '-';
            $transaction->details = getAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
            $transaction->trx =  $withdraw->trx;
            $transaction->save();
            $transaction->user->notify((new Withdraw($transaction, $withdraw, 'user-requested')));
        }

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New withdraw request from '.$user->username;
        $adminNotification->click_url = route('admin.withdraw.details',$withdraw->id);
        $adminNotification->save();

        $notify[] = ['success', 'Withdraw Request Successfully Send'];
        return redirect()->route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->latest()->paginate(getPaginate());
        $data['empty_message'] = "No Data Found!";
        return view('user.withdraw.log', $data);
    }
}
