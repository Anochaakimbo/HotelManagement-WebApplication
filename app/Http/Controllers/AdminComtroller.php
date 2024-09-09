<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class AdminComtroller extends Controller
{
    public function showConfirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.confirm-booking', compact('booking'));
    }

    // ฟังก์ชันยืนยันการจอง
    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // เปลี่ยนสถานะการจองเป็น "จองสำเร็จ"
        $booking->status = 'จองสำเร็จ';
        $booking->save();

        return redirect()->back()->with('message', 'Booking confirmed successfully.');
    }

    // ฟังก์ชันลบการจอง
    public function deleteBooking($id)
{
    // ดึงข้อมูลการจอง
    $booking = Booking::findOrFail($id);

    // ดึงข้อมูลห้องที่ถูกจอง
    $room = $booking->room;

    // ลบ Guest ที่เกี่ยวข้องกับการจอง
    $guest = $booking->guest;
    if ($guest) {
        $guest->delete();
    }

    // ลบ User ที่สร้างขึ้นจาก Guest
    $user = User::where('email', $guest->email)->first();
    if ($user) {
        $user->delete();
    }

    // เปลี่ยนสถานะห้องให้เป็นว่าง (is_available = 1)
    $room->is_available = 1;
    $room->save();

    // ลบการจอง
    $booking->delete();

    // Redirect กลับไปที่หน้า booking list หรือหน้าอื่น ๆ หลังจากลบสำเร็จ
    return redirect()->back()->with('message', 'Booking deleted and room is now available.');
}

    // ฟังก์ชันสร้างผู้ใช้จากการจอง
    public function createUserFromBooking(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'password' => 'required|string|min:8',
        ]);

        $booking = Booking::findOrFail($request->input('booking_id'));

        if (User::where('email', $booking->guest->email)->exists()) {
            return redirect()->back()->with('error', 'User with this email already exists.');
        }

        // สร้างผู้ใช้ใหม่
        $user = User::create([
            'name' => $booking->guest->name,
            'email' => $booking->guest->email,
            'password' => Hash::make($request->input('password')),
        ]);

        $booking->room->user_id = $user->id;
        $booking->room->save();

        return redirect()->back()->with('message', 'User created and assigned to room successfully.');
    }
}



