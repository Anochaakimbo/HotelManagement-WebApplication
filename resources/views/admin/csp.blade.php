<link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@extends('layouts.sidebar-admin')

@section('content')
    <div class="report-info">
        <div class="details">
            <h1>รายงานปัญหาจากผู้เข้าพัก</h1>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>หมายเลขห้อง</th>
                        <th>ชื่อผูเ้ข้าพัก</th>
                        <th>รายละเอียดห้องพัก</th>
                        <th>วันที่ส่ง</th>
            <h1>Customer Problem</h1>
            <table class="styled-table table table-bordered">
                <thead>
                   <tr>
                        <th>Roomnumber</th>
                        <th>User Name</th>
                        <th>Description</th>
                        <th>Date Submitted</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->room->room_number ?? 'N/A' }}</td>
                            <td>{{ $report->user->name ?? 'N/A' }}</td>
            <td>{{ $report->mainCategory->name ?? 'ไม่มีข้อมูลหมวดหมู่หลัก' }}</td>
                            <td>{{ $report->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('csp2.view', $report->id) }}" class="viewbutton">ดูรายละเอียด</a>
                                <a href="{{ route('csp2.view', $report->id) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll('.styled-table tbody tr');

            rows.forEach(row => {
                let userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let roomNumber = row.querySelector('td:first-child').textContent.toLowerCase();

                if (userName.includes(input) || roomNumber.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
