<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = ['room_description', 'room_price', 'furniture_details', 'deposit_price'];
    public function rooms()
    {
        return $this->hasMany(rooms::class);
    }
}
