<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Jobs\SweepWalletJob;

class SweepController extends Controller
{
    public function sweep(Wallet $fromWallet, Wallet $toWallet, string $tokenContractAddress, float $amount)
    {
        // Here you call sendToken and return the tx hash
        return $this->sendToken($fromWallet, $toWallet->address, $amount, $tokenContractAddress);
    }
}
