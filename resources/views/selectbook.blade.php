<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/selectbook.css') }}">
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
                    {{-- เช็คค่าของห้องจากหน้าก่อนหน้า --}}
                    data-room-status="{{ $room->is_available ? 'ว่าง' : 'ไม่ว่าง' }}"> 
                    {{-- ถ้าว่างค่า is_available เป็นจริง --}}

                    <td>{{ $room->room_number }}</td>
                    <td>
                        @if($room->roomType->room_description === 'Premium')
                            Premium Bed
                        @elseif($room->roomType->room_description === 'Single')
                            Single Bed
                        @elseif($room->roomType->room_description === 'Twin')
                            Two Bed
                        @else
                            {{ $room->roomType->room_description }}
                        @endif
                    </td> 
                    <td>{{ $room->floor }}</td> 
                    <td>{{ $room->roomType->room_price }}</td> 
                    <td class="{{ $room->is_available ? 'available' : 'unavailable' }}"> 
                        {{-- ถ้าว่างจะใช้ class อันแรก --}}
                        {{ $room->is_available ? 'ว่าง' : 'ไม่ว่าง' }} 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a id="nextLink" href="#" class="btn" style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">ต่อไป</a>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const nextLink = document.getElementById('nextLink');
        const rows = document.querySelectorAll('#roomTable tr');
        let selectedRoomData = {};
        rows.forEach(row => {
            row.addEventListener('click', () => {
                selectedRoomData = {
                    room_number: row.cells[0].innerText,
                    room_type: row.cells[1].innerText,
                    contract_duration: "12 เดือน",
                    deposit: row.cells[3].innerText
                };
                // คลิ๊กเลือกแล้วจะเปลี่ยนตรง url ส่งไปยังหน้าถัดไป
                nextLink.href = `{{ route('rent_1') }}?room_number=${selectedRoomData.room_number}&room_type=${selectedRoomData.room_type}&contract_duration=${selectedRoomData.contract_duration}&deposit=${selectedRoomData.deposit}`;
                nextLink.style.pointerEvents = 'auto'; 
                nextLink.style.opacity = '1'; 
                nextLink.style.cursor = 'pointer'; 
                // ปุ่มจะสามารถกดได้
            });
        });
    });
        document.addEventListener('DOMContentLoaded', function () {
        
        function getBedTypeFromUrl() {
            const params = new URLSearchParams(window.location.search);
            return params.get('bedType'); // รับค่า bedType จาก URL
        }
    
        const bedType = getBedTypeFromUrl(); // รับค่าประเภทเตียงจาก URL
        console.log("Selected bed type: ", bedType); // ตรวจสอบค่า bedType ใน console
    
        const rows = document.querySelectorAll('#roomTable tr'); 
        const filterStatus = document.getElementById('filterStatus');
        const nextLink = document.querySelector('.btn'); 
    
        function filterRooms() {
            const selectedStatus = filterStatus.value; // รับค่าที่เลือกในฟิลเตอร์
            console.log("Selected status: ", selectedStatus);
    
            rows.forEach(row => {
                const roomType = row.dataset.roomType;
                const roomStatus = row.dataset.roomStatus; 
    
                console.log("Room Type: ", roomType, "Room Status: ", roomStatus);
    
                const showByBedType = (bedType === 'single' && roomType === 'Single Bed') ||
                                      (bedType === 'twin' && roomType === 'Two Bed') ||
                                      (bedType === 'premium' && roomType === 'Premium Bed');
    
                const showByStatus = filterByRoomStatus(roomStatus, selectedStatus);
                // เอาค่าของห้องกับค่าที่เลือกมา
                if (showByStatus) {
                    row.style.display = ''; // แสดงแถวที่ตรง
                } else {
                    row.style.display = 'none';
                }
            });
        }
    
        // กรองตามสถานะห้อง
        function filterByRoomStatus(roomStatus, selectedStatus) {
            if (selectedStatus === 'ทั้งหมด') {
                return true; 
            }
            return roomStatus === selectedStatus;
        }

        filterRooms();
    
        // ถ้าเปลี่ยนจากห้องว่างไม่ว่างในlogก็เปลี่ยนด้วย
        filterStatus.addEventListener('change', filterRooms);
    
        // เปลี่ยนพื้นหลังตามที่คลิก
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const roomStatus = row.dataset.roomStatus;
    
                // แถวที่ไม่ได้คลิ๊ก
                rows.forEach(r => r.classList.remove('selected'));
                // แถวที่คลิ๊กจะมีพื้นหลังเปลี่ยน
                row.classList.add('selected');
    
                //ห้องไม่ว่างจะกดไม่ได้
                if (roomStatus === 'ไม่ว่าง') {
                    nextLink.style.pointerEvents = 'none'; 
                    nextLink.style.opacity = '0.5'; 
                    nextLink.style.cursor = 'not-allowed'; 
                } else {
                    nextLink.style.pointerEvents = 'auto';
                    nextLink.style.opacity = '1'; 
                    nextLink.style.cursor = 'pointer'; 
                }
            });
        });
        });
    </script>
</body>
</html>