<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    public function packages()
    {
        return $this->belongsToMany(Package::class, PackageTables::class);
    }
    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, OrderProduct::class)->withPivot('price', 'quantity');
    // }
    // public function orders()
    // {
    //     return $this->hasManyThrough(OrderProduct::class, Order::class);
    // }
    public function orders()
    {
        return $this->hasMany(Order::class, 'table_id', 'id')->where('is_done', 0);
    }
    public function reservation()
    {
        return $this->hasOne(Reservation::class)->orderByDesc('created_at');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    //     public function reservation()
    //     {
    //         return $this->hasMany(Reservation::class)->latest()->first();
    //     }
}
