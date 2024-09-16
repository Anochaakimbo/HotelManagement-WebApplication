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
    <a href="{{ route('roomdetail') }}">Room Detail</a>
    <a href="{{ route('Addroom') }}" class="active">Add Room</a>
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
        <form action="/Addroom/addroom" method="POST">
            @csrf
            <label for="">Room Type:</label><br>
            <select name="room_type_id" id="" required>
                @foreach ($rooms as $room )
                <option value="{{ $room->id }}">
                    @if ($room->id == "1")
                    Twin Bed Room
                @elseif ($room->id == "2")
                    Single Bed Room
                @elseif ($room->id == "3")
                    Premium Bed Room
                @endif
                </option>
                @endforeach
            </select>
            <br>
            <br>
            <label for="">Room Number:</label><br>
            <input type="text" name="room_number">
            <br>
            <br>
            <label for="">Floor:</label><br>
            <input type="number" name="floor" id="">
            <br>
            <label for="">Description:</label>
            <br>
            <textarea name="description" id="" cols="30" rows="10" required></textarea>
            <br>
            <button type="submit" onclick="return confirm('Are you sure you want to add room?')" class="submitbutton">Submit</button>


        </form>
    </div>
</div>
</body>
</html>