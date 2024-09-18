<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;


use Illuminate\Http\Request;

class Rent_3Controller extends Controller
{
    public function showPaymentPage(Request $request)
{
    $paymentMethod = $request->input('payment_method');
    $guestId = $request->input('guest_id');
    $guest = Guest::find($guestId);

    if (!$guest) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
    }

    // ดึงข้อมูลการจองที่เกี่ยวข้องกับ Guest
    $booking = Booking::where('guest_id', $guest->id)->first();
    if (!$booking) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลการจอง');
    }

    // ดึงข้อมูลห้องพักและประเภทห้อง
    $room = Rooms::with('roomType')->find($booking->room_id);
    if (!$room) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลห้องพัก');
    }

    // ส่งข้อมูลไปยัง View
    return view('rent_3', [
        'paymentMethod' => $paymentMethod,
        'guest' => $guest,
        'booking' => $booking,
        'room' => $room,
        'roomType' => $room->roomType // ส่งประเภทห้องไปด้วย
    ]);
}

    public function showRent2($guestId)
    {
        // หา Guest จากฐานข้อมูล
        $guest = Guest::find($guestId);

        // ตรวจสอบว่าพบ Guest หรือไม่
        if (!$guest) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }

        // ส่ง Guest ไปยัง view rent_2
        return view('rent_2', compact('guest'));
    }

    public function showRent4(Request $request)
{
    $guestId = $request->query('guest_id');
    $paymentMethod = $request->query('payment_method');

    // ตรวจสอบค่าที่ได้รับก่อนการ redirect

    if ($paymentMethod === 'credit') {
        return redirect()->route('rent_4_2', ['guest_id' => $guestId, 'payment_method' => $paymentMethod]);
    }

    return redirect()->back()->with('error', 'ไม่พบวิธีการชำระเงินที่ถูกต้อง');
}
public function showRent4_2(Request $request)
{
    // ดึง guest_id และ payment_method จาก query string
    $guestId = $request->query('guest_id');
    $paymentMethod = $request->query('payment_method');

    // ตรวจสอบ guest
    $guest = Guest::find($guestId);
    if (!$guest) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
    }

    // ดึง booking ที่เชื่อมโยงกับ guest
    $booking = Booking::where('guest_id', $guestId)->first();
    if (!$booking) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลการจอง');
    }

    // ส่งข้อมูลไปยัง view
    return view('rent_4_2', compact('guest', 'booking', 'paymentMethod'));
}
}

