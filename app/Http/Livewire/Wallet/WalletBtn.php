<?php

namespace App\Http\Livewire\Wallet;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WalletBtn extends Component
{
    public function render()
    {
        return view('livewire.wallet.wallet-btn');
    }
}
