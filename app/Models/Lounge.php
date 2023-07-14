<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    use HasFactory;

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
