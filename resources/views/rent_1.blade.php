<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rent_1.css') }}">
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
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
        <div class="step">4</div>
    </div>

    <div class="form-section">
        <h2>กรอกข้อมูล</h2>
        <form action="submit_form.php" method="POST">
            <label for="firstname">ชื่อ :</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">นามสกุล :</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="phone">เบอร์โทรศัพท์ :</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">อีเมล :</label>
            <input type="email" id="email" name="email" required>

            <label for="room_number">เลขห้อง :</label>
            <input type="text" id="room_number" name="room_number" required>

            <label for="room_type">ประเภทของห้อง :</label>
            <input type="text" id="room_type" name="room_type" required>

            <label for="contract_duration">ระยะสัญญา :</label>
            <input type="text" id="contract_duration" name="contract_duration" required>

            <label for="deposit">ค่าประกัน :</label>
            <input type="text" id="deposit" name="deposit" required>

            <button type="submit">ต่อไป</button>
        </form>
    </div>
</body>
</html>