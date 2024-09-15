<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โกลเด้นซิตี้</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="./img/หอ-2.png" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}" class="active">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('Report') }}">แจ้งปัญหา</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <div class="user-info">ผู้ใช้:{{ Auth::user()->name }}</div>
            <button class="logout-button">ล็อกเอาท์</button>
        </div>

        <!-- Main Content -->
        <!-- Main Content -->
<header>
    <h1>ยินดีต้อนรับสู่ระบบ โกลเด้นซิตี้</h1>
</header>
<div class="main-content">
        <div class="room-info">
            <img src="/img/single_room.png" alt="ห้องพัก" class="room-img">
            <div class="details">
                <p><strong>ชื่อผู้เข้าพัก:</strong> {{ Auth::user()->name }}</p>
                <p><strong>ห้อง:</strong> {{ Auth::user()->room->room_number }}</p>
                <p><strong>ประเภทห้อง:</strong> {{ Auth::user()->room->roomType->room_description}}</p>
                <p><strong>ราคาห้อง:</strong> {{ Auth::user()->room->roomType->room_price}}</p>
                <p><strong>สถานะชำระค่าห้อง:</strong>
                    @if(optional(Auth::user()->billing)->status == 'ส่งไปยังผู้ใช้แล้ว')
                        มียอดที่ต้องชำระ
                    @else
                        {{ optional(Auth::user()->billing)->status ?? 'ไม่มียอดคงค้างชำระ' }}
                    @endif
                </p>
                <p><strong>หน่วยค่าไฟ:</strong> {{ Auth::user()->room->roomType->electrical_unit}} บาท/ยูนิต</p>
                <p><strong>หน่วยค่าน้ำ:</strong> {{ Auth::user()->room->roomType->water_unit}} บาท/ยูนิต</p>
                {{--<p><strong>สถานะแก้ไขปัญหา:</strong> {{ Auth::user()->room->roomType->room_price}}</p> --}}
            </div>
        </div>
</div>

        </div>
    </div>
</body>

</html>
