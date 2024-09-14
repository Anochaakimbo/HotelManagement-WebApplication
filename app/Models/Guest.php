<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; // ระบุวันที่สำหรับ soft delete

    protected $fillable = ['name', 'email', 'phone'];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
