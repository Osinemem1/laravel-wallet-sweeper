<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'type',
        'balance',
        'private_key', // this is used by mutator below
    ];

    // This mutator encrypts the private key and stores it in the DB
    public function setPrivateKeyAttribute($value)
    {
        $this->attributes['private_key_encrypted'] = encrypt($value);
    }

    // This accessor allows $wallet->private_key to return decrypted value
    public function getPrivateKeyAttribute()
    {
        return isset($this->attributes['private_key_encrypted'])
            ? decrypt($this->attributes['private_key_encrypted'])
            : null;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }





}
