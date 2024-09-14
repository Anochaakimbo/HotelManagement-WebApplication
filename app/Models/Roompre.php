<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roompre extends Model
{
    use HasFactory;
    protected $table = 'room_types'; // ชื่อตารางในฐานข้อมูล

    // ถ้าไม่มีฟิลด์ created_at หรือ updated_at ให้ปิดการทำงาน timestamps
    public $timestamps = false;

}
