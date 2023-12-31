<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class BranchAccount extends  Authenticatable
{
    use HasFactory, HasRoles;

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class, ShiftBranch::class)->withTimestamps();
    }
}
