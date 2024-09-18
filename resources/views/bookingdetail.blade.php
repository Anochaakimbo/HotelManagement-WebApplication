<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bookingdetail.css') }}">
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
            <li><a href="#roomtype">ประเภทห้อง</a></li>
            <li><a href="#book">การจอง</a></li>
            <li><a href="#contactus">ติดต่อเรา</a></li>
            <li class="presstologin"><a href="/login">ล็อกอิน</a></li>
        </ul>
    </nav>

    <section class="booking-details">
        <h2>รายละเอียดการจองห้อง</h2>
        <table>
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>เลขห้อง</th>
                    <th>ประเภทห้อง</th>
                    <th>ค่ามัดจำ</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->room->room_number }}</td> <!-- แสดงเลขห้องจากตาราง rooms -->

                        <td>
                            @if( $booking->room->roomType->room_description == 'Premium')
                                เตียงเดี่ยวพรีเมี่ยม
                            @elseif($booking->room->roomType->room_description == 'Single')
                                เตียงเดี่ยว
                            @elseif($booking->room->roomType->room_description == 'Twin')
                                เตียงคู่
                            @endif
                        </td>   <!-- แสดงประเภทห้องจากตาราง room_types -->
                        <td>{{ $booking->room->roomType->deposit_price }}</td> <!-- แสดงค่ามัดจำจากตาราง room_types -->
                        <td>
                            @if ($booking->status == 'จองสำเร็จ')
                                <span class="status-confirmed">จองสำเร็จ</span>
                            @elseif ($booking->status == 'รอยืนยัน')
                                <span class="status-pending">รอยืนยันการชำระเงิน</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <a href="/" class="btn">กลับหน้าหลัก</a>
    </section>

</body>
</html>
