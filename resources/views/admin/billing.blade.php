<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/billing.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('home') }}">
            <img src="./img/หอ-2.png" alt="Logo" class="logo">
        </a>
        <a href="{{ route('adminpage') }}">Dashboard</a>
        <a href="{{ route('guestpage') }}">Guest</a>
        <a href="{{ route('customerproblem') }}">Customer problem</a>
        <a href="{{ route('booking') }}">Booking</a>
        <a href="{{ route('adminbilling') }}" class="active">Billing</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form method="POST" action="{{ route('logout') }}" x-data class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <h2 class="page-title">Billing</h2>
        </div>

        <!-- Billing Form Table -->
        <form action="{{ route('EASYOKOK') }}" method="POST">
            @csrf
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>User</th>
                        <th>Water Units</th>
                        <th>Electricity Units</th>
                        <th>Room Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->user->name }}</td>
                        <td>
                            <input type="number" name="water_units[{{ $room->id }}]" min="0" required>
                        </td>
                        <td>
                            <input type="number" name="electric_units[{{ $room->id }}]" min="0" required>
                        </td>
                        <td>
                            <input type="number" name="room_price[{{ $room->id }}]" required>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="submit-btn">Submit Billing</button>
        </form>

        <!-- Billing History -->
        <div class="billing-history">
            <h2>Billing Sent to Users</h2>
            @foreach ($billings as $billing)
                @if ($billing->status == 'Sent to User')
                    <p>Room: {{ $billing->room->room_number }}</p>
                    <p>Status: {{ $billing->status }}</p>
                    <hr>
                @endif
            @endforeach

            <h2>Billing Pending Confirmation</h2>
            @foreach ($billings as $billing)
                @if ($billing->status == 'Pending Confirmation')
                    <p>Room: {{ $billing->room->room_number }}</p>
                    <form action="{{ route('confirmPayment', $billing->id) }}" method="POST">
                        @csrf
                        <button type="submit">Confirm Payment</button>
                    </form>
                @endif
            @endforeach
        </div>
    </div>
</body>

</html>
