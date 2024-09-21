@extends('layouts.sidebar-admin')
@section('content')
        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <h1>Dashboard</h1>

            <!-- สถิติทั่วไป -->
            <div class="stat-item">
                <h3>Guest</h3>
                @if ($usersCount > 0)
                    <p>{{ $usersCount }} </p>
                @else
                    <p>No Guest right now</p>
                @endif
            </div>
            <div class="recent-bookings">
                <h3>Lastest Booking</h3>
                @if ($bookings->isNotEmpty())
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>Room {{ $booking->room->room_number }} By {{ $booking->guest->name }} - Date {{ $booking->created_at }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No Booking</p>
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
                <h3>Billing list</h3>
                @if ($billings > 0)
                    <p>{{ $billings }} Billing to follow
                    </p>
                @else
                    <p>There are no billing items.</p>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
