<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate ข้อมูล
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'room_number' => 'required',
        ]);

        // ตรวจสอบว่าห้องนี้ถูกจองไปแล้วหรือยัง
        $room = rooms::where('room_number', $request->input('room_number'))->firstOrFail();
        $existingBooking = Booking::where('room_id', $room->id)->where('status', '!=', 'ยกเลิก')->first();

        if ($existingBooking) {
            // ถ้ามีการจองห้องนี้ไปแล้ว
            return redirect()->back()->with('error', 'ห้องนี้ถูกจองไปแล้ว');
        }

        // ตรวจสอบว่าผู้ใช้นี้ได้ทำการจองไปแล้วหรือไม่ (เช็คจากอีเมล)
        $existingGuest = Guest::where('email', $request->input('email'))->first();
        if ($existingGuest) {
            return redirect()->back()->with('error', 'คุณได้ทำการจองไปแล้ว');
        }

        // สร้างข้อมูล Guest
        $guest = Guest::create([
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        // สร้างข้อมูล Booking
        $booking = Booking::create([
            'guest_id' => $guest->id,
            'room_id' => $room->id,
            'status' => 'รอชำระเงิน',
        ]);

        // ทำให้ห้องไม่ว่าง
        $room->is_available = 0;
        $room->save();

        // Redirect ไปยังหน้า rent2 พร้อมข้อความ
        return redirect()->route('rent_2', ['guest_id' => $guest->id])->with('message', 'จองสำเร็จ,กำลังพาคุณไปหน้าชำระเงิน.');
    }


    public function updateStatus(Request $request, Booking $booking)
{
    $booking->status = $request->input('status');
    $booking->save();

    if ($booking->status == 'จองสำเร็จ') {
        $room = $booking->room;
        $room->is_available = false;
        $room->save();
    }

    return redirect()->back()->with('message', 'Booking status updated.');
}
public function pay(Request $request, $id)
{

    $booking = Booking::findOrFail($id);

    if ($booking->status == 'รอชำระเงิน') {

        $booking->status = 'รอยืนยัน';
        $booking->save();


        $room = $booking->room;
        if ($room) {
            $room->is_available = 0;
            $room->save();
        }

        return redirect()->back()->with('message', 'Payment completed and room is now unavailable. Waiting for confirmation.');
    }

    return redirect()->back()->with('error', 'Invalid booking status.');
}



public function assignUserToRoom($roomId, $userId)
{
    $room = rooms::findOrFail($roomId);

    // อัปเดต user_id และบันทึกวันที่ contract
    $room->user_id = $userId;
    $room->contract = Carbon::now(); // บันทึกวันที่ปัจจุบัน
    $room->save();
}
public function historybooking()
    {
        $bookings = Booking::onlyTrashed()->with('room', 'guest')->get();

        return view('admin.booking_history', compact('bookings'));
    }

}
