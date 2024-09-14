<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; // ระบุวันที่สำหรับ soft delete
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
