<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดห้องพัก</title>
    <link rel="stylesheet" href="{{ asset('css/roomdetail.css') }}">
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
                            <li>ทำความสะอาดห้องพัก</li>
                            <li>ซ่อมบำรุงฉุกเฉิน 24 ชั่วโมง</li>
                            <li>อินเทอร์เน็ตความเร็วสูง</li>
                            <li>รักษาความปลอดภัยตลอด 24 ชั่วโมง</li>
                            <li>บริการซักรีด</li>
                            <li>บริการฟิตเนสและพื้นที่ออกกำลังกาย</li>
                        </ul>
                    </div>
                </div>
            </div>
            </section>
            <section class="booking">
                @foreach($rooms as $room)
                <div class="booking-info">
                    <p>ระยะเวลาเช่า: {{ $room->contact_date }} เดือน</p>
                    <p>ค่าห้อง: {{ $room->room_price }} บาท</p>
                    <p>ค่ามัดจำ: {{ $room->deposit_price }} บาท</p>
                </div>
                @endforeach
                <a href="{{ route('selectbook', ['bedType' => 'sing']) }}" class="btn">จองห้อง</a>
            </section>
    </div>
</body>
</html>
