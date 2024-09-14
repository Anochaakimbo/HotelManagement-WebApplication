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
        <a href="{{ route('roomdetail') }}">Room Detail</a>
        <a href="{{ route('Addroom') }}">Add Room</a>
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
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>User</th>
                    <th>Water Units</th>
                    <th>Electricity Units</th>
                    <th>Room Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($rooms as $room)
    @if(!$room->billing)
    <form action="{{ route('EASYOKOK') }}" method="POST">
        @csrf
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
                <!-- แสดงราคาห้องจาก RoomType และตั้งเป็น readonly -->
                <input type="number" name="room_price[{{ $room->id }}]" value="{{ $room->roomType->room_price }}" readonly>
            </td>
            <td>
                <!-- ส่งค่า room_id ไปด้วย -->
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <button type="submit" class="submit-btn">Submit Billing</button>
            </td>
        </tr>
    </form>
    @endif
    @endforeach
</tbody>
        </table>

        <!-- Billing History -->
        <div class="billing-history">
            <h2>Billing Pending Confirmation</h2>
            @foreach ($billings as $billing)
                @if ($billing->status == 'รอยืนยัน')
                    <p>Room: {{ $billing->room->room_number }}</p>
                    <p>Status: {{ $billing->status }}</p>
                    <!-- ปุ่มยืนยันการชำระเงิน -->
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
