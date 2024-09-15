<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roompre;

class RoompreController extends Controller
{
    public function showPremiumBed()
    {
        // ดึงข้อมูลห้องทั้งหมดจากฐานข้อมูล
         $rooms = Roompre::where('room_description', 'Pre')->get();

        // ส่งข้อมูลไปยัง view
        return view('roomdetail-3', ['rooms' => $rooms]);
    }
}
