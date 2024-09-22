<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = ['room_description', 'room_price', 'furniture_details', 'deposit_price'];

    use HasFactory;

    protected $table = 'room_types';

    public $timestamps = false;


    public function rooms()
    {
        return $this->hasMany(SelectRoom::class, 'room_type_id');
    }

    public function room()
    {
        return $this->hasMany(rooms::class, 'room_type_id');
    }
}
