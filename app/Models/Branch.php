<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Branch extends Model
{
    use HasFactory;

    public function lounges()
    {
        return $this->hasMany(Lounge::class);
    }
    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Table::class, 'table_id', 'branch_id');
    }
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
