<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Roomdetails1.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/หอ-2.png') }}" alt="Logo" class="logo">
        </a>
        <a href="{{ route('adminpage') }}" class="active">Dashboard</a>
        <a href="{{ route('guestpage') }}">Guest</a>
        <a href="{{ route('customerproblem') }}">Customer problem</a>
        <a href="{{ route('booking') }}">Booking</a>
        <a href="{{ route('adminbilling') }}">Billing</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form method="POST" action="{{ route('logout') }}" x-data class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <div class="user-info dropdown">
                <span class="dropbtn">ผู้ใช้: {{ Auth::user()->name }}</span>
                <div class="dropdown-content">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>
                    <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                </div>
            </div>
        </div>

        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <h1>Dashboard สรุปข้อมูลระบบ</h1>

            <!-- สถิติทั่วไป -->
            <div class="stats">
                <div class="stat-item">
                    <h3>จำนวนผู้ใช้งาน</h3>
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
                                <li>ห้อง {{ $booking->room_number }} โดย {{ $booking->user->name }} - วันที่จอง {{ $booking->created_at }}</li>
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
                    @endif --}}
                </div>
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
    <div class="content">
        <!-- แผนภูมิการจองห้อง -->
        <div class="chart">
            <h3>การจองห้องรายเดือน</h3>
            <canvas id="bookingChart"></canvas>
        </div>

        <!-- Scripts สำหรับ Chart.js -->
        <script>
            var ctx = document.getElementById('bookingChart').getContext('2d');
            var bookingChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($months), // ชื่อเดือนจาก controller
                    datasets: [{
                        label: 'การจองห้อง',
                        data: @json($bookingsData), // ข้อมูลการจองจาก controller
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</body>

</html>
