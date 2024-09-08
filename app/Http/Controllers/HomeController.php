<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Room;
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
        return view ('admin.adminpage');
    }

    public function guest(){
        return view ('admin.guests');
    }
    // public function customerprob(){
    //     return view ('admin.customerproblem');
    // }
    public function room()
    {
        $rooms = Room::all();
        return view('admin.csp', ['rooms' => $rooms]);
    }
}
