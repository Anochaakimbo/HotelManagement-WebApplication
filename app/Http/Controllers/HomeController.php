<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\rooms;
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
}
