<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rent_3.css') }}">
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
        <div class="step">
            <div class="step-line"></div>
            <div class="step-circle">4</div>
        </div>
    </div>

    <h2>ใบเสร็จชำระเงิน</h2>

        <table>
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>เลขห้อง</th>
                    <th>ประเภทของห้อง</th>
                    <th>ระยะสัญญา</th>
                    <th>ช่องทางชำระเงิน</th>
                    <th>ยอดชำระ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>อรรถนนท์</td>
                    <td>502</td>
                    <td>เตียงเดี่ยว</td>
                    <td>12 เดือน</td>
                    <td>สแกนคิวอาร์โค้ด</td>
                    <td>7,000 บาท</td>
                </tr>
            </tbody>
        </table>


    <a href="{{ route('rent_4') }}" class="btn">ต่อไป</a>

</body>
</html>