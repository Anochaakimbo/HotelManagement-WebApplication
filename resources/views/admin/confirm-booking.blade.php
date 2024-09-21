@extends('layouts.sidebar-admin')
@section('content')

    <div class="main-content">
        <div class="booking-details">
            <p><strong>Room:</strong> {{ $booking->room->room_number }}</p>
            <p><strong>Guest:</strong> {{ $booking->guest->name }}</p>
            <p><strong>Status:</strong> {{ $booking->status }}</p>

            @if ($booking->payment_slip)
                <p><strong>Payment Slip:</strong></p>
                <img src="{{ asset('uploads/' . $booking->payment_slip) }}" alt="Payment Slip" style="max-width: 400px; height: auto;">
            @else
                <h1>Paymented by credit card</h1>
            @endif

            @if ($booking->status == 'รอยืนยัน')
                <form action="{{ route('admin.booking.confirm.post', $booking->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm Booking</button>
                </form>
                <form action="{{ route('admin.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Deny Booking</button>
                </form>
            @endif
            @if ($booking->status == 'จองสำเร็จ' && !App\Models\User::where('email', $booking->guest->email)->exists())
                <form action="{{ route('admin.create.user') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <label for="password">Set Password for User:</label>
                    <input type="password" name="password" required>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
                @endif
        </div>
    </div>
@endsection
