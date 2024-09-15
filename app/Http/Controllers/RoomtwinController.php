<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomtwin;

class RoomtwinController extends Controller
{
    public function showTwinBed()
    {
        // ดึงข้อมูลห้องทั้งหมดจากฐานข้อมูล
        $rooms = Roomtwin::where('room_description', 'Two')->get();

        // ส่งข้อมูลไปยัง view
        return view('roomdetail-2', ['rooms' => $rooms]);
    }
}
