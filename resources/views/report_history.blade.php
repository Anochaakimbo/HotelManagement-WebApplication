<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการแจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('Report') }}">แจ้งปัญหา</a>
        <a href="{{ route('report-history') }}" class="active">ประวัติการแจ้งปัญหา</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form method="POST" action="{{ route('logout') }}" class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <div class="user-info dropdown">
                <span class="dropbtn">User: {{ Auth::user()->name }}</span>
                <div class="dropdown-content">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>
                    <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <header>
            <h1>ประวัติการแจ้งปัญหา</h1>
        </header>
        <div class="main-content">
            <div class="table-responsive">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>เลขที่ห้อง</th>
                            <th>หมวดหมู่หลัก</th>
                            <th>หมวดหมู่ย่อย</th>
                            <th colspan ="2">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->room->room_number }}</td>
                                <td>{{ $report->main_category }}</td>
                                <td>{{ $report->sub_category }}</td>
                                <td>{{ $report->description }}</td>
                                <td>
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-success btn-sm delete-btn">แก้ไขสำเร็จแล้ว</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script for SweetAlert2 -->
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // หยุดการส่งฟอร์มชั่วคราว

                Swal.fire({
                    title: 'ช่างแก้ไขให้คุณแล้วใช่ไหม',
                    text: "คุณจะไม่สามารถย้อนกลับการกระทำนี้ได้!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ส่งฟอร์มเมื่อผู้ใช้ยืนยันการลบ
                        form.submit();

                        // แสดงข้อความสำเร็จ
                        Swal.fire(
                            'สำเร็จ!',
                            'แก้ไขสำเร็จแล้ว!!',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
</body>

</html>
