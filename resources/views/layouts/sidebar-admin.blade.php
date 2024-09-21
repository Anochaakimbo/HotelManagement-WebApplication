<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails1.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <!-- Sidebar -->
<div class="sidebar">
    <a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? '' : '' }}">
        <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="logo">
    </a>
    <a href="{{ route('adminpage') }}" class="{{ Request::routeIs('adminpage') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('guestpage') }}" class="{{ Request::routeIs('guestpage') ? 'active' : '' }}">Guest</a>
    <a href="{{ route('customerproblem') }}" class="{{ Request::routeIs('customerproblem') ? 'active' : '' }}">Customer problem</a>
    <div class="dropdown">
        <button class="dropbtn {{ Request::routeIs('booking', 'bookinghistory') ? 'active' : '' }}">Booking</button>
        <div class="dropdown-content">
            <a href="{{ route('booking') }}" class="{{ Request::routeIs('booking') ? 'active' : '' }}">Booking</a>
            <a href="{{ route('bookinghistory') }}" class="{{ Request::routeIs('bookinghistory') ? 'active' : '' }}">Booking History</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn {{ Request::routeIs('adminbilling', 'confirmbill', 'paymenthistory') ? 'active' : '' }}">Billing</button>
        <div class="dropdown-content">
            <a href="{{ route('adminbilling') }}" class="{{ Request::routeIs('adminbilling') ? 'active' : '' }}">Billing</a>
            <a href="{{ route('confirmbill') }}" class="{{ Request::routeIs('confirmbill') ? 'active' : '' }}">Billing Confirm</a>
            <a href="{{ route('paymenthistory') }}" class="{{ Request::routeIs('paymenthistory') ? 'active' : '' }}">Billing History</a>
        </div>
    </div>
    <a href="{{ route('roomdetail') }}" class="{{ Request::routeIs('roomdetail') ? 'active' : '' }}">Room Detail</a>
    <a href="{{ route('Addroom') }}" class="{{ Request::routeIs('Addroom') ? 'active' : '' }}">Add Room</a>
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
