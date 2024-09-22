<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectRoom extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    public $timestamps = false;

    protected $fillable = [
        'room_number',
        'room_type_id',
        'floor',
        'price',
        'is_available',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
