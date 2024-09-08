<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โกลเด้นซิตี้</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="./img/หอ-2.png" alt="Logo" class="logo">
    <a href="{{ route('Roomdetails') }}"class="active">รายละเอียดห้อง</a>
    <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
    <a href="{{ route('Report') }}">แจ้งปัญหา</a>
</div>


    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <div class="user-info">ผู้ใช้</div>
            <button class="logout-button">ล็อกเอาท์</button>
        </div>

        <!-- Main Content -->
        <header>
            <h1>ยินดีต้อนรับสู่ระบบ โกลเด้นซิตี้</h1>
        </header>
        <div class="main-content">
            <div class="room-info">
                <img src="/img/single_room.png" alt="ห้องพัก" class="room-img">
                <div class="details">
                    <p><strong>ชื่อผู้เข้าพัก:</strong> นายไมเคิล ปาร์กเกอร์</p>
                    <p><strong>ห้อง:</strong> A502</p>
                    <p><strong>ประเภทห้อง:</strong> เตียงเดี่ยว</p>
                    <p><strong>หน่วยค่าไฟ:</strong> 10 ยูนิต</p>
                    <p><strong>หน่วยค่าน้ำ:</strong> 7 ยูนิต</p>
                    <p><strong>สถานะชำระค่าห้อง:</strong> ชำระเรียบร้อยแล้ว</p>
                    <p><strong>สถานะแก้ไขปัญหา:</strong> ไม่มี</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
