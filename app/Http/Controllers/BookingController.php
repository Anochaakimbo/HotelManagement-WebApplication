<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
{
    // สร้าง Guest
    $guest = Guest::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);

    // สร้าง Booking
    $booking = Booking::create([
        'guest_id' => $guest->id,
        'room_id' => $request->input('room_id'),
        'status' => 'รอชำระเงิน',
    ]);

    // อัปเดตสถานะห้องเป็น "ห้องไม่ว่าง"
    $room = rooms::find($request->input('room_id'));
    $room->is_available = false; // เปลี่ยนเป็นห้องไม่ว่าง
    $room->save();

    return redirect()->back()->with('message', 'Booking created successfully. Please proceed to payment.');
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
public function destroy(Booking $booking)
{
    // คืนสถานะห้องให้เป็น "ห้องว่าง" เมื่อการจองถูกลบ
    $room = $booking->room;
    $room->is_available = true; // คืนสถานะห้องให้จองได้
    $room->save();

    // ลบข้อมูล Guest หลังจากลบการจอง
    $guest = $booking->guest; // ดึงข้อมูล guest ที่เกี่ยวข้อง
    $booking->delete(); // ลบการจองก่อน

    // ตรวจสอบว่า guest ไม่มีการจองอื่นๆ
    if ($guest->bookings()->count() == 0) {
        $guest->delete(); // ลบ guest ถ้าไม่มีการจองอื่นๆ
    }

    return redirect()->back()->with('message', 'Booking and guest deleted successfully.');
}
}