<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
