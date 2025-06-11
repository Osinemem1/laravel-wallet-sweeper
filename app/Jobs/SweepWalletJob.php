<?php

namespace App\Jobs;

use App\Models\Wallet;
use App\Services\CryptoService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SweepWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function handle(CryptoService $cryptoService)
    {
        Log::info('SweepWalletJob START for wallet ID: ' . $this->wallet->id);

        try {
            $centralWallet = Wallet::where('type', 'central')->first();

            if (!$centralWallet) {
                Log::error('No central wallet found. Aborting sweep.');
                return;
            }

            // You’ll need to know the token contract address and amount to sweep
            $tokenContractAddress = '0xdAC17F958D2ee523a2206206994597C13D831ec7'; // Example: USDT ERC20 contract
            $amount = $this->wallet->balance; // or fetch actual token balance on-chain

            if ($amount <= 0) {
                Log::warning('Source wallet ID ' . $this->wallet->id . ' has zero or negative balance. Skipping sweep.');
                return;
            }

            Log::info("Sweeping from wallet ID {$this->wallet->id} to central wallet ID {$centralWallet->id}");

            $txHash = $cryptoService->sweep($this->wallet, $centralWallet, $tokenContractAddress, $amount);

            Log::info('SweepWalletJob DONE for wallet ID: ' . $this->wallet->id . ' TxHash: ' . $txHash);
        } catch (\Exception $e) {
            Log::error('SweepWalletJob FAILED for wallet ID: ' . $this->wallet->id . ' with error: ' . $e->getMessage());
            throw $e;
        }
    }
}
