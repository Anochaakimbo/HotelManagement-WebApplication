<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โกลเด้นซิตี้</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails.css') }}">
</head>

<body>
    <div class="sidebar">
        <img src="./img/Logo.png" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}" class="active">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('Report') }}">แจ้งปัญหา</a>
        <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>

    </div>

    <div class="content">
        <div class="header">
            <form method="POST" action="{{ route('logout') }}" x-data class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <div class="user-info dropdown">
                <span class="dropbtn">User: {{ Auth::user()->name }}</span>
                <div class="dropdown-content">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>
                    <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                </div>
            </div>
        </div>

        <header>
            <h1>ยินดีต้อนรับสู่ระบบ โกลเด้นซิตี้</h1>
        </header>
        <div class="main-content">
            <div class="room-info">
                @if (Auth::user()->room->roomType->room_description == 'Single')
                    <img src="./img/singlebedroom.jpg" alt="ห้องพัก Single" class="room-img">
                @elseif (Auth::user()->room->roomType->room_description == 'Premium')
                    <img src="./img/premiumbedroom.jpg" alt="ห้องพัก Premium" class="room-img">
                @elseif (Auth::user()->room->roomType->room_description == 'Twin')
                    <img src="./img/twinbedroom.jpg" alt="ห้องพัก Twin" class="room-img">
                @endif
                <div class="details">
                    <p><strong>ชื่อผู้เข้าพัก:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>ห้อง:</strong> {{ Auth::user()->room->room_number }}</p>
                    <p><strong>ประเภทห้อง:</strong> {{ Auth::user()->room->roomType->room_description }}</p>
                    <p><strong>ราคาห้อง:</strong> {{ Auth::user()->room->roomType->room_price }}</p>
                    <p><strong>สถานะชำระค่าห้อง:</strong>
                        @if (Auth::user()->billing && Auth::user()->billing->status == 'ส่งไปยังผู้ใช้แล้ว')
                        มียอดที่ต้องชำระ
                    @else
                        {{ Auth::user()->billing->status ?? 'ไม่มียอดคงค้างชำระ' }}
                    @endif
                    </p>
                    <p><strong>หน่วยค่าไฟ:</strong> {{ Auth::user()->room->roomType->electrical_unit }} บาท/ยูนิต</p>
                    <p><strong>หน่วยค่าน้ำ:</strong> {{ Auth::user()->room->roomType->water_unit }} บาท/ยูนิต</p>
                    <p>วันหมดสัญญา: {{ $contractEndDate->format('Y-m-d') }}</p>
                    @if ($remainingDays > 0)
                    <p>ระยะเวลาคงเหลือ: {{ $remainingDays }} วัน</p>
                    @else
                    <p>สัญญาหมดแล้วกรุณาติดต่อเพื่อต่อสัญญากับหอพักได้ที่ห้องส่วนกลาง</p>

                    @endif
                </div>
            </div>
        </div>

    </div>
    </div>
</body>

</html>
