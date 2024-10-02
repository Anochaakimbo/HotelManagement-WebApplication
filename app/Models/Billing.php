<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes; // ใช้ SoftDeletes trait

    protected $fillable = [
        'room_id', 'user_id', 'water_units', 'electric_units', 'room_price', 'water_charge', 'electric_charge', 'total_charge', 'status', 'billing_date'
    ];

    protected $dates = ['deleted_at', 'billing_date']; // ระบุวันที่สำหรับ soft delete และ billing date

    public function room()
    {
        return $this->belongsTo(rooms::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
