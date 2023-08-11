<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    public function wallet_action()
    {
        return $this->hasMany(WalletAction::class);
    }
}
