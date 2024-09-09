<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'capacity',
        'description',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
public function billings()
{
    return $this->hasMany(Billing::class, 'room_id');
}
public function roomType()
{
    return $this->belongsTo(RoomType::class, 'room_type_id');
}
}