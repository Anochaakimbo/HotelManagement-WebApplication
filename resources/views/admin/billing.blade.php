<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails1.css') }}">
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
    <a href="{{ route('adminbilling') }}"class="active">Billing</a>
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
        <div class="user-info dropdown">
            <!-- ปุ่มสำหรับ dropdown -->
            <span class="dropbtn">User: {{ Auth::user()->name }}</span>
            <!-- เนื้อหาของ dropdown -->
            <div class="dropdown-content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>
                <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
    </div>
</div>
</div>
    <a href="{{ route('history')}}">PAYMENT HISTORY</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Form รวมปุ่มส่งสำหรับห้องทั้งหมด -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('EASYOKOK') }}" method="POST">
    @csrf
    <label for="room">เลือกห้อง:</label>
    <select id="room" name="room_id" required>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}">ห้อง {{ $room->room_number }} - ผู้ใช้: {{ $room->user->name }}</option>
        @endforeach
    </select>
    
    <label for="water_units">หน่วยน้ำที่ใช้:</label>
    <input type="number" id="water_units" name="water_units" min="0" required>
    
    <label for="electric_units">หน่วยไฟที่ใช้:</label>
    <input type="number" id="electric_units" name="electric_units" min="0" required>
    
    <label for="room_price">ค่าห้อง:</label>
    <input type="number" id="room_price" name="room_price" required>
    
    <button type="submit">ส่งค่าห้อง</button>
</form>

<h2>การเรียกเก็บเงินที่ส่งไปแล้ว</h2>
@foreach ($billings as $billing)
    @if ($billing->status == 'ส่งไปยังผู้ใช้แล้ว')
        <p>ห้อง: {{ $billing->room->room_number }}</p>
        <p>ค่าสถานะ: {{ $billing->status }}</p>
        <hr>
    @endif
@endforeach

<h2>การเรียกเก็บเงินที่รอยืนยัน</h2>
@foreach ($billings as $billing)
    @if ($billing->status == 'รอยืนยัน')
        <p>ห้อง: {{ $billing->room->room_number }}</p>
        <form action="{{ route('confirmPayment', $billing->id) }}" method="POST">
            @csrf
            <button type="submit">ยืนยันการชำระเงิน</button>
        </form>
    @endif
@endforeach

</body>
</html>
