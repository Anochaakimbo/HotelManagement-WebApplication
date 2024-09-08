<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['guest_id', 'room_id', 'status'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    // Relationship with Room
    public function room()
    {
        return $this->belongsTo(rooms::class);
    }
}
