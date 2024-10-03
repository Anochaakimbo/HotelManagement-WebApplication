@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@section('content')

<div class="billing-history">
    <h1>ประวัติการจ่ายบิล</h1>
<div class="main-content">
    <div class="room-info">
        <div class="details">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>หมายเลขห้อง</th>
                        <th>ชื่อผู้เข้าพัก</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>
                            @if($booking->room)
                                {{ $booking->room->room_number }}
                            @else
                                <span class="text-danger">ไม่พับห้องพัก</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->guest)
                                {{ $booking->guest->name }}
                            @else
                                <span class="text-danger">ไม่พับผู้เข้าพัก</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
        document.getElementById('search').addEventListener('input', function() {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll('.styled-table tbody tr');

            rows.forEach(row => {
                // ตรวจสอบข้อมูลทั้งในคอลัมน์ User Name และ Room Number
                let userName = row.querySelector('td:first-child').textContent.toLowerCase();
                let roomNumber = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (userName.includes(input) || roomNumber.includes(input)) {
                    row.style.display = ''; // แสดงแถวที่ตรงกับการค้นหา
                } else {
                    row.style.display = 'none'; // ซ่อนแถวที่ไม่ตรงกับการค้นหา
                }
            });
        });
</script>
@endsection
