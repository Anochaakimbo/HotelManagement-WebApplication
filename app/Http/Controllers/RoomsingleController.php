<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomsingle;

class RoomsingleController extends Controller
{
    public function showSingleBed()
    {
        // ดึงข้อมูลห้องทั้งหมดจากฐานข้อมูล
        $rooms = Roomsingle::where('room_description', 'Single')->get();

        // ส่งข้อมูลไปยัง view
        return view('roomdetail-1', ['rooms' => $rooms]);
    }
}
