<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public function packages()
    {
        return $this->belongsToMany(Package::class, PackageTables::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'id', 'table_id');
    }
}
