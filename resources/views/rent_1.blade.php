<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rent_1.css') }}">
</head>
<body>
        <nav>
                <a href="/"><img src="./img/Logo.png" alt="Logo" width="100" height="100"></a>
            <ul>
                <li>
                    @if (Route::has('login'))
        @auth
            @if (Auth::user()->usertype == 'admin')
                <a href="{{ url('/home') }}">จัดการห้อง</a>
                <style>
                    .presstologin{
                        display:none;
                    }
                </style>
            @else
            <style>
                .presstologin{
                    display:none;
                }
            </style>
            
            @endif
        @endauth
    @endif  
    </li>
                <li><a href="#check">ตรวจสอบห้องว่าง</a></li>
                <li><a href="#roomtype">ประเภทห้อง</a></li>
                <li><a href="#book">การจอง</a></li>
                <li><a href="#contactus">ติดต่อเรา</a></li>
                <li class="presstologin"><a href="/login">ล็อกอิน</a></li>
            </ul>
        </nav>
        
    <div class="step-progress">
        <div class="step active">
            <div class="step-line"></div>
            <div class="step-circle">1</div>
        </div>
        <div class="step">
            <div class="step-line"></div>
            <div class="step-circle">2</div>
        </div>
        <div class="step">
            <div class="step-line"></div>
            <div class="step-circle">3</div>
        </div>
        <div class="step">
            <div class="step-line"></div>
            <div class="step-circle">4</div>
        </div>
    </div>

    <div class="form-section">
        <h2>กรอกข้อมูล</h2>
        <form action="{{ route('guests.store') }}" method="POST">
            @csrf
            <label for="firstname">ชื่อ :</label>
            <input type="text" id="firstname" name="firstname" required>
        
            <label for="lastname">นามสกุล :</label>
            <input type="text" id="lastname" name="lastname" required>
        
            <label for="phone">เบอร์โทรศัพท์ :</label>
            <input type="tel" id="phone" name="phone" required>
        
            <label for="email">อีเมล :</label>
            <input type="email" id="email" name="email" required>
        
            <label for="room_number">เลขห้อง :</label>
            <input type="text" id="room_number" name="room_number" value="{{ request('room_number') }}" readonly>
        
            <label for="room_type">ประเภทของห้อง :</label>
            <input type="text" id="room_type" name="room_type" value="{{ request('room_type') }}" readonly>
        
            <label for="contract_duration">ระยะสัญญา :</label>
            <input type="text" id="contract_duration" name="contract_duration" value="{{ request('contract_duration') }}" readonly>
        
            <label for="deposit">ค่าประกัน :</label>
            <input type="text" id="deposit" name="deposit" value="{{ request('deposit') }}" readonly>
        
            <button type="submit" class="btn">ต่อไป</button>
        </form>
    </div>
</body>
</html>