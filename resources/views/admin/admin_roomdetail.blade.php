<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
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
    <a href="{{ route('adminbilling') }}">Billing</a>
    <a href="{{ route('roomdetail') }}" class="active">Room Detail</a>
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

    <div class="main-content">
        <div class="room-info">
            <div class="details">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Room number</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $rooms )
                        <tr>
                            <td>{{ $rooms->room_number }}</td>
                            <td>
                            @if ($rooms->room_type_id == "1")
                                Twin Bed Room
                            @elseif ($rooms->room_type_id == "2")
                                Single Bed Room
                            @elseif ($rooms->room_type_id == "3")
                                Premium Bed Room
                            @endif
                            </td>
                            <td>{{ $rooms->description }}</td>
                            <td>
                            @if ($rooms -> is_available == "1")
                                <p style="color:rgb(0, 255, 0)">Available</p>
                            @else
                                <p style="color:red">Occupied</p>
                            @endif 
                        </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>