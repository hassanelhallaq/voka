<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletAction extends Model
{
    protected $fillable = ['action_tite', 'amount', 'balance_before', 'wallet_id', 'type'];

    public function action()
    {
        return $this->morphTo();
    }
}
