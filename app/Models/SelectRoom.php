<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectRoom extends Model
{
    use HasFactory;

    protected $table = 'rooms'; // ชื่อตาราง

    public $timestamps = false;

    protected $fillable = [
        'room_number',
        'room_type_id', // ตรวจสอบว่าใช้ field นี้ในฐานข้อมูล
        'floor',
        'price',
        'is_available',
    ];

    // สร้างความสัมพันธ์ belongsTo กับ RoomType
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
