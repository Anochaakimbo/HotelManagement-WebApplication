@extends('layouts.sidebar-admin')
@section('content')
        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <h1>Dashboard สรุปข้อมูลระบบ</h1>

            <!-- สถิติทั่วไป -->
            <div class="stat-item">
                <h3>จำนวนผู้พักในหอ</h3>
                @if ($usersCount > 0)
                    <p>{{ $usersCount }} คน</p>
                @else
                    <p>ไม่มีข้อมูลผู้ใช้งาน</p>
                @endif
            </div>
            <div class="recent-bookings">
                <h3>การจองห้องล่าสุด</h3>
                @if ($bookings->isNotEmpty())
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>ห้อง {{ $booking->room->room_number }} โดย {{ $booking->guest->name }} - วันที่จอง {{ $booking->created_at }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>ไม่มีการจองห้อง</p>
                @endif
            </div>
            {{-- <div class="stat-item">
                <h3>ปัญหาจากผู้ใช้งาน</h3>
                @if ($pendingIssuesCount > 0)
                    <p>{{ $pendingIssuesCount }} รายการที่รอดำเนินการ</p>
                @else
                    <p>ไม่มีปัญหาที่รอดำเนินการ</p>
                @endif
            </div> --}}
            <div class="stat-item">
                <h3>รายการเรียกเก็บเงิน</h3>
                @if ($billings > 0)
                    <p>{{ $billings }} รายการที่ต้องติดตาม</p>
                @else
                    <p>ไม่มีรายการเรียกเก็บเงิน</p>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
