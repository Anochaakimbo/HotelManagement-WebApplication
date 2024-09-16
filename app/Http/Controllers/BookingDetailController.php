<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Rooms;
use App\Models\RoomType;

use Illuminate\Http\Request;

class BookingDetailController extends Controller
{
    public function showBookings()
    {
        // ดึงข้อมูล bookings พร้อมข้อมูล rooms และ room_types
        $bookings = Booking::with('room.roomType')->get(); 
        $rooms = Rooms::with('roomType')->get();

        // ส่งข้อมูล bookings ไปยัง view
        return view('bookingdetail', compact('rooms', 'bookings'));
    }
}
