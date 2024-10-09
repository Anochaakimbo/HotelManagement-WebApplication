@extends('layouts.sidebar-admin')
@section('content')
        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <h1>Dashboard</h1>

            <!-- สถิติทั่วไป -->
            <div class="stat-item">
                <h3>ผู้พัก</h3>
                @if ($usersCount > 0)
                    <p>{{ $usersCount }} </p>
                @else
                    <p>ขณะนี้ไม่มีผู้พัก</p>
                @endif
            </div>
            <div class="recent-bookings">
                <h3>การจองล่าสุด</h3>
                @if ($bookings->isNotEmpty())
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>ห้อง {{ $booking->room->room_number }} โดย {{ $booking->guest->name }} - วันที่ {{ $booking->created_at }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>ไม่มีการจองขณะนี้</p>
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
                    <p>{{ $billings }} รายการเรียกเก็บเงินที่เรียกติดตาม
                    </p>
                @else
                    <p>There are no billing items.</p>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
