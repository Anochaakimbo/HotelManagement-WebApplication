<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelectRoom;

class RoomtypeController extends Controller
{
//     public function showAvailableRooms(Request $request)
// {
//     // รับพารามิเตอร์ประเภทเตียงจาก URL และแปลงเป็นตัวพิมพ์เล็ก
//     $bedType = strtolower($request->query('bedType'));

//     // ตรวจสอบและดึงข้อมูลห้องที่ตรงกับประเภทเตียง
//     $rooms = SelectRoom::whereHas('roomType', function($query) use ($bedType) {
//         $query->whereRaw('LOWER(room_description) = ?', [$bedType]); // ตรวจสอบค่า room_description แบบไม่สนใจตัวพิมพ์
//     })->get();

//     // ส่งข้อมูลไปยัง view
//     return view('selectbook', compact('rooms', 'bedType'));
// }
public function showAvailableRooms(Request $request)
{
    // รับค่าประเภทเตียงจาก URL (เช่น 'single', 'twin', 'pre')
    $bedType = $request->query('bedType');

    // ดึงข้อมูลห้องโดยกรองตามประเภทเตียงที่ส่งมา
    $rooms = SelectRoom::whereHas('roomType', function($query) use ($bedType) {
        $query->where('room_description', $bedType); // กรองตามประเภทห้องใน room_description
    })->with('roomType')->get(); // ดึงข้อมูลความสัมพันธ์ roomType ด้วย
    // $rooms = SelectRoom::with('roomType')->get();

    // ส่งข้อมูลไปยัง View พร้อมกับประเภทเตียงที่เลือก
    return view('selectbook', compact('rooms', 'bedType'));
}
}
