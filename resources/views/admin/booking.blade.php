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
            <img src="{{ asset('img/หอ-2.png') }}" alt="Logo" class="logo">
        </a>        
    <a href="{{ route('adminpage') }}">Dashboard</a>
    <a href="{{ route('guestpage') }}">Guest</a>
    <a href="{{ route('customerproblem') }}">Customer problem</a>
    <a href="{{ route('booking') }}"class="active">Booking</a>
    <a href="{{ route('adminbilling') }}">Billing</a>
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
            <span class="dropbtn">ผู้ใช้: {{ Auth::user()->name }}</span>
            <!-- เนื้อหาของ dropdown -->
            <div class="dropdown-content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>
                <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
    </div>
        </div>
    </div>
    <div class="main-content">
        <div class="room-info">
            <div class="details">
                BOOKING INFORMATION
                <table border="1">
                    <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Guest Name</th>
                            <th>Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <!-- กดที่เลขห้องเพื่อไปยังหน้าที่ยืนยันการจอง -->
                                    <a href="{{ route('admin.booking.confirm', $booking->id) }}">
                                        {{ $booking->room->room_number }}
                                    </a>
                                </td>
                                <td>{{ $booking->guest->name }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>