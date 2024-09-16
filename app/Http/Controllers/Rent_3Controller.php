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
        // นำผู้ใช้ไปยังหน้า rent_4 สำหรับ QR หรือ rent_4_2 สำหรับ credit
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'qr') {
            return view('rent_4');  // สำหรับ QR Code
        } elseif ($paymentMethod === 'credit') {
            return view('rent_4_2');  // สำหรับบัตรเครดิต/เดบิต
        }

        // กรณีไม่พบวิธีการจ่ายเงินที่ถูกต้อง
        return redirect()->route('rent_3')->with('error', 'กรุณาเลือกวิธีการชำระเงิน');
    }
}


