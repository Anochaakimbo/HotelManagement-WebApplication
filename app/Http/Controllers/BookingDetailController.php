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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // ค้นหาหมายเลขห้องแบบไม่สนตัวพิมพ์เล็กพิมพ์ใหญ่
        $bookings = Booking::whereHas('room', function($query) use ($searchTerm) {
            $query->whereRaw('LOWER(room_number) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
        })->get();

        // ส่งผลลัพธ์กลับไปยัง view
        return view('bookingdetail', compact('bookings'));
    }
}
