<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const subCategories = {
                'เครื่องปรับอากาศ (แอร์)': [
                    { value: 'ไม่เย็น', text: 'ไม่เย็น' },
                    { value: 'รั่วซึม', text: 'รั่วซึม' },
                    { value: 'เสียงดัง', text: 'เสียงดัง' }
                ],
                เครื่องทำน้ำอุ่น: [
                    { value: 'ไม่ทำงาน', text: 'ไม่ทำงาน' },
                    { value: 'รั่วซึม', text: 'รั่วซึม' },
                    { value: 'น้ำไม่ร้อน', text: 'น้ำไม่ร้อน' }
                ],
                ไฟฟ้าและหลอดไฟ: [
                    { value: 'หลอดไฟเสีย', text: 'หลอดไฟเสีย' },
                    { value: 'สวิตช์ไฟไม่ทำงาน', text: 'สวิตช์ไฟไม่ทำงาน' },
                    { value: 'ปลั๊กไฟหลวม', text: 'ปลั๊กไฟหลวม' }
                ],
                'ประตูและหน้าต่าง': [
                    { value: 'ลูกบิดประตูเสีย', text: 'ลูกบิดประตูเสีย' },
                    { value: 'ประตูหรือหน้าต่างปิดไม่สนิท', text: 'ประตูหรือหน้าต่างปิดไม่สนิท' },
                    { value: 'บานพับชำรุด', text: 'บานพับชำรุด' }
                ],
                เฟอร์นิเจอร์: [
                    { value: 'โต๊ะชำรุดหรือเสียหาย', text: 'โต๊ะชำรุดหรือเสียหาย' },
                    { value: 'เก้าอี้ชำรุดหรือเสียหาย', text: 'เก้าอี้ชำรุดหรือเสียหาย' },
                    { value: 'ตู้เสื้อผ้าชำรุดหรือเสียหาย', text: 'ตู้เสื้อผ้าชำรุดหรือเสียหาย' }
                ],
                ระบบประปา: [
                    { value: 'ท่อน้ำรั่ว', text: 'ท่อน้ำรั่ว' },
                    { value: 'น้ำไม่ไหล', text: 'น้ำไม่ไหล' },
                    { value: 'ก๊อกน้ำหรือสายชำระเสีย', text: 'ก๊อกน้ำหรือสายชำระเสีย' }
                ],
                ห้องน้ำ: [
                    { value: 'ชักโครกเสีย', text: 'ชักโครกเสีย' },
                    { value: 'อ่างล้างหน้าอุดตัน', text: 'อ่างล้างหน้าอุดตัน' },
                    { value: 'ระบายน้ำช้า', text: 'ระบายน้ำช้า' }
                ],
                'เครื่องซักผ้า (ถ้ามีในห้อง)': [
                    { value: 'เครื่องไม่ทำงาน', text: 'เครื่องไม่ทำงาน' },
                    { value: 'ปั่นไม่หมาด', text: 'ปั่นไม่หมาด' }
                ],
                'ผนังและพื้นห้อง': [
                    { value: 'ผนังร้าว', text: 'ผนังร้าว' },
                    { value: 'พื้นเสียหายหรือหลุดร่อน', text: 'พื้นเสียหายหรือหลุดร่อน' }
                ],
                'อินเทอร์เน็ตและโทรทัศน์': [
                    { value: 'อินเทอร์เน็ตไม่เชื่อมต่อ', text: 'อินเทอร์เน็ตไม่เชื่อมต่อ' },
                    { value: 'โทรทัศน์สัญญาณขัดข้อง', text: 'โทรทัศน์สัญญาณขัดข้อง' }
                ]
            };

            const mainCategorySelect = document.getElementById('main-category');
            const subCategorySelect = document.getElementById('sub-category');

            mainCategorySelect.addEventListener('change', function () {
                const selectedCategory = this.value;
                const subCategoriesForMain = subCategories[selectedCategory] || [];

                // Clear the subcategory options
                subCategorySelect.innerHTML = '<option value="">เลือกหมวดงานซ่อมย่อย</option>';

                // Populate subcategory options based on the selected main category
                subCategoriesForMain.forEach(function (subCategory) {
                    const option = document.createElement('option');
                    option.value = subCategory.value;
                    option.textContent = subCategory.text;
                    subCategorySelect.appendChild(option);
                });
            });
        });
    </script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="./img/Logo.png" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('Report') }}" class="active">แจ้งปัญหา</a>
        <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <form class="logout" method="POST" action="{{ route('logout') }}" class="inline" id="logout-form">
                @csrf
                <button @click.prevent="$root.submit();" class="ml-4">
                    {{ __('ล็อคเอาท์') }}
                </button>
            </form>
            <div class="user-info dropdown">
                <!-- ปุ่มสำหรับ dropdown -->
                <span class="dropbtn">User: {{ Auth::user()->name }}</span>
                <!-- เนื้อหาของ dropdown -->
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
            <!-- เพิ่ม id ให้กับฟอร์ม -->
            <form method="POST" action="{{ route('report.store') }}" id="reportForm">
                @csrf
                <!-- ฟิลด์ซ่อนสำหรับส่ง user_id -->
                <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly style="display: none">

                <!-- ฟิลด์สำหรับส่ง room_number -->
                <input type="text" name="room_number" value="{{ Auth::user()->room->room_number }}" readonly style="display: none">

                <!-- Dynamically show room number from user data -->
                <label for="room">ห้อง</label>
                <input type="text" id="room" name="room" value="{{ Auth::user()->room->room_number }}" readonly>

                <label for="main-category">เลือกหมวดงานซ่อมหลัก</label>
                <select id="main-category" name="main_category">
                    <option value="">เลือกหมวดงานซ่อมหลัก</option>
                    <option value="เครื่องปรับอากาศ (แอร์)">เครื่องปรับอากาศ (แอร์)</option>
                    <option value="เครื่องทำน้ำอุ่น">เครื่องทำน้ำอุ่น</option>
                    <option value="ไฟฟ้าและหลอดไฟ">ไฟฟ้าและหลอดไฟ</option>
                    <option value="ประตูและหน้าต่าง">ประตูและหน้าต่าง</option>
                    <option value="เฟอร์นิเจอร์">เฟอร์นิเจอร์</option>
                    <option value="ระบบประปา">ระบบประปา</option>
                    <option value="ห้องน้ำ">ห้องน้ำ</option>
                    <option value="เครื่องซักผ้า (ถ้ามีในห้อง)">เครื่องซักผ้า (ถ้ามีในห้อง)</option>
                    <option value="ผนังและพื้นห้อง">ผนังและพื้นห้อง</option>
                    <option value="อินเทอร์เน็ตและโทรทัศน์">อินเทอร์เน็ตและโทรทัศน์</option>
                </select>

                <label for="sub_category">เลือกหมวดงานซ่อมย่อย</label>
                <select id="sub-category" name="sub_category">
                    <option value="">เลือกหมวดงานซ่อมย่อย</option>
                </select>

                <label for="problem-description">อาการ/ปัญหา</label>
                <textarea id="problem-description" name="problem_description" rows="4" placeholder="อาการหรือปัญหา..."></textarea>

                <label for="contact-number">เบอร์โทรศัพท์ที่ติดต่อ</label>
                <input type="text" id="contact-number" name="contact_number" placeholder="เบอร์โทรศัพท์">

                <label>กรณีผู้เช่าไม่อยู่ห้อง อนุญาตให้ช่างเข้ามาซ่อมหรือไม่?</label>
                <div>
                    <input type="radio" id="allow" name="permission" value="allow">
                    <label for="allow">อนุญาต</label>

                    <input type="radio" id="disallow" name="permission" value="disallow">
                    <label for="disallow">ไม่อนุญาต</label>
                </div>

                <button type="submit">ส่งคำขอซ่อม</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function (e) {
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
    </script>

</body>

</html>
