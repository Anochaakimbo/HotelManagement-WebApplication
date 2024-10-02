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
                                .presstologin {
                                    display: none;
                                }
                            </style>
                        @else
                            <style>
                                .presstologin {
                                    display: none;
                                }
                            </style>
                        @endif
                    @endauth
                @endif
            </li>
            <li><a href="#roomtype">ประเภทห้อง</a></li>
            <li><a href="{{ route('booking_detail') }}">การจอง</a></li>
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
        <h2>สแกนคิวอาร์โค้ด</h2>
        <form id="qrPaymentForm" action="{{ route('payment_process_qr') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return checkFileUpload()">

            @csrf
            <div class="qr-code">
                <img src="./img/qr code pay.png" alt="QR Code">
                <div class="amount">ยอดชำระ: 7000 บาท</div>
                <div class="amount">แนบสลิปการโอนเงิน:</div>
                <input type="file" id="file-upload" class="slip" name="payment_slip">
                <p class="note">*หมายเหตุ กรุณาแนบสลิปการโอนเงินไม่เช่นนั้นจะถือว่าการชำระไม่สำเร็จ</p>
            </div>
            <footer>
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                <input type="hidden" name="payment_method" value="qr_code">
                <button type="submit" class="btn" id="submitButton">ยืนยัน</button>
            </footer>
        </form>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ฟังก์ชันตรวจสอบเมื่อกดปุ่มยืนยัน
        function checkFileUpload() {
            var fileInput = document.getElementById('file-upload');
            var form = document.getElementById('qrPaymentForm');

            // ตรวจสอบว่ามีการเลือกไฟล์หรือไม่
            if (fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณาแนบไฟล์ก่อนที่จะยืนยันการชำระเงิน',
                });
                return false;
            }

            // ถ้ามีการเลือกไฟล์แล้ว แสดงการยืนยันชำระเงิน
            Swal.fire({
                title: 'ยืนยันการชำระเงิน?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งฟอร์มไปยังเซิร์ฟเวอร์
                    form.submit();
                }
            });
            return false; // ป้องกันการส่งฟอร์มโดยตรง
        }

        document.getElementById('qrPaymentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มโดยตรง
            checkFileUpload(); // เรียกใช้ฟังก์ชันตรวจสอบและยืนยัน
        });
    </script>
</body>

</html>
