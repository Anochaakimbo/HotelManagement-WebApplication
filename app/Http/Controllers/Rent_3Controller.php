<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Rent_3Controller extends Controller
{
        public function showPaymentPage(Request $request)
    {
        // รับค่าการจ่ายจาก URL เช่น 'credit' หรือ 'qr'
        $paymentMethod = $request->input('payment_method');

        // ส่งค่าช่องทางการชำระเงินไปยัง view rent_3
        return view('rent_3', ['paymentMethod' => $paymentMethod]);
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
