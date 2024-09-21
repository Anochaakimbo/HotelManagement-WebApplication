<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'room_number' => 'required',
        ]);


        $room = rooms::where('room_number', $request->input('room_number'))->firstOrFail();
        $existingBooking = Booking::where('room_id', $room->id)->where('status', '!=', 'ยกเลิก')->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'ห้องนี้ถูกจองไปแล้ว');
        }

        $existingGuest = Guest::where('email', $request->input('email'))->first();
        if ($existingGuest) {
            return redirect()->back()->with('error', 'คุณได้ทำการจองไปแล้ว');
        }

        // สร้างข้อมูล Guest
        $guest = Guest::create([
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        // สร้างข้อมูล Booking
        $booking = Booking::create([
            'guest_id' => $guest->id,
            'room_id' => $room->id,
            'status' => 'รอชำระเงิน',
        ]);

        $room->is_available = 0;
        $room->save();


        return redirect()->route('rent_2', ['guest_id' => $guest->id])->with('message', 'จองสำเร็จ,กำลังพาคุณไปหน้าชำระเงิน.');
    }


    public function updateStatus(Request $request, Booking $booking)
{
    $booking->status = $request->input('status');
    $booking->save();

    if ($booking->status == 'จองสำเร็จ') {
        $room = $booking->room;
        $room->is_available = false;
        $room->save();
    }

    return redirect()->back()->with('message', 'Booking status updated.');
}




public function assignUserToRoom($roomId, $userId)
{
    $room = rooms::findOrFail($roomId);
    $room->user_id = $userId;
    $room->contract = Carbon::now();
    $room->save();
}
public function historybooking()
    {
        $bookings = Booking::onlyTrashed()->with(['room', 'guest' => function ($query) {
            $query->withTrashed();
        }])->get();

        return view('admin.booking_history', compact('bookings'));
    }

}
