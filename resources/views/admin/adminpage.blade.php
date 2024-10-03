@extends('layouts.sidebar-admin')
@section('content')
        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <h1>หน้าหลัก</h1>

            <!-- สถิติทั่วไป -->
            <div class="stat-item">
                <h3>ผู้เข้าพัก</h3>
                @if ($usersCount > 0)
                    <p>{{ $usersCount }} </p>
                @else
                    <p>ขณะนี้ยังไม่มีผู้เข้าพัก</p>
            <h1>สรุปข้อมูลทั่วไป</h1>

            <!-- สถิติทั่วไป -->
            <div class="stat-item">
                <h3>แขกที่พักทั้งหมด</h3>
                @if ($usersCount > 0)
                    <p>{{ $usersCount }} </p>
                @else
                    <p>ขณะนี้ยังไม่มีผู้พัก</p>
                @endif
            </div>
            <div class="recent-bookings">
                <h3>การจองล่าสุด</h3>
                @if ($bookings->isNotEmpty())
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>ห้องพัก {{ $booking->room->room_number }} จองโดย {{ $booking->guest->name }} - วันที่ {{ $booking->created_at }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>ยังไม่มีการจอง</p>
                            <li>ห้อง {{ $booking->room->room_number }} โดย {{ $booking->guest->name }} - วันที่ {{ $booking->created_at }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>ขณะนี้ยังไม่มีการจอง</p>
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
                <h3>รายการบิล</h3>
                @if ($billings > 0)
                    <p>{{ $billings }} รายการบิลที่ต้องจ่าย
                    </p>
                @else
                    <p>ไม่มีรายการบิล</p>
                <h3>การเรียกเก็บเงิน</h3>
                @if ($billings > 0)
                    <p>{{ $billings }} การเรียกเก็บเงิน
                    </p>
                @else
                    <p>ตอนนี้ยังไม่มีการเรียกเก็บเงินใดๆ</p>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
