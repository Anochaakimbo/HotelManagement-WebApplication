<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class rooms extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'room_number',
        'description',
    ];
//     public function billing()
// {
//     return $this->hasOne(Billing::class,'room_id');
// }
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
public function getRoomPriceAttribute()
{
    return $this->roomType->room_price ?? 0; // หากไม่มี room_type จะให้ราคาเป็น 0
}
protected static function boot()
{
    parent::boot();

    static::updating(function ($room) {
        if ($room->isDirty('user_id') && !is_null($room->user_id)) {
            $room->contract = Carbon::now();
        }
    });
}
}
