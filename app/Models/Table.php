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
    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderProduct::class, 'product_id', 'order_id')->withPivot('price', 'quantity');
    }
    // public function reservation()
    // {
    //     return $this->belongsTo(Reservation::class, 'id', 'table_id');
    // }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class)->orderBy('created_at','desc')->first();
    }
}
