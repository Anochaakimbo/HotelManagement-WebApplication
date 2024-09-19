<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentCreditController extends Controller
{
    public function processPayment(Request $request)
    {
        // รับข้อมูลบัตรเครดิตจากฟอร์ม
        $cardNumber = $request->input('card_number');
        $cardName = $request->input('card_name');
        $expiryDate = $request->input('expiry_date');
        $cvv = $request->input('cvv');

        
        return redirect('/')->with('message', 'การชำระเงินสำเร็จแล้ว');
    }
}