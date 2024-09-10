<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Billing;
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

    $room->is_available = 1;
    $room->save();
    $booking->delete();

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

        $guest = $booking->guest;
        if ($guest) {
        $guest->delete();
        }
        $booking->delete();
        return redirect()->route('booking')->with('message', 'User created and assigned to room successfully.');
    }
    public function index()
    {
        // ดึงข้อมูลการจองห้องทั้งหมดจากฐานข้อมูล
        $bookings = Booking::all();
        $usersCount = User::count(); // นับจำนวนผู้ใช้
        //$pendingIssuesCount = Issue::where('status', 'pending')->count(); // นับปัญหาที่รอดำเนินการ
        $billings = Billing::where('status', 'ส่งไปยังผู้ใช้แล้ว')->count(); // นับบิลที่ยังไม่ชำระ
        $bookingsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                   ->groupBy('month')
                                   ->pluck('total', 'month')->toArray();

        // เตรียมข้อมูลของเดือนที่ต้องการแสดง (หากบางเดือนยังไม่มีข้อมูล ให้กำหนดค่าเป็น 0)
        $months = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $bookingsData = [];

        for ($i = 1; $i <= 12; $i++) {
            $bookingsData[] = $bookingsPerMonth[$i] ?? 0;
        }

        // ส่งข้อมูลไปยัง view
        return view('admin.adminpage', compact('bookings', 'usersCount','billings','months','bookingsData'));
    }
}




