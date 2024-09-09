<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rooms;
use App\Models\Billing;
use Illuminate\Support\Facades\Auth;
class ChargeController extends Controller
{
    public function showPayRent()
{
    // ดึงข้อมูลผู้ใช้ที่ล็อคอินอยู่
    $user = Auth::user();

    // ดึงข้อมูล billing ของผู้ใช้
    $billings = Billing::where('user_id', $user->id)->get();

    // ส่งข้อมูลไปที่ view
    return view('Payrent', compact('billings'));
}
public function showAdminForm()
{
    // ดึงข้อมูลห้องที่ไม่มี Billing สถานะ "ส่งไปยังผู้ใช้แล้ว" และยังไม่ได้ถูก soft delete
    $rooms = rooms::whereNotNull('user_id')
        ->whereDoesntHave('billings', function ($query) {
            $query->where('status', 'ส่งไปยังผู้ใช้แล้ว')
                  ->whereNull('deleted_at');
        })
        ->with('user')
        ->get();
    $billings = Billing::with('room', 'user')->get();
    return view('admin.billing', compact('rooms', 'billings'));
    // ส่งข้อมูลไปที่ view
}

    
    public function calculate(Request $request)
{
    // รับค่าจากฟอร์ม
    $room_id = $request->input('room_id');
    $water_units = $request->input('water_units');
    $electric_units = $request->input('electric_units');
    $room_price = $request->input('room_price');

    // ดึงข้อมูลห้องและผู้ใช้
    $room = rooms::findOrFail($room_id);
    $user = $room->user;

    // คำนวณค่าน้ำ
    if ($water_units <= 15) {
        $water_charge = 200;
    } else {
        $water_charge = 200 + ($water_units - 15) * 20;
    }

    // คำนวณค่าไฟ
    $electric_charge = $electric_units * 8;

    // คำนวณค่าใช้จ่ายรวม
    $total_charge = $water_charge + $electric_charge + $room_price;

    // บันทึกข้อมูลลงในตาราง billings
    Billing::create([
        'room_id' => $room_id,
        'user_id' => $user->id,
        'water_units' => $water_units,
        'electric_units' => $electric_units,
        'room_price' => $room_price,
        'water_charge' => $water_charge,
        'electric_charge' => $electric_charge,
        'total_charge' => $total_charge,
        'status' => 'ส่งไปยังผู้ใช้แล้ว',
    ]);
    $existingBilling = Billing::where('user_id', $user->id)
    ->where('status', 'ส่งไปยังผู้ใช้แล้ว')
    ->first();

    if ($existingBilling) {
    return redirect()->back()->with('error', 'ไม่สามารถส่งข้อมูลให้ผู้ใช้เดิมซ้ำได้');
    }

    // Redirect กลับไปที่หน้า admin พร้อมกับ flash message
    return redirect()->back()->with('success', 'ส่งค่าห้องสำเร็จ');
}
public function confirmPayment($id)
{
    $billing = Billing::findOrFail($id);
    
    // เปลี่ยนสถานะเป็น "ชำระค่าห้องแล้ว"
    $billing->status = 'ชำระค่าห้องแล้ว';
    $billing->save();

    // Soft delete ตาราง billing
    $billing->delete();

    return redirect()->back()->with('success', 'ยืนยันการชำระเงินสำเร็จ');
}
public function showPaymentHistory()
{
    // ดึงเฉพาะข้อมูลที่ถูก soft delete ทั้งหมด
    $billings = Billing::onlyTrashed()->get();

    return view('admin.payment_history', compact('billings'));
}
public function payBilling($id)
{
    // ดึงข้อมูล billing จาก id
    $billing = Billing::findOrFail($id);

    // ตรวจสอบว่าสถานะเป็น "ส่งไปยังผู้ใช้แล้ว"
    if ($billing->status == 'ส่งไปยังผู้ใช้แล้ว') {
        // เปลี่ยนสถานะเป็น "รอยืนยัน"
        $billing->status = 'รอยืนยัน';
        $billing->save();

        return redirect()->back()->with('success', 'การชำระเงินถูกส่งเพื่อรอยืนยัน');
    }

    return redirect()->back()->with('error', 'ไม่สามารถชำระเงินได้');
}
}
