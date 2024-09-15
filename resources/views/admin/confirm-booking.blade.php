<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Booking.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/หอ-2.png') }}" alt="Logo" class="logo">
        </a>        
        <a href="{{ route('adminpage') }}">Dashboard</a>
        <a href="{{ route('guestpage') }}">Guest</a>
        <a href="{{ route('customerproblem') }}">Customer problem</a>
        <a href="{{ route('booking') }}" class="active">Booking</a>
        <a href="{{ route('adminbilling') }}">Billing</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form method="POST" action="{{ route('logout') }}" x-data class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4 logout-button">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <h2 class="page-title">
                {{ __('Booking check') }}
            </h2>
        </div>

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
</body>

</html>

