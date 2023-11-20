<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the transaction.
     */
    public function account()
    {
        return $this->hasOne(User::class, 'id', 'account_id');
    }

    /**
     * Get the user that owns the transaction.
     */
    public function transaction_account()
    {
        return $this->hasOne(User::class, 'id', 't_account_id');
    }
}
