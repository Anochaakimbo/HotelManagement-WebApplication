@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@section('content')

<div class="billing-history">
    <h1>Billing History</h1>
@if ($billings->isNotEmpty())
    <table class="styled-table">
        <thead>
            <tr>
                <th>ห้อง</th>
                <th>ผู้ใช้</th>
                <th>ค่าน้ำ</th>
                <th>ค่าไฟ</th>
                <th>ค่าห้อง</th>
                <th>ค่าใช้จ่ายรวม</th>
                <th>วันที่บันทึก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billings as $billing)
                <tr>
                    <td>{{ $billing->room->room_number }}</td>
                    <td>{{ $billing->user->name }}</td>
                    <td>{{ $billing->water_charge }} บาท</td>
                    <td>{{ $billing->electric_charge }} บาท</td>
                    <td>{{ $billing->room_price }} บาท</td>
                    <td>{{ $billing->total_charge }} บาท</td>
                    <td>{{ $billing->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No payment history</p>
@endif

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
