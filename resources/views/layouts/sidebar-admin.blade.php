<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
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
        <a href="/cspxx">Customer problem</a>
        <div class="dropdown">
            <button class="dropbtn">Booking</button>
            <div class="dropdown-content">
                <a href="{{ route('booking') }}">Booking</a>
                <a href="{{ route('bookinghistory') }}">Booking History</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Billing</button>
            <div class="dropdown-content">
                <a href="{{ route('adminbilling') }}">Billing</a>
                <a href="{{ route('confirmbill') }}">Billing Confirm</a>
                <a href="{{ route('paymenthistory') }}">Billing History</a>
            </div>
        </div>
        <a href="{{ route('roomdetail') }}">Room Detail</a>
        <a href="{{ route('Addroom') }}">Add Room</a>
    </div>

    <!-- Main Content -->
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

        <!-- Main Content Section -->
        <div class="main-content">
            @yield('content') <!-- ส่วนที่จะแสดงเนื้อหาของแต่ละหน้า -->
        </div>
    </div>
</body>

</html>
