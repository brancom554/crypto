<?php

namespace App\Http\Livewire\Wallet;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PracticeWallet extends Component
{
    protected $listeners = ['walletUpdated' => '$refresh'];
    public function render()
    {
        $user = Auth::user();
        $balance = number_format($user->balance, 2);
        $practice_balance = number_format($user->practice_balance, 2);
        $practice_balance_btc = $user->practice_balance_btc;
        $practice_balance_total = number_format($user->practice_balance + ($user->practice_balance_btc * getCoinRate('BTC')) , 2);
        return view('livewire.wallet.practice-wallet', compact('balance','practice_balance','practice_balance_btc','practice_balance_total'));
    }
}
