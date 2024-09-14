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
            <select id="filterStatus">
                <option value="ทั้งหมด">ทั้งหมด</option>
                <option value="ว่าง">ว่าง</option>
                <option value="ไม่ว่าง">ไม่ว่าง</option>
            </select>
        </div>

        
        <h2>เลือกห้องที่ต้องการจอง</h2>
        <table>
            <thead>
                <tr>
                    <th>เลขห้อง</th>
                    <th>ประเภทห้อง</th>
                    <th>ชั้น</th>
                    <th>ราคา</th>
                    <th>สถานะห้อง</th>
                </tr>
            </thead>
            <tbody id="roomTable">
                @foreach($rooms as $index => $room)
                <tr data-room-type="{{ $room->roomType->room_description }}" 
                    data-room-status="{{ $room->is_available ? 'ว่าง' : 'ไม่ว่าง' }}">

                    <td>{{ $room->room_number }}</td> <!-- เลขห้อง -->
                    <td>
                        @if($room->roomType->room_description === 'Pre')
                            Premium Bed
                        @elseif($room->roomType->room_description === 'Sing')
                            Single Bed
                        @elseif($room->roomType->room_description === 'Two')
                            Two Bed
                        @else
                            {{ $room->roomType->room_description }}
                        @endif
                    </td> <!-- ประเภทห้อง -->
                    <td>{{ $room->floor }}</td> <!-- ชั้น -->
                    <td>{{ $room->roomType->room_price }}</td> <!-- ราคา -->
                    <td class="{{ $room->is_available ? 'available' : 'unavailable' }}">
                        {{ $room->is_available ? 'ว่าง' : 'ไม่ว่าง' }} <!-- สถานะห้อง -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('rent_1') }}" class="btn">ต่อไป</a>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        
        function getBedTypeFromUrl() {
            const params = new URLSearchParams(window.location.search);
            return params.get('bedType'); // รับค่า bedType จาก URL
        }
    
        const bedType = getBedTypeFromUrl(); // รับค่าประเภทเตียงจาก URL
        console.log("Selected bed type: ", bedType); // ตรวจสอบค่า bedType ใน console
    
        const rows = document.querySelectorAll('#roomTable tr'); // เลือกทุกแถวในตาราง
        const filterStatus = document.getElementById('filterStatus'); // ตัวกรองสถานะห้อง
        const nextLink = document.querySelector('.btn'); // ลิงก์ "ต่อไป"
    
        function filterRooms() {
            const selectedStatus = filterStatus.value; // รับค่าที่เลือกในฟิลเตอร์ ('ว่าง', 'ไม่ว่าง', 'ทั้งหมด')
            console.log("Selected status: ", selectedStatus); // ตรวจสอบค่า selectedStatus ใน console
    
            rows.forEach(row => {
                const roomType = row.dataset.roomType; // ดึงค่าประเภทห้องจาก data-room-type
                const roomStatus = row.dataset.roomStatus; // ดึงค่าสถานะห้องจาก data-room-status
    
                console.log("Room Type: ", roomType, "Room Status: ", roomStatus);
    
                // เงื่อนไขการแสดงผลตามประเภทเตียงและสถานะห้อง
                const showByBedType = (bedType === 'sing' && roomType === 'Single Bed') ||
                                      (bedType === 'two' && roomType === 'Two Bed') ||
                                      (bedType === 'pre' && roomType === 'Premium Bed');
    
                const showByStatus = filterByRoomStatus(roomStatus, selectedStatus);
    
                // แสดงเฉพาะแถวที่ตรงกับประเภทเตียงและสถานะห้อง
                if (showByStatus) {
                    row.style.display = ''; // แสดงแถวที่ตรง
                } else {
                    row.style.display = 'none'; // ซ่อนแถวที่ไม่ตรง
                }
            });
        }
    
        // ฟังก์ชันเพื่อกรองตามสถานะห้อง
        function filterByRoomStatus(roomStatus, selectedStatus) {
            if (selectedStatus === 'ทั้งหมด') {
                return true; // แสดงทุกห้องถ้าเลือก 'ทั้งหมด'
            }
    
            // เงื่อนไขการกรองสถานะห้อง
            return roomStatus === selectedStatus;
        }
    
        // เรียกใช้ฟังก์ชันกรองเมื่อหน้าโหลดเสร็จ
        filterRooms();
    
        // เรียกใช้ฟังก์ชันกรองเมื่อมีการเปลี่ยนแปลงค่าในฟิลเตอร์สถานะห้อง
        filterStatus.addEventListener('change', filterRooms);
    
        // ฟังก์ชันสำหรับคลิกแถวเพื่อเปลี่ยนสีพื้นหลังและเช็คสถานะห้อง
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const roomStatus = row.dataset.roomStatus;
    
                // เอาคลาส 'selected' ออกจากแถวอื่น
                rows.forEach(r => r.classList.remove('selected'));
                // เพิ่มคลาส 'selected' ให้กับแถวที่คลิก
                row.classList.add('selected');
    
                // เช็คสถานะห้อง: ถ้าไม่ว่าง ให้ disable ลิงก์ "ต่อไป"
                if (roomStatus === 'ไม่ว่าง') {
                    nextLink.style.pointerEvents = 'none'; // ปิดการคลิก
                    nextLink.style.opacity = '0.5'; // ทำให้ลิงก์จางลงเพื่อให้เห็นว่าไม่สามารถกดได้
                    nextLink.style.cursor = 'not-allowed'; // เปลี่ยนเคอร์เซอร์เมื่อไม่สามารถกดได้
                } else {
                    nextLink.style.pointerEvents = 'auto'; // เปิดการคลิก
                    nextLink.style.opacity = '1'; // คืนค่าลิงก์ให้กดได้
                    nextLink.style.cursor = 'pointer'; // เปลี่ยนเคอร์เซอร์ให้กลับมากดได้
                }
            });
        });
    
        });
    </script>
</body>
</html>