<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, Order::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function reservation()
    {
        return $this->hasOne(Reservation::class)->latest();;
    }
}
