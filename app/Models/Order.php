<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class, 'order_id', 'product_id')->withPivot('price', 'quantity');
    }
}
