<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Rooms;
use App\Models\RoomType;

use Illuminate\Http\Request;

class BookingDetailController extends Controller
{
    public function showBookings(Request $request)
    {
        // ดึง booking IDs จาก session (เก็บเฉพาะการจองของ guest ที่เก็บใน session)
        $bookingIds = $request->session()->get('bookings', []); // หากไม่มี bookings ใน session ให้คืน array ว่าง

        // ดึงข้อมูล bookings ที่มีใน session พร้อมข้อมูล rooms และ room_types
        $bookings = Booking::with('room.roomType')->whereIn('id', $bookingIds)->get();

        // ดึงข้อมูล rooms พร้อมข้อมูล roomType
        $rooms = Rooms::with('roomType')->get();

        // ส่งข้อมูล bookings และ rooms ไปยัง view
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
