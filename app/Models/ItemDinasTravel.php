<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDinasTravel extends Model
{
    use HasFactory;

    protected $table = 'item_dinas_travel';

    public function itemRequest(){
        return $this->hasMany(ItemRequest::class, 'item_dinas_travel_id');
    }
}
