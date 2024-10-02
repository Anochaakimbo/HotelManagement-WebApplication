<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Billing;
use App\Models\rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminComtroller extends Controller
{
    public function showConfirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.confirm-booking', compact('booking'));
    }
    //ส่งข้อมูลตาราง booking ให้หน้า admin กดยืนยัน


    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'จองสำเร็จ';
        $booking->save();

        return redirect()->back()->with('message', 'Booking confirmed successfully.');
    }
    //เป็นปุ่ม controller ของปุ่มหน้ากดยืนยันการจอง


    public function deleteBooking($id)
{
    $booking = Booking::findOrFail($id);

    $room = $booking->room;

    $guest = $booking->guest;
    if ($guest) {
        $guest->delete();
    }

        $room->is_available = 1;
        $room->save();
        $booking->delete();

    return redirect('/admin/booking');
}
    //เป็นปุ่มลบอ้างอิงจากไอดี การ booking ในกรณ๊ที่ผู้ใช้ ส่งข้อมูลการชำระมาไม่ถูกต้อง
    public function createUserFromBooking(Request $request)//เป็นการสร้าง account จากข้อมูล Booking
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'password' => 'required|string|min:8',
        ]);
        $booking = Booking::findOrFail($request->input('booking_id'));
        if (User::where('email', $booking->guest->email)->exists()) {
            return redirect()->back()->with('error', 'User with this email already exists.');
        }
        $user = User::create([
            'name' => $booking->guest->name,
            'email' => $booking->guest->email,
            'password' => Hash::make($request->input('password')),
        ]);

        $booking->room->user_id = $user->id;
        $booking->room->save();

        $guest = $booking->guest;
        if ($guest) {
        $guest->delete();}
        $booking->delete();
        return redirect('/admin/booking');
    }
    public function index()//ดึงข้อมูลไปโชว์หน้า DASHBOARD
{

    $bookings = Booking::all();
    $usersCount = User::where('usertype', '!=', 'admin')->count();
    $billings = Billing::where('status', 'ส่งไปยังผู้ใช้แล้ว')->count();
    $bookingsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')->toArray();
    return view('admin.adminpage', compact('bookings', 'usersCount', 'billings'));
}
    //แสดงผู้ใช้ในระบบโดยไม่นับผู้ใช้ที่เป็น ADMIN
    public function guest(){
        $users = User::with('room')->where('usertype', '!=', 'admin')->get();
        return view('admin.guests', compact('users'));
    }

    public function showinfo($id)
    {
        // ดึงข้อมูลห้องที่ต้องการพร้อมกับข้อมูลประเภทห้องและบิล
        $room = rooms::with(['roomType', 'billing'])->findOrFail($id);

        // ดึงวันที่ทำสัญญาจากตาราง rooms
        $contractDate = Carbon::parse($room->contract);

        // ดึงระยะเวลาสัญญาจาก roomType (สมมุติว่าเป็นจำนวนเดือน)
        $contractDuration = $room->roomType->contact_date; // ตัวอย่าง 12 เดือน

        // คำนวณวันหมดสัญญาโดยบวกจำนวนเดือนของสัญญา
        $contractEndDate = $contractDate->copy()->addMonths($contractDuration);

        // คำนวณจำนวนวันที่เหลือจากวันนี้ถึงวันหมดสัญญา
        $remainingDays = floor(Carbon::now()->diffInDays($contractEndDate, false)); // false เพื่อให้ได้ค่าติดลบหากสัญญาหมดแล้ว

        // ส่งข้อมูลไปที่ view
        return view('admin.guests_roomdetails', compact('room', 'contractEndDate', 'remainingDays'));
    }

    //เป็นการ checkout ออกจากระบบหอ โดยที่จะออกไม่ได้หากผู้ใช้มียอดค้างชำระ
public function checkout($id) {
    $users = User::findOrFail($id);
    $room = $users->room;


    $billing = Billing::where('user_id', $id)->whereNull('deleted_at')->first();

    if ($billing) {
        return redirect()->back()->withErrors(['msg' => 'This guest cannot be checked out because they have existing billing records.']);
    }

    if ($room) {
        $room->is_available = '1';
        $room->user_id = NULL;
        $room->contract = NULL;
        $room->save();
    }

    $users->delete($id);

    return redirect('/guestpage');
}

}



