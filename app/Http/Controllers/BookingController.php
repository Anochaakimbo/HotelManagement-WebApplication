<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BookingController extends Controller
{
    public function create(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'room_id' => 'required|exists:rooms,id',
    ]);

    $guest = Guest::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);

    $booking = Booking::create([
        'guest_id' => $guest->id,
        'room_id' => $request->input('room_id'),
        'status' => 'รอชำระเงิน', 
    ]);

    $room = rooms::findOrFail($request->input('room_id'));
    $room->is_available = 0; 
    $room->save();

    return redirect()->back()->with('message', 'Booking created successfully, room is now unavailable.');
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
public function pay(Request $request, $id)
{
 
    $booking = Booking::findOrFail($id);

    if ($booking->status == 'รอชำระเงิน') {

        $booking->status = 'รอยืนยัน';
        $booking->save();


        $room = $booking->room;
        if ($room) {
            $room->is_available = 0;
            $room->save();
        }

        return redirect()->back()->with('message', 'Payment completed and room is now unavailable. Waiting for confirmation.');
    }

    return redirect()->back()->with('error', 'Invalid booking status.');
}



public function assignUserToRoom($roomId, $userId)
{
    $room = rooms::findOrFail($roomId);

    // อัปเดต user_id และบันทึกวันที่ contract
    $room->user_id = $userId;
    $room->contract = Carbon::now(); // บันทึกวันที่ปัจจุบัน
    $room->save();
}

}