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
            <li><a href="{{ route('booking_detail')}}">การจอง</a></li>
            <li><a href="#contactus">ติดต่อเรา</a></li>
            <li class="presstologin"><a href="/login">ล็อกอิน</a></li>
        </ul>
    </nav>

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

        <main>
            <h2>ใบเสร็จชำระเงิน</h2>

            <table>
                <thead>
                    <tr>
                        <th>ชื่อ</th>
                        <th>เลขห้อง</th>
                        <th>ประเภทของห้อง</th>
                        <th>ระยะสัญญา</th>
                        <th>ช่องทางชำระเงิน</th>
                        <th>ยอดชำระการจอง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $room->room_number }}</td>
                        <td>
                            @if($roomType->room_description == 'Premium')
                                เตียงเดี่ยวพรีเมี่ยม
                            @elseif($roomType->room_description == 'Single')
                                เตียงเดี่ยว
                            @elseif($roomType->room_description == 'Twin')
                                เตียงคู่
                            @endif
                        </td>
                        <td>{{ $roomType->contact_date }} เดือน</td>
                        <td>
                            @if($paymentMethod == 'qr')
                                สแกนคิวอาร์โค้ด
                            @elseif($paymentMethod == 'credit')
                                บัตรเครดิต/เดบิต
                            @endif
                        </td>
                        <td>{{ $roomType->deposit_price }} บาท</td>
                    </tr>
                </tbody>
            </table>
        </main>

        <form id="paymentForm" method="get">
            <input type="hidden" name="guest_id" value="{{ $guest->id }}">
            <input type="hidden" name="payment_method" id="paymentMethod" value="{{ $paymentMethod }}">
            <button type="submit" class="btn">ต่อไป</button>
        </form>

        <script>
            document.getElementById('paymentForm').addEventListener('submit', function (e) {
                e.preventDefault(); // หยุดการส่งฟอร์มปกติ

                var paymentMethod = document.getElementById('paymentMethod').value; // ดึงค่า payment_method

                if (paymentMethod === 'credit') {
                    // ส่งฟอร์มไปยังเส้นทาง rent_4 สำหรับการชำระด้วยบัตรเครดิต
                    this.action = "{{ route('rent_4_2') }}";
                } else if (paymentMethod === 'qr') {
                    // ส่งฟอร์มไปยังเส้นทาง rent_4_2 สำหรับการชำระด้วย QR code
                    this.action = "{{ route('rent_4') }}";
                }

                this.submit(); // ส่งฟอร์มอีกครั้งหลังจากตั้งค่า action
            });
        </script>

</body>
</html>
