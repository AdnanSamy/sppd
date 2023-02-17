<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinasTravel extends Model
{
    use HasFactory;

    protected $table = 'dinas_travel';

    public function itemRequest(){
        return $this->hasMany(ItemRequest::class, 'dinas_travel_id');
    }

    // public function itemDinasTravel(){
    //     return $this->hasMany(ItemDinasTravel::class);
    // }
}
