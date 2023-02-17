<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    public function user()
    {
        return $this->hasMany(Company::class, 'user_id');
    }

    // public function userRoles(){
    //     return $this->hasMany(UserRole::class);
    // }
}
