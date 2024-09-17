@extends('layouts.sidebar-admin')
@section('content')

        <div class="main-content">
            <div class="booking-details">
                <p><strong>Room:</strong> {{ $booking->room->room_number }}</p>
                <p><strong>Guest:</strong> {{ $booking->guest->name }}</p>
                <p><strong>Status:</strong> {{ $booking->status }}</p>

                @if ($booking->status == 'รอชำระเงิน')
                <form action="{{ route('admin.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete Booking</button>
                </form>
                @endif

                @if ($booking->status == 'รอยืนยัน')
                <form action="{{ route('admin.booking.confirm.post', $booking->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm Booking</button>
                </form>
                <form action="{{ route('admin.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete Booking</button>
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
                @elseif ($booking->status == 'จองสำเร็จ' && App\Models\User::where('email', $booking->guest->email)->exists())
                <p>User has been created</p>
                @endif
            </div>
        </div>
    </div>
@endsection

