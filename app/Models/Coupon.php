<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['id',  'name', 'code', 'coupon_type', 'coupon_discount', 'count_use', 'customer_use', 'is_customer', 'from', 'to', 'branch_id'];

    public function packages()
    {
        return $this->belongsToMany(Package::class, CouponPackage::class);
    }
}
