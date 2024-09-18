<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\rooms;
class PaymentCreditController extends Controller
{
    public function processPayment(Request $request)
{
    $guestId = $request->input('guest_id');
    $guest = Guest::find($guestId);

    if (!$guest) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
    }

    $booking = Booking::where('guest_id', $guest->id)->first();
    if (!$booking) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลการจอง');
    }

    // อัปเดตสถานะการจอง
    $booking->status = 'รอยืนยัน';
    $booking->save();

    return redirect('/')->with('message', 'การชำระเงินสำเร็จแล้ว');
}
}
