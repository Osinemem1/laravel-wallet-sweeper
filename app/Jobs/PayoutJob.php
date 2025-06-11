<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\CryptoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayoutJob implements ShouldQueue
{
          use InteractsWithQueue, Queueable, SerializesModels;

          protected $transaction;

          public function __construct(Transaction $transaction)
          {
                    $this->transaction = $transaction;
          }

          public function handle(CryptoService $cryptoService)
          {
                    $result = $cryptoService->sendUSDT(
                              $this->transaction->to_wallet_address,
                              $this->transaction->amount
                    );

                    $this->transaction->update([
                              'tx_hash' => $result['hash'],
                              'status' => $result['status'],
                              'fee' => $result['fee'],
                    ]);
          }
}
