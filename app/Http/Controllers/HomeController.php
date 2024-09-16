<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\rooms;
use App\Models\RoomType;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->usertype =='user'){
            return view('dashboard');
        }else{
            return view('admin.home');
        }
    }
    public function page(){
         $bookings = Booking::withTrashed()->get();
        return view('admin.adminpage', compact('bookings'));
    }

    public function guest(){
        $bookings = Booking::all();
        return view ('admin.guests', ['bookings' => $bookings]);
    }
    public function booking(){
        $bookings = Booking::all();
        return view ('admin.booking', ['bookings' => $bookings]);
    }
    public function customerprob(){
        return view ('admin.csp');
    }
    public function room()
    {
        $rooms = rooms::all();
        return view('admin.csp', ['rooms' => $rooms]);
    }

    public function addRoom(Request $request){
        $new_room = new rooms;
        $new_room->room_type_id = $request->room_type_id;
        $new_room->room_number = $request->room_number;
        $new_room->description = $request->description;
        $new_room->floor = $request->floor;
        $new_room->save();
        $rooms = rooms::all();

        return redirect('/Addroom');
    }

    public function roomdetail(){
        $rooms = rooms::all();
        return view ('admin.admin_roomdetail', ['rooms' => $rooms]);
    }

    public function preparetoAdd(){
        $rooms = RoomType::all();
        return view('admin.admin_addroom',['rooms' => $rooms]);
    }

    public function delete($id){
        $rooms = rooms::findOrFail($id);
        $rooms->destroy($id);
        $rooms = rooms::all();
        return redirect('/roomdetail');
    }
}
