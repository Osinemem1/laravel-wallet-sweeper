<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function wallets()
    {
        return view('wallets');
    }

    public function sweepSettings()
    {
        return view('sweep-settings');
    }

    public function payout()
    {
        return view('payout');
    }

    public function transactions()
    {
        return view('transactions');
    }
}
