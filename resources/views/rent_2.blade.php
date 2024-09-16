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
    <nav>
        <a href="/"><img src="{{ asset('img/Logo.png') }}" alt="Logo" width="100" height="100"></a>
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
    
        <!-- ฟอร์มการเลือกชำระเงินด้วยบัตรเครดิต -->
        <div class="payment-option">
            <form action="{{ route('rent_3') }}" method="GET">
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                <input type="hidden" name="payment_method" value="credit">
                <button type="submit" class="option-btn">
                    <img src="{{ asset('img/creditcard.png') }}" alt="Credit/Debit Card">
                    <span>บัตรเครดิต/เดบิต</span>
                </button>
            </form>
        </div>
    
        <!-- ฟอร์มการเลือกชำระเงินด้วย QR -->
        <div class="payment-option">
            <form action="{{ route('rent_3') }}" method="GET">
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                <input type="hidden" name="payment_method" value="qr">
                <button type="submit" class="option-btn">
                    <img src="{{ asset('img/qrcode.png') }}" alt="QR Code">
                    <span>สแกนคิวอาร์โค้ด</span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>