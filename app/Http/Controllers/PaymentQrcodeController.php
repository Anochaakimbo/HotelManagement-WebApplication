<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\rooms;

class PaymentQrcodeController extends Controller
{
    public function processQrPayment(Request $request)
    {
        // รับข้อมูล guest_id จาก request
        $guestId = $request->input('guest_id');
        $guest = Guest::find($guestId);

        if (!$guest) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }

        // ตรวจสอบว่ามีการแนบไฟล์สลิป
        if ($request->hasFile('payment_slip')) {
            $file = $request->file('payment_slip');
            
            // ตรวจสอบและตั้งชื่อไฟล์โดยใช้ชื่อผู้จองและ guest_id
            $guestName = !empty($guest->name) ? preg_replace('/[^A-Za-z0-9\-]/', '', $guest->name) : 'Guest_' . $guest->id;
            $fileName = $guestName . '_' . $guest->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
            $file->move(public_path('uploads'), $fileName);

            // บันทึกชื่อไฟล์ลงในฐานข้อมูล โดยเชื่อมโยงกับ guest_id
            $booking = Booking::where('guest_id', $guest->id)->first();
            if ($booking) {
                $booking->payment_slip = $fileName;
                $booking->status = 'รอยืนยัน';
                $booking->save();
            }
        }

        return redirect('/')->with('message', 'การชำระเงินสำเร็จแล้ว');
    }
}
