@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@section('content')

<div class="billing-history">
    <h1>รายชื่อผู้เข้าพัก</h1>
    @if($users->isEmpty())
    <h1>ขณะนี้ยังไม่มีผู้เข้าพัก</h1>
    @else
    <table class="styled-table">
        <thead>
            <tr>
                <th>ชื่อผู้เข้าพัก</th>
                <th>หมายเลขห้อง</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->room->room_number }}</td>
                <td><a href="{{ route('guest.details', $user->room->id) }}" class="btn btn-primary">ดูรายละเอียด</a></td>
                <!-- Updated button to call confirmCheckout function -->
                <td><button onclick="confirmCheckout({{ $user->id }})" class="btn btn-danger">Check out</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
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
        <script>
    function confirmCheckout(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to check out this guest?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Check out!'
        }).then((result) => {
            if (result.isConfirmed) {
            window.location.href = "{{ route('guest.checkout', '') }}/" + userId;
            }
        });
    }
</script>
@if($errors->has('msg'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('msg') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
