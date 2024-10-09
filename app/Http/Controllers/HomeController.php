<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\rooms;
use App\Models\RoomType;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
{
    // ตรวจสอบว่าเป็นผู้ใช้ทั่วไปหรือผู้ดูแลระบบ
    if (Auth::user()->usertype == 'user') {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้มีห้องที่เชื่อมโยงอยู่หรือไม่
        if ($user->room) {
            // ดึงวันที่ทำสัญญาจากห้องพักของผู้ใช้
            $contractDate = Carbon::parse($user->room->contract);

            // ดึงระยะเวลาสัญญาจากประเภทห้องของผู้ใช้ (สมมุติว่าเป็นจำนวนเดือน)
            $contractDuration = $user->room->roomType->contact_date;

            // คำนวณวันหมดสัญญา
            $contractEndDate = $contractDate->copy()->addMonths($contractDuration);

            // คำนวณจำนวนวันที่เหลือจากวันนี้ถึงวันหมดสัญญา
            $remainingDays = floor(Carbon::now()->diffInDays($contractEndDate, false));
        } else {
            // กรณีที่ผู้ใช้ไม่มีห้องเชื่อมโยง ให้เซ็ตค่าเริ่มต้น
            $contractEndDate = null;
            $remainingDays = null;
        }

        // ส่งข้อมูลไปยัง view 'home' สำหรับผู้ใช้ทั่วไป
        return view('home', compact('user', 'contractEndDate', 'remainingDays'));
    } else {
        // ส่งข้อมูลไปยัง view 'admin.home' สำหรับผู้ดูแลระบบ
        return view('admin.home');
    }
}

    public function page()
    {
        $bookings = Booking::withTrashed()->get();
        return view('admin.adminpage', compact('bookings'));
    }

    public function booking()
    {
        $bookings = Booking::all();
        return view('admin.booking', ['bookings' => $bookings]);
    }
    public function customerprob()
    {
        return view('admin.csp');
    }
    public function room()
    {
        $rooms = rooms::all();
        return view('admin.csp', ['rooms' => $rooms]);
    }

    public function addRoom(Request $request)
    {
        $checkroom = rooms::where('room_number', $request->room_number)->first();

        if ($checkroom) {
            return back()->with('alert', 'Room duplicate')->withInput();
        }



        $new_room = new rooms;
        $new_room->room_type_id = $request->room_type_id;
        $new_room->room_number = $request->room_number;
        $new_room->description = $request->description;
        $new_room->floor = $request->floor;
        $new_room->save();
        $rooms = rooms::all();

        return redirect('/Addroom');
    }

    public function roomdetail()
    {
        $rooms = rooms::orderBy('room_number', 'asc')->get(); // เรียงลำดับตาม room_number จากน้อยไปมาก
        return view('admin.admin_roomdetail', ['rooms' => $rooms]);
    }
    public function preparetoAdd()
    {
        $rooms = RoomType::all();
        return view('admin.admin_addroom', ['rooms' => $rooms]);
    }

    public function delete($id)
    {
        $rooms = rooms::findOrFail($id);
        if ($rooms->is_available == "0") {
            return back()->with('error', 'ลบไม่ได้ เพราะ มีผู้เข้าพักอาศัยอยู่')->withInput();
        }

        $rooms->destroy($id);
        $rooms = rooms::all();
        return redirect('/roomdetail');
    }

    public function showDetailroom()
    {
        $rooms = rooms::all();
        return view("room", compact("room"));
    }
    public function updateroom(Request $request)
    {
        $room = rooms::find($request->id); //

        if ($room) {
            $room->description = $request->description;
            $room->save();

            return redirect()->route('roomdetail');
        }

    }
    public function showUserRoomDetails()
{
    // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
    $user = Auth::user();

    // ดึงวันที่ทำสัญญาจากห้องพักของผู้ใช้
    $contractDate = Carbon::parse($user->room->contract);

    // ดึงระยะเวลาสัญญาจากประเภทห้องของผู้ใช้ (สมมุติว่าเป็นจำนวนเดือน)
    $contractDuration = $user->room->roomType->contact_date;

    // คำนวณวันหมดสัญญา
    $contractEndDate = $contractDate->copy()->addMonths($contractDuration);

    // คำนวณจำนวนวันที่เหลือจากวันนี้ถึงวันหมดสัญญา
    $remainingDays = floor(Carbon::now()->diffInDays($contractEndDate, false));

    // ส่งข้อมูลไปยัง View
    return view('Roomdetails', compact('user', 'contractEndDate', 'remainingDays'));
}

}
