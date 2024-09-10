<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/selectbook.css') }}">
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

    <main>
        <div class="filter">
            <select>
                <option value="ทั้งหมด">ทั้งหมด</option>
                <option value="ว่าง">ว่าง</option>
                <option value="ไม่ว่าง">ไม่ว่าง</option>
            </select>
        </div>
        <h2>เลือกห้องที่ต้องการจอง</h2>
        <table>
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>เลขห้อง</th>
                    <th>ประเภทห้อง</th>
                    <th>ชั้น</th>
                    <th>ราคา</th>
                    <th>สถานะห้อง</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>A101</td>
                    <td>เตียงเดี่ยว</td>
                    <td>1</td>
                    <td>5000</td>
                    <td class="available">ว่าง</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>A202</td>
                    <td>เตียงเดี่ยว</td>
                    <td>2</td>
                    <td>5000</td>
                    <td class="available">ว่าง</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>B103</td>
                    <td>เตียงคู่</td>
                    <td>1</td>
                    <td>6000</td>
                    <td class="unavailable">ไม่ว่าง</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>K304</td>
                    <td>เตียงคิงไซส์</td>
                    <td>3</td>
                    <td>6500</td>
                    <td class="unavailable">ไม่ว่าง</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>K305</td>
                    <td>เตียงคิงไซส์</td>
                    <td>3</td>
                    <td>6500</td>
                    <td class="available">ว่าง</td>
                </tr>
            </tbody>
        </table>
        <div class="page">
            <button>หน้าแรก</button>
            <button class = "now">1</button>
            <button>2</button>
            <button>...</button>
            <button>หน้าสุดท้าย</button>
        </div>
        <div class="continue">
            <button>ต่อไป</button>
        </div>
    </main>
    @foreach ($rooms as $room)
    <p>{{ $room->room_number }} 
    - Status: {{ $room->is_available ? 'ห้องว่าง' : 'ห้องไม่ว่าง' }}</p>

    @if ($room->is_available)
        <!-- ฟอร์มกรอกข้อมูลสำหรับจองห้อง -->
        <form action="/guest/book" method="POST">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>
            
            <button type="submit">Book Now</button>
        </form>
    @else
        <button disabled>ไม่สามารถจองได้</button>
    @endif
@endforeach
@foreach ($bookings as $booking)
    <p>{{ $booking->room->room_number }} - Status: {{ $booking->status }}</p>

    @if ($booking->status == 'รอชำระเงิน')
        <form action="/guest/bookings/{{ $booking->id }}/pay" method="POST">
            @csrf
            <button type="submit">Pay Now</button>
        </form>
    @endif
@endforeach
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</body>
</html>