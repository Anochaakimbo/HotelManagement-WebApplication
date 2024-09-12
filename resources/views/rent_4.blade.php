<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rent_4.css') }}">
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
        <div class="step active">
            <div class="step-line"></div>
            <div class="step-circle">3</div>
        </div>
        <div class="step active">
            <div class="step-line"></div>
            <div class="step-circle">4</div>
        </div>
    </div>
    
    <section class="payment-section">
        <h2>สแกนคิวอาร์โค้ด</h2>
        <div class="qr-code">
            <img src="./img/qr code pay.png" alt="QR Code">
            <div class="amount">ยอดชำระ: 7000 บาท</div>
            <div class="amount">แนบสลิปการโอนเงิน:</div>
            <input type="file" id="file-upload" class="slip" >
            <p class="note">*หมายเหตุ กรุณาแนบสลิปการโอนเงินไม่เช่นนั้นจะถือว่าการชำระไม่สำเร็จ</p>
            
        </div>
    </section>
    <footer>
        <a href="{{ route('rent_4') }}" class="btn">ยืนยัน</a>
    </footer>
</body>
</html>