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
    $user = Auth::user();

    $billings = Billing::where('user_id', $user->id)->get();

    return view('Payrent', compact('billings'));
}
public function showAdminForm()
{
    $rooms = rooms::whereNotNull('user_id')
        ->whereDoesntHave('billing', function ($query) {
            $query->where('status', 'ส่งไปยังผู้ใช้แล้ว')
                  ->whereNull('deleted_at');
        })
        ->with('user')
        ->get();
    $billings = Billing::with('room', 'user')->get();
    return view('admin.billing', compact('rooms', 'billings'));
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

        $water_units = $request->input("water_units.$room_id");
        $electric_units = $request->input("electric_units.$room_id");
        $request->validate([
            "water_units.$room_id" => 'required|integer|min:0',
            "electric_units.$room_id" => 'required|integer|min:0',
        ]);
        if ($water_units <= 15) {
            $water_charge = 200;
        } else {
            $water_charge = 200 + ($water_units - 15) * 20;
        }

        $electric_charge = $electric_units * 8;

        $total_charge = $water_charge + $electric_charge + $room_price;

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
        return redirect()->route('adminbilling')->with('success', 'ส่งค่าห้องสำเร็จ');
    }

public function confirmPayment($id)
{
    $billing = Billing::findOrFail($id);

    $billing->status = 'ชำระค่าห้องแล้ว';
    $billing->save();

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
