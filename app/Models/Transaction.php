<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['wallet_id', 'tx_hash', 'direction', 'amount', 'status', 'error_message'];
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
