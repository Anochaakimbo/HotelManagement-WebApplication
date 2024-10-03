<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('report') }}" class="active">แจ้งปัญหา</a>
        <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form class="logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout1" type="submit">{{ __('ล็อคเอาท์') }}</button>
            </form>
            <div class="user-info dropdown">
                <span class="dropbtn">User: {{ Auth::user()->name }}</span>
                <div class="dropdown-content">
                    <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <h2>แจ้งปัญหา</h2>
            <form id="report-form" method="POST" action="{{ route('report.store') }}">
                @csrf

                <!-- Room Information -->
                <input type="hidden" name="room_id" value="{{ Auth::user()->room->id }}" readonly>
                <label for="room_number">เลขห้อง</label>
                <input type="text" id="room_number" name="room_number" value="{{ Auth::user()->room->room_number }}" readonly>

                <!-- Main Category -->
                <label for="main-category">เลือกหมวดงานซ่อมหลัก</label>
                <select id="main-category" name="main_category_id" required>
                    <option value="">เลือกหมวดงานซ่อมหลัก</option>
                    @foreach ($mainCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <!-- Sub Category -->
                <label for="sub-category">เลือกหมวดงานซ่อมย่อย</label>
                <select id="sub-category" name="sub_category_id" required>
                    <option value="">เลือกหมวดงานซ่อมย่อย</option>
                </select>

                <!-- Problem Description -->
                <label for="problem-description">อาการ/ปัญหา</label>
                <textarea id="problem-description" name="problem_description" rows="4" placeholder="อาการหรือปัญหา...">{{ old('problem_description') }}</textarea>

                <!-- Contact Number -->
                <label for="contact-number">เบอร์โทรศัพท์ที่ติดต่อ</label>
                <input type="text" id="contact-number" name="contact_number" value="{{ old('contact_number') }}" placeholder="เบอร์โทรศัพท์">

                <!-- Permission for Repair -->
                <label>กรณีผู้เช่าไม่อยู่ห้อง อนุญาตให้ช่างเข้ามาซ่อมหรือไม่?</label>
                <div class="radio">
                    <input type="radio" id="allow" name="permission" value="allow" {{ old('permission') == 'allow' ? 'checked' : '' }}>
                    <label for="allow">อนุญาต</label>
                    <input type="radio" id="disallow" name="permission" value="disallow" {{ old('permission') == 'disallow' ? 'checked' : '' }}>
                    <label for="disallow">ไม่อนุญาต</label>
                </div>

                <!-- Submit Button -->
                <button type="submit">ส่งคำขอซ่อม</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('main-category').addEventListener('change', function () {
            var mainCategoryId = this.value;
            var subCategorySelect = document.getElementById('sub-category');
            subCategorySelect.innerHTML = '<option value="">เลือกหมวดงานซ่อมย่อย</option>'; // Clear previous options

            if (mainCategoryId) {
                fetch(`/subcategories/${mainCategoryId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(subCategory) {
                        var option = document.createElement('option');
                        option.value = subCategory.id;
                        option.textContent = subCategory.name;
                        subCategorySelect.appendChild(option);
                    });
                })
                .catch(function(error) {
                    console.log('Error:', error);
                });
            }
        });

        document.getElementById('report-form').addEventListener('submit', function(e) {
            e.preventDefault(); // ป้องกันการส่งฟอร์มปกติ

            Swal.fire({
                title: 'ยืนยันการแจ้งปัญหา?',
                text: "คุณต้องการส่งคำขอซ่อมใช่ไหม?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ส่งคำขอ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // ส่งฟอร์มเมื่อผู้ใช้ยืนยัน
                }
            });
        });
    </script>

</body>

</html>
