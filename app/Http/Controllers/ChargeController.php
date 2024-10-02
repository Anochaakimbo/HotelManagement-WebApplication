<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rooms;
use App\Models\Billing;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChargeController extends Controller
{
    public function showPayRent()
    {
        $user = Auth::user();

        $billings = Billing::where('user_id', $user->id)->get();

        return view('Payrent', compact('billings'));
    }
    public function showAdminForm()
{
    // กำหนดเดือนปัจจุบัน
    $currentMonth = Carbon::now()->format('Y-m');

    // ดึงข้อมูลห้องทั้งหมดที่มี user_id พร้อมกับข้อมูลบิล (รวมถึงบิลที่ถูกลบ)
    $rooms = rooms::whereNotNull('user_id')
        ->with(['user', 'billing' => function ($query) use ($currentMonth) {
            // ดึงบิลของเดือนปัจจุบัน
            $query->where('billing_date', 'like', "$currentMonth%")
                  ->withTrashed(); // ดึงบิลที่ถูกลบแบบ Soft Delete ด้วย
        }])
        ->get();

    return view('admin.billing', compact('rooms'));
}


    public function showAdminForm1()
    {
        $rooms = rooms::whereNotNull('user_id')
            ->whereDoesntHave('billing', function ($query) {
                $query->where('status', 'ส่งไปยังผู้ใช้แล้ว')
                    ->whereNull('deleted_at');
            })
            ->with('user')
            ->get();
        $billings = Billing::with('room', 'user')->get();
        return view('admin.billing-confirm', compact('rooms', 'billings'));
    }

    public function calculate(Request $request)
    {
        $room_id = $request->input('room_id');
        $room = rooms::with('roomType', 'user')->findOrFail($room_id);
        $user = $room->user;
        $room_price = $room->roomType->room_price;

        // ตรวจสอบเดือนและปีปัจจุบัน (เดือนใหม่)
        $currentMonth = Carbon::now()->format('Y-m');

        // ตรวจสอบว่ามีบิลในเดือนปัจจุบันหรือไม่ (รวมถึงบิลที่ถูก Soft Delete)
        $existingBill = Billing::withTrashed() // ใช้ withTrashed() เพื่อดึงบิลที่ถูกลบแบบ Soft Delete ด้วย
            ->where('room_id', $room_id)
            ->where('billing_date', 'like', "$currentMonth%") // ตรวจสอบเฉพาะบิลของเดือนปัจจุบัน
            ->first();

        // ถ้ามีบิลของเดือนนี้แล้ว ไม่ให้ส่งบิลใหม่
        if ($existingBill && !$existingBill->trashed()) {
            return redirect()->route('adminbilling')->with('error', 'บิลของห้องนี้ถูกส่งในเดือนนี้แล้ว');
        }

        // ดึงค่า input ของหน่วยน้ำและไฟ
        $water_units = $request->input("water_units.$room_id");
        $electric_units = $request->input("electric_units.$room_id");

        // ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            "water_units.$room_id" => 'required|integer|min:0',
            "electric_units.$room_id" => 'required|integer|min:0',
        ]);

        // คำนวณค่าหน่วยน้ำและไฟ
        $water_charge = ($water_units <= 15) ? 200 : 200 + ($water_units - 15) * 20;
        $electric_charge = $electric_units * 8;
        $total_charge = $water_charge + $electric_charge + $room_price;

        // บันทึกข้อมูลบิลในฐานข้อมูล
        Billing::create([
            'room_id' => $room_id,
            'user_id' => $user->id,
            'water_units' => $water_units,
            'electric_units' => $electric_units,
            'room_price' => $room_price,
            'water_charge' => $water_charge,
            'electric_charge' => $electric_charge,
            'total_charge' => $total_charge,
            'billing_date' => Carbon::now(), // บันทึกวันที่บิลของเดือนปัจจุบัน
            'status' => 'ส่งไปยังผู้ใช้แล้ว',
        ]);

        return redirect()->route('adminbilling')->with('success', 'ส่งค่าห้องสำเร็จ');
    }




    public function confirmPayment($id)
    {
        $billing = Billing::findOrFail($id);

        // เปลี่ยนสถานะเป็น "ชำระค่าห้องแล้ว"
        $billing->status = 'ชำระค่าห้องแล้ว';
        $billing->save();

        // ใช้ Soft Delete เพื่อเก็บประวัติการชำระเงิน
        $billing->delete();

        return redirect()->route('adminbilling')->with('success', 'ยืนยันการชำระเงินสำเร็จ');
    }
    public function denyPayment($id)
    {
        $billing = Billing::findOrFail($id);
        $billing->status = 'ส่งไปยังผู้ใช้แล้ว';
        $billing->save();

        return redirect()->back()->with('success', 'Payment denied and status reverted to pending.');
    }
    public function showPaymentHistory()
    {
        $billings = Billing::onlyTrashed()->get();

        return view('admin.payment_history', compact('billings'));
    }
    public function showBillingForm()
    {
        $rooms = rooms::with('roomType', 'user')->whereHas('user')->get();
        return view('admin.billing', compact('rooms'));
    }
}
