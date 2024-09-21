<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Billing;
use App\Models\rooms;
use Illuminate\Support\Facades\Hash;

class AdminComtroller extends Controller
{
    public function showConfirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.confirm-booking', compact('booking'));
    }


    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'จองสำเร็จ';
        $booking->save();

        return redirect()->back()->with('message', 'Booking confirmed successfully.');
    }


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
    public function createUserFromBooking(Request $request)
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
    public function index()
{

    $bookings = Booking::all();
    $usersCount = User::where('usertype', '!=', 'admin')->count();
    $billings = Billing::where('status', 'ส่งไปยังผู้ใช้แล้ว')->count();
    $bookingsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')->toArray();
    return view('admin.adminpage', compact('bookings', 'usersCount', 'billings'));
}

    public function guest(){
        $users = User::with('room')->where('usertype', '!=', 'admin')->get();
        return view('admin.guests', compact('users'));
    }
    public function showinfo($id)
{
    $room = rooms::with(['roomType', 'billing'])->find($id);
    return view('admin.guests_roomdetails', compact('room'));
}
    public function checkout($id){
        $users = User::findOrFail($id);
        $room = $users->room;
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



