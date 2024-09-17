@extends('layouts.sidebar-admin')

@section('content')
<div class="billing-history">
    <h1>Booking Histpry</h1>
<div class="main-content">
    <div class="room-info">
        <div class="details">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Room number</th>
                        <th>Guest Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>
                            @if($booking->room)
                                {{ $booking->room->room_number }}
                            @else
                                <span class="text-danger">Room not found</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->guest)
                                {{ $booking->guest->name }}
                            @else
                                <span class="text-danger">Guest not found</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
