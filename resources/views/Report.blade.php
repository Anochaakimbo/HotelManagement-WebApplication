<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="./img/Logo.png" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('report.form') }}" class="active">แจ้งปัญหา</a>
        <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form class="logout" method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button class="logout1" @click.prevent="$root.submit();" class="ml-4">
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

        <!-- Form Container -->
        <div class="form-container">
            <h2>แจ้งปัญหา</h2>
            <form method="POST" action="{{ route('report.store') }}" id="reportForm">
                @csrf
                <input type="hidden" name="room_id" value="{{ Auth::user()->room->id }}" readonly style="display: none">

                <label for="room_number">เลขห้อง</label>
                <input type="text" id="room_number" name="room_number" value="{{ Auth::user()->room->room_number }}" readonly>

                <label for="main-category">เลือกหมวดงานซ่อมหลัก</label>
<select id="main-category" name="main_category" required>
    <option value="">เลือกหมวดงานซ่อมหลัก</option>
    @foreach($mainCategories as $mainCategory)
        <option value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
    @endforeach
</select>


                <label for="sub-category">เลือกหมวดงานซ่อมย่อย</label>
                <select id="sub-category" name="sub_category" required>
                    <option value="">เลือกหมวดงานซ่อมย่อย</option>
                    <!-- ตัวเลือกหมวดงานซ่อมย่อยจะถูกเติมจาก JavaScript -->
                </select>

                <label for="problem-description">อาการ/ปัญหา</label>
                <textarea id="problem-description" name="problem_description" rows="4" placeholder="อาการหรือปัญหา..." required></textarea>

                <label for="contact-number">เบอร์โทรศัพท์ที่ติดต่อ</label>
                <input type="text" id="contact-number" name="contact_number" placeholder="เบอร์โทรศัพท์" required>

                <label>กรณีผู้เช่าไม่อยู่ห้อง อนุญาตให้ช่างเข้ามาซ่อมหรือไม่?</label>
                <div class="radio">
                    <input type="radio" id="allow" name="permission" value="allow" required>
                    <label for="allow">อนุญาต</label>

                    <input type="radio" id="disallow" name="permission" value="disallow" required>
                    <label for="disallow">ไม่อนุญาต</label>
                </div>
                <button type="submit">ส่งคำขอซ่อม</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function(e) {
            e.preventDefault(); // หยุดการส่งฟอร์มชั่วคราว

            Swal.fire({
                title: 'ส่งคำขอซ่อมแล้ว',
                text: 'เราได้รับคำขอซ่อมของคุณเรียบร้อยแล้ว!',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // ส่งฟอร์มหลังจากผู้ใช้กด "ตกลง"
                }
            });
        });

        function updateSubCategories() {
            const mainCategorySelect = document.getElementById('main-category');
            const subCategorySelect = document.getElementById('sub-category');

            // Clear the subcategory options
            subCategorySelect.innerHTML = '<option value="">เลือกหมวดงานซ่อมย่อย</option>';

            // Get the selected main category ID
            const selectedMainCategoryId = mainCategorySelect.value;

            // Fill sub-categories based on selected main category
            @foreach($mainCategories as $mainCategory)
                if (selectedMainCategoryId == {{ $mainCategory->id }}) {
                    @foreach($mainCategory->subCategories as $subCategory)
                        const option = document.createElement('option');
                        option.value = "{{ $subCategory->id }}"; // ใช้ id สำหรับ sub_category
                        option.textContent = "{{ $subCategory->name }}"; // ใช้ name สำหรับแสดงผล
                        subCategorySelect.appendChild(option);
                    @endforeach
                }
            @endforeach
        }
    </script>

</body>

</html>
