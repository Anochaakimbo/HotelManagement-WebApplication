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
        <div class="step active">
            <div class="step-line"></div>
            <div class="step-circle">4</div>
        </div>
    </div>

    <section class="payment-section">
        <h2>จ่ายด้วยบัตรเครดิต</h2>
        <form id="creditCardForm" action="{{ route('payment_process') }}" method="POST" onsubmit="return validateForm()">
            @csrf
            <div class="credit-card-form">

                <label for="cardNumber">หมายเลขบัตรเครดิต:</label>
                <input type="text" id="cardNumber" name="card_number" maxlength="19" placeholder="1234 5678 9012 3456" required oninput="formatCardNumber(this)">

                <label for="cardName">ชื่อบนบัตร:</label>
                <input type="text" id="cardName" name="card_name" placeholder="ชื่อที่ปรากฏบนบัตร" required>

                <label for="expiryDate">วันหมดอายุ:</label>
                <input type="text" id="expiryDate" name="expiry_date" maxlength="5" placeholder="MM/YY" required>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123" required>

                <p class="note">*หมายเหตุ กรุณากรอกข้อมูลให้ครบ</p>
            </div>
            <footer>
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
                <button type="submit" class="btn" id="submitButton">ยืนยัน</button>
            </footer>
        </form>
    </section>



    <script>
        function formatCardNumber(input) {
            // ลบช่องว่างที่มีอยู่ทั้งหมดก่อน
            let value = input.value.replace(/\s+/g, '');

            // เพิ่มช่องว่างหลังจากทุกๆ 4 ตัวอักษร
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';

            // ตั้งค่าให้เป็นค่าที่จัดรูปแบบแล้ว
            input.value = formattedValue;
        }

        // ฟังก์ชันในการตรวจสอบฟอร์ม
        function validateForm() {
            var cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, ''); // ลบช่องว่างออกเพื่อทำการตรวจสอบ
            var cardName = document.getElementById('cardName').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvv = document.getElementById('cvv').value;


            // ตรวจสอบว่าข้อมูลครบถ้วนและถูกต้องหรือไม่
             if (cardNumber.length !== 16) {  // ตรวจสอบเฉพาะตัวเลขและความยาว 16 หลัก
                alert('กรุณากรอกหมายเลขบัตรเครดิตที่ถูกต้อง');
                return false;
            }

            else if (cardName === '') {
                alert('กรุณากรอกชื่อบนบัตร');
                return false;
            }

            else if (!expiryDate.match(/^(0[1-9]|1[0-2])\/\d{2}$/)) {
                alert('กรุณากรอกวันหมดอายุในรูปแบบ MM/YY');
                return false;
            }

            else if (cvv.length !== 3 || isNaN(cvv)) {
                alert('กรุณากรอก CVV ที่ถูกต้อง');
                return false;
            }
            // แสดงข้อความยืนยันและนำไปยังหน้าแรกหลังจากยืนยันการชำระเงิน
            else if (confirm("คุณต้องการยืนยันการชำระเงินหรือไม่?")) {
                alert("ชำระเงินเสร็จสิ้น");
                return true; // ส่งฟอร์ม
            }

            return false; // หยุดการส่งฟอร์มหากยกเลิกการยืนยัน
        }
    </script>



</body>
</html>
