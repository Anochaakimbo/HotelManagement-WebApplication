<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rent_2.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">หน้าหลัก</a></li>
                <li><a href="#">ตรวจสอบห้องว่าง</a></li>
                <li><a href="#">ประเภทห้อง</a></li>
                <li><a href="#">การจอง</a></li>
                <li><a href="#">ติดต่อเรา</a></li>
                <li><a href="#">ล็อกอิน</a></li>
            </ul>
        </nav>
    </header>
    <div class="step-progress">
        <div class="step active">
            <div class="step-line"></div>
            <div class="step-circle">1</div>
        </div>
        <div class="step active">
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

    <div class="container">
        <h2>เลือกประเภทจ่ายค่าจอง</h2>

        <div class="payment-option">
            <button class="option-btn">
                <img src="./img/creditcard.png" alt="Credit/Debit Card">
                <span>บัตรเครดิต/เดบิต</span>
            </button>
        </div>

        <div class="payment-option">
            <button class="option-btn">
                <img src="./img/qrcode.png" alt="QR Code">
                <span>สแกนคิวอาร์โค้ด</span>
            </button>
        </div>
        <div class="next-button">
            <button type="button">ต่อไป</button>
        </div>
    </div>