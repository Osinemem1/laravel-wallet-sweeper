<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::all();
        return view('wallets', compact('wallets'));
    }

    public function create()
    {
        return view('wallets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|unique:wallets,address',
            'balance' => 'required|numeric|min:0',
            'type' => 'required|in:source,destination,central',
            'private_key' => 'required|string|min:64|max:128', // basic length check for private keys
        ]);

        // Use mass assignment including private_key, which triggers model mutator encryption
        Wallet::create($validated);

        return redirect()->back()->with('success', 'Wallet added successfully.');
    }

    public function edit(Wallet $wallet)
    {
        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        $validated = $request->validate([
            'address' => 'required|unique:wallets,address,' . $wallet->id,
            'balance' => 'nullable|numeric|min:0',
            'type' => 'required|in:source,destination/central',
            'private_key' => 'nullable|string|min:64|max:128', // allow empty if no update needed
        ]);

        // If private_key is null or empty string, exclude it from update to keep old key
        if (empty($validated['private_key'])) {
            unset($validated['private_key']);
        }

        $wallet->update($validated);

        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully.');
    }

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->route('wallets.index')->with('success', 'Wallet deleted successfully.');
    }
}
