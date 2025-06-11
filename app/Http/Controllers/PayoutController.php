<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\CryptoService;
use App\Jobs\PayoutJob;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Transaction::where('type', 'payout')->latest()->get();
        return view('payouts.index', compact('payouts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $tx = Transaction::create([
            'from_wallet_id' => null, // can be filled in after sending
            'to_wallet_address' => $validated['recipient'],
            'amount' => $validated['amount'],
            'status' => 'pending',
            'type' => 'payout',
        ]);

        // Dispatch async payout
        PayoutJob::dispatch($tx);

        return redirect()->back()->with('success', 'Payout initiated and queued.');
    }

    public function show($id)
    {
        $tx = Transaction::findOrFail($id);
        return view('payouts.show', compact('tx'));
    }
}
