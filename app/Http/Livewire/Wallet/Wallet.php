<?php

namespace App\Http\Livewire\Wallet;

use App\Models\Wallet as ModelsWallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wallet extends Component
{
    public function render()
    {
        $user = Auth::user();
        $wallets = ModelsWallet::where('user_id', $user->id)->where('balance','!=','0')->orderBy('balance', 'DESC')->take(5)->get();
        return view('livewire.wallet.wallet',compact('wallets'));
    }
}
