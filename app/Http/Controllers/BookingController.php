<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BookingController extends Controller
{
    public function create(Request $request)
{
    // ตรวจสอบข้อมูลที่รับเข้ามา
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'room_id' => 'required|exists:rooms,id',
    ]);

    // สร้าง Guest ใหม่
    $guest = Guest::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);

    // สร้าง Booking ใหม่
    $booking = Booking::create([
        'guest_id' => $guest->id,
        'room_id' => $request->input('room_id'),
        'status' => 'รอชำระเงิน', // สถานะเริ่มต้น
    ]);

    // อัปเดตสถานะห้องเป็น "ไม่ว่าง" (is_available = 0)
    $room = rooms::findOrFail($request->input('room_id'));
    $room->is_available = 0; // ห้องไม่ว่างหลังจากจอง
    $room->save();

    return redirect()->back()->with('message', 'Booking created successfully, room is now unavailable.');
}

    public function updateStatus(Request $request, Booking $booking)
{
    // เปลี่ยนสถานะการจอง
    $booking->status = $request->input('status');
    $booking->save();

    // หากสถานะการจองเป็น "จองสำเร็จ" จะไม่คืนสถานะห้องเป็นว่าง
    if ($booking->status == 'จองสำเร็จ') {
        $room = $booking->room;
        $room->is_available = false; // คงสถานะ "ห้องไม่ว่าง"
        $room->save();
    }

    return redirect()->back()->with('message', 'Booking status updated.');
}
    public function pay(Request $request, Booking $booking)
{
    // เปลี่ยนสถานะจาก "รอชำระเงิน" เป็น "รอยืนยัน"
    if ($booking->status == 'รอชำระเงิน') {
        $booking->status = 'รอยืนยัน';
        $booking->save();
        
        return redirect()->back()->with('message', 'Payment completed. Waiting for confirmation.');
    }

    return redirect()->back()->with('error', 'Invalid booking status.');
}
public function payBooking($id)
{
    // ดึงข้อมูลการจอง
    $booking = Booking::findOrFail($id);

    // ตรวจสอบว่าสถานะของการจองคือ 'รอชำระเงิน'
    if ($booking->status == 'รอชำระเงิน') {
        // เปลี่ยนสถานะการจองเป็น "รอยืนยัน"
        $booking->status = 'รอยืนยัน';
        $booking->save();

        // เปลี่ยนสถานะห้องให้เป็น "ไม่ว่าง" (is_available = 0)
        $room = $booking->room;
        $room->is_available = 0; // ห้องไม่ว่าง
        $room->save();

        return redirect()->back()->with('message', 'Payment completed and room is now unavailable.');
    }

    return redirect()->back()->with('error', 'Invalid booking status.');
}



public function assignUserToRoom($roomId, $userId)
{
    // ดึงข้อมูลห้องจาก room_id
    $room = rooms::findOrFail($roomId);

    // อัปเดต user_id และบันทึกวันที่ contract
    $room->user_id = $userId;
    $room->contract = Carbon::now(); // บันทึกวันที่ปัจจุบัน
    $room->save();
}


}