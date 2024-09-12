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
        <ul class="page">
            <li data-page="first" class="page-item">หน้าแรก</li>
            <li data-page="1" class="page-item">1</li>
            <li data-page="2" class="page-item">2</li>
            <li data-page="last" class="page-item">หน้าสุดท้าย</li>
        </ul>
        <a href="{{ route('rent_1') }}" class="btn">ต่อไป</a>
    </main>

    <script>
        // อันที่คลิ๊กเปลี่ยน สีพื้นหลัง
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                rows.forEach(r => r.classList.remove('selected'));
                row.classList.add('selected');
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        let currentPage = 1; // ตั้งค่าหน้าปัจจุบัน (หน้า 2 ในตอนเริ่มต้น)
        const pageItems = document.querySelectorAll('.page-item');

        function updateActivePage(pageNum) {
            pageItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-page') == pageNum) {
                    item.classList.add('active');
                }
            });
            currentPage = pageNum; // อัปเดตหน้าปัจจุบัน
        }

        // ตั้งค่าให้หน้าเริ่มต้นเป็นหน้าที่ถูกเลือก
        updateActivePage(currentPage);

        pageItems.forEach(item => {
            const pageNum = item.getAttribute('data-page');

            // เพิ่ม event เมื่อคลิกที่ปุ่มต่างๆ
            item.addEventListener('click', function () {
                if (pageNum === 'first') {
                    // ถ้าคลิกปุ่มหน้าแรก ให้เลือกหน้า 1
                    updateActivePage(1);
                } else if (!isNaN(pageNum)) {
                    // ถ้าคลิกที่ปุ่มตัวเลข ให้เปลี่ยนไปยังหน้าที่คลิก
                    updateActivePage(parseInt(pageNum));
                }
            });
        });
    });

    </script>
</body>
</html>