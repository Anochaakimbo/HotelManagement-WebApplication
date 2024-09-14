<?php

namespace App\Http\Controllers;

use App\Models\rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Roomdetailcontroller extends Controller
{
    public function showRoomdetail()
    {
        $user = Auth::user();

        $room = $user->room()->with('roomType')->first();

        return view('Roomdetails', compact('room'));
    }
}
