<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        @import url( {{asset('css/guestpage.css')}});
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

    <nav>
    @if (Route::has('login'))
    @auth
        @if (Auth::user()->usertype == 'admin')
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @endif
    @endauth
    @endif  
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="material-icons">&#xe896;</i>
        </label>
            <a href="/"><img src="./img/Logo.png" alt="Logo" width="100" height="100"></a>
        <ul>
            <li><a href="#home" class="active">หน้าหลัก</a></li>
            <li><a href="#check">ตรวจสอบห้องว่าง</a></li>
            <li><a href="#roomtype">ประเภทห้อง</a></li>
            <li><a href="#book">การจอง</a></li>
            <li><a href="#contact">ติดต่อเรา</a></li>
            <li><a href="/login">ล็อกอิน</a></li>
        </ul>
    </nav>

    <div class="image-container">
        <img src="./img/Wall3.jpg" alt="wallpaper" class="wallpaper">
        <div class="text-overlay">
            <h2>ยินดีต้อนรับสู่</h2>
            <h1>โกลเด้นซิตี้</h1>
            <p>เปิดจองแล้ววันนี้ <br> หอพักแห่งใหม่ ติด มข. <br> เหมาะแก่การพักผ่อนและอยู่อาศัย</p>

        </div>
    </div>

    <h1 class="typeroomtext">ประเภทห้อง</h1>
    
    
<div class="image-type" id="roomtype">
    <div class="typeone">
        <a href="#type1"><img src="./img/singlebedroom1.jpg" alt=""></a>
    </div>
    <div class="typetwo">
        <a href="#type2"><img src="./img/twinbedroom2.jpg" alt=""></a>
    </div>
    <div class="typethree">
        <a href="#type3"><img src="./img/premiumroom1.jpg" alt=""></a>
    </div>
</div>

    <h1 class="typeroomtext">สิ่งอำนวยความสะดวก</h1>

    <div class="gym">
        <img src="./img/gym.jpg" alt="">
        <div class="desgym">
            <p>เติมเต็มตัวเองด้วยการออกกำลังกายสุดแกร่ง<br>
        หอพักโกลเด้นซิตี้มีบริการฟิตเนสตลอด24ชั่วโมง<br>
        คุณสามารถออกกำลังกายโดยไม่จำกัดเวลา<br>
        จนคุณจะกลายเป็นพรี่ๆสุดหล่อ
            </p>
        </div>
    </div>

    <br>

    <div class="lift">
        <div>
            <p class="deslift">
            ไม่ต้องเหนื่อยเดินขึ้นลงกับบรรไดอีกต่อไป<br>
            หอพักโกลเด้นซิตี้มีบริการลิฟท์ให้ผู้พักได้ใช้งานตลอดเวลา<br>
            และยังมีระบบขอความช่วยเหลือได้ตลอดเวลา
            </p>
        </div>
        <img src="./img/lift.jpg" alt="">
    </div>

    <br>
<img src="./img/facilities.jpg" alt="" class="footerfac">
<footer>  
©Copyright 2024 All right reserved.
</footer>
</body>
</html>