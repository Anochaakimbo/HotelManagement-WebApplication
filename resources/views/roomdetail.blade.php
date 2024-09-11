<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดห้องพัก</title>
    <link rel="stylesheet" href="{{ asset('css/roomdetail.css') }}">
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
    <div class="container">
        <section class="room-details">
            <div class="room-image">
                <img src="./img/singlebedroom.jpg" alt="ภาพห้อง">
                
                <div class="amenities">
                    
                    <div class="icon">ทีวี</div>
                    <div class="icon">ห้องน้ำ</div>
                    <div class="icon">ไวไฟ</div>
                    <div class="icon">ไมโครเวฟ</div>
                </div>
            </div>
        <div class="room-info">
                <h2>เตียงเดี่ยว</h2>
                <div class="room-description-service">
                    <div class="room-description">
                        <h3>รายละเอียดห้อง</h3>
                        <ul>
                            <li>เตียงเดี่ยวขนาด 3.5 ฟุต</li>
                            <li>โต๊ะและเก้าอี้แบบพรีเมียม</li>
                            <li>เฟอร์นิเจอร์-ตู้</li>
                            <li>เครื่องทำน้ำอุ่น</li>
                            <li>เครื่องปรับอากาศ</li>
                            <li>ขนาดห้อง 28.5 ตร.ม.</li>
                        </ul>
                    </div>
                    <div class="room-service">
                        <h3>บริการหอพัก</h3>
                        <ul>
                            <li>เตียงเดี่ยวขนาด 3.5 ฟุต</li>
                            <li>โต๊ะและเก้าอี้แบบพรีเมียม</li>
                            <li>เฟอร์นิเจอร์-ตู้</li>
                            <li>เครื่องทำน้ำอุ่น</li>
                            <li>เครื่องปรับอากาศ</li>
                            <li>ขนาดห้อง 28.5 ตร.ม.</li>
                        </ul>
                    </div>
                </div>
            </div>
            </section>
            <section class="booking">
                <div class="booking-info">
                    <p>ระยะเวลาเช่า: </p>
                    <p>ค่าห้อง: </p>
                    <p>ค่ามัดจำ: </p>
                </div>
                <a href="{{ route('selectbook') }}" class="btn">จองห้อง</a>
            </section>
    </div>
</body>
</html>
