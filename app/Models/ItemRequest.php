<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;

    protected $table = 'item_dinas_travel';

    protected $fillable = [
        'dinas_travel_id',
        'item_dinas_travel_id',
        'price',
    ];

    public function dinasTravel(){
        return $this->belongsTo(DinasTravel::class, 'dinas_travel_id');
    }

    public function itemDinasTravel(){
        return $this->belongsTo(ItemDinasTravel::class, 'item_dinas_travel_id');
    }
}
