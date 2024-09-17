@extends('layouts.sidebar-admin')
@section('content')
        <div class="main-content">
            <div class="room-info">
                <div class="details">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Room number</th>
                                <th>Guest Name</th>
                                <th>Booking Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td><a href="{{ route('admin.booking.confirm', $booking->id) }}">{{ $booking->room->room_number }}</a></td>
                                <td>{{ $booking->guest->name }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
