<?php

namespace App\Http\Controllers;

use App\Models\GatewayCurrency;
use App\Models\Wallet;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{
    public function index()
    {
        $page_title = 'Wallets';
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $withdrawals = WithdrawMethod::whereStatus(1)->get();
        return view('user.wallet.index', compact('page_title','gatewayCurrency','withdrawals'));
    }

    public function createWallet(Request $request) {
        $user = Auth::user();
        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->symbol = $request->id;
        $wallet->save();
        $notify[] = ['success', 'Your ' . $wallet->symbol .' Wallet Created Successfully'];
        return back()->withNotify($notify);
    }

    public function admincreateWallet(Request $request) {
        $wallet = new Wallet();
        $wallet->user_id = $request->user_id;
        $wallet->symbol = $request->symbol;
        $wallet->save();
        $notify[] = ['success', 'User ' . $wallet->symbol .' Wallet Created Successfully'];
        return back()->withNotify($notify);
    }
}
