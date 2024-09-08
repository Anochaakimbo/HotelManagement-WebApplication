<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/report.css')}}">
</head>
<body>
 <!-- Sidebar -->
   <div class="sidebar">
        <img src="./img/หอ-2.png" alt="Logo" class="logo">
    <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
    <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
    <a href="{{ route('Report') }}"class="active">แจ้งปัญหา</a>
</div>
    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <div class="user-info">ผู้ใช้</div>
            <button>ล็อกเอาท์</button>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <h2>แจ้งปัญหา</h2>
            <form>
                <label for="room">ห้อง</label>
                <input type="text" id="room" name="room" value="A502" readonly>

                 <label for="main-category">เลือกหมวดงานซ่อมหลัก</label>
                <select id="main-category" name="main-category">
                    <option value="">เลือกหมวดงานซ่อมหลัก</option>
                    <option value="aircon">เครื่องปรับอากาศ (แอร์)</option>
                    <option value="water-heater">เครื่องทำน้ำอุ่น</option>
                    <option value="electricity">ไฟฟ้าและหลอดไฟ</option>
                    <option value="door-window">ประตูและหน้าต่าง</option>
                    <option value="furniture">เฟอร์นิเจอร์</option>
                    <option value="plumbing">ระบบประปา</option>
                    <option value="bathroom">ห้องน้ำ</option>
                    <option value="washing-machine">เครื่องซักผ้า (ถ้ามีในห้อง)</option>
                    <option value="wall-floor">ผนังและพื้นห้อง</option>
                    <option value="internet-tv">อินเทอร์เน็ตและโทรทัศน์</option>
                </select>


        <label for="sub-category">เลือกหมวดงานซ่อมย่อย</label>
     <select id="sub-category" name="sub-category">
    <option value="">เลือกหมวดงานซ่อมย่อย</option>
    <!-- งานซ่อมย่อยสำหรับเครื่องปรับอากาศ (แอร์) -->
    <option value="aircon1">ไม่เย็น</option>
    <option value="aircon2">รั่วซึม</option>
    <option value="aircon3">เสียงดัง</option>

    <!-- งานซ่อมย่อยสำหรับเครื่องทำน้ำอุ่น -->
    <option value="water-heater1">ไม่ทำงาน</option>
    <option value="water-heater2">รั่วซึม</option>
    <option value="water-heater3">น้ำไม่ร้อน</option>

    <!-- งานซ่อมย่อยสำหรับไฟฟ้าและหลอดไฟ -->
    <option value="electricity1">หลอดไฟเสีย</option>
    <option value="electricity2">สวิตช์ไฟไม่ทำงาน</option>
    <option value="electricity3">ปลั๊กไฟหลวม</option>

    <!-- งานซ่อมย่อยสำหรับประตูและหน้าต่าง -->
    <option value="door-window1">ลูกบิดประตูเสีย</option>
    <option value="door-window2">ประตูหรือหน้าต่างปิดไม่สนิท</option>
    <option value="door-window3">บานพับชำรุด</option>

    <!-- งานซ่อมย่อยสำหรับเฟอร์นิเจอร์ -->
    <option value="furniture1">โต๊ะชำรุดหรือเสียหาย</option>
    <option value="furniture2">เก้าอี้ชำรุดหรือเสียหาย</option>
    <option value="furniture3">ตู้เสื้อผ้าชำรุดหรือเสียหาย</option>

    <!-- งานซ่อมย่อยสำหรับระบบประปา -->
    <option value="plumbing1">ท่อน้ำรั่ว</option>
    <option value="plumbing2">น้ำไม่ไหล</option>
    <option value="plumbing3">ก๊อกน้ำหรือสายชำระเสีย</option>

    <!-- งานซ่อมย่อยสำหรับห้องน้ำ -->
    <option value="bathroom1">ชักโครกเสีย</option>
    <option value="bathroom2">อ่างล้างหน้าอุดตัน</option>
    <option value="bathroom3">ระบายน้ำช้า</option>

    <!-- งานซ่อมย่อยสำหรับเครื่องซักผ้า -->
    <option value="washing-machine1">เครื่องไม่ทำงาน</option>
    <option value="washing-machine2">ปั่นไม่หมาด</option>

    <!-- งานซ่อมย่อยสำหรับผนังและพื้นห้อง -->
    <option value="wall-floor1">ผนังร้าว</option>
    <option value="wall-floor2">พื้นเสียหายหรือหลุดร่อน</option>

    <!-- งานซ่อมย่อยสำหรับอินเทอร์เน็ตและโทรทัศน์ -->
    <option value="internet-tv1">อินเทอร์เน็ตไม่เชื่อมต่อ</option>
    <option value="internet-tv2">โทรทัศน์สัญญาณขัดข้อง</option>
</select>

                <label for="problem-description">อาการ/ปัญหา</label>
                <textarea id="problem-description" name="problem-description" rows="4" placeholder="อาการหรือปัญหา..."></textarea>

                <label for="contact-number">เบอร์โทรศัพท์ที่ติดต่อ</label>
                <input type="text" id="contact-number" name="contact-number" placeholder="เบอร์โทรศัพท์">

                <label>กรณีผู้เช่าไม่อยู่ห้อง อนุญาตให้ช่างเข้ามาซ่อมหรือไม่?</label>
                <div>
                    <input type="radio" id="allow" name="permission" value="allow">
                    <label for="allow">อนุญาต</label>

                    <input type="radio" id="disallow" name="permission" value="disallow">
                    <label for="disallow">ไม่อนุญาต</label>
                </div>

                <button type="submit">ส่งคำขอซ่อม</button>
            </form>
        </div>
    </div>
</body>
</html>
