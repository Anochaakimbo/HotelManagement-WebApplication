<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งปัญหา</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
             const subCategories = {
                aircon: [
                    { value: 'aircon1', text: 'ไม่เย็น' },
                    { value: 'aircon2', text: 'รั่วซึม' },
                    { value: 'aircon3', text: 'เสียงดัง' }
                ],
                'water-heater': [
                    { value: 'water-heater1', text: 'ไม่ทำงาน' },
                    { value: 'water-heater2', text: 'รั่วซึม' },
                    { value: 'water-heater3', text: 'น้ำไม่ร้อน' }
                ],
                electricity: [
                    { value: 'electricity1', text: 'หลอดไฟเสีย' },
                    { value: 'electricity2', text: 'สวิตช์ไฟไม่ทำงาน' },
                    { value: 'electricity3', text: 'ปลั๊กไฟหลวม' }
                ],
                'door-window': [
                    { value: 'door-window1', text: 'ลูกบิดประตูเสีย' },
                    { value: 'door-window2', text: 'ประตูหรือหน้าต่างปิดไม่สนิท' },
                    { value: 'door-window3', text: 'บานพับชำรุด' }
                ],
                furniture: [
                    { value: 'furniture1', text: 'โต๊ะชำรุดหรือเสียหาย' },
                    { value: 'furniture2', text: 'เก้าอี้ชำรุดหรือเสียหาย' },
                    { value: 'furniture3', text: 'ตู้เสื้อผ้าชำรุดหรือเสียหาย' }
                ],
                plumbing: [
                    { value: 'plumbing1', text: 'ท่อน้ำรั่ว' },
                    { value: 'plumbing2', text: 'น้ำไม่ไหล' },
                    { value: 'plumbing3', text: 'ก๊อกน้ำหรือสายชำระเสีย' }
                ],
                bathroom: [
                    { value: 'bathroom1', text: 'ชักโครกเสีย' },
                    { value: 'bathroom2', text: 'อ่างล้างหน้าอุดตัน' },
                    { value: 'bathroom3', text: 'ระบายน้ำช้า' }
                ],
                'washing-machine': [
                    { value: 'washing-machine1', text: 'เครื่องไม่ทำงาน' },
                    { value: 'washing-machine2', text: 'ปั่นไม่หมาด' }
                ],
                'wall-floor': [
                    { value: 'wall-floor1', text: 'ผนังร้าว' },
                    { value: 'wall-floor2', text: 'พื้นเสียหายหรือหลุดร่อน' }
                ],
                'internet-tv': [
                    { value: 'internet-tv1', text: 'อินเทอร์เน็ตไม่เชื่อมต่อ' },
                    { value: 'internet-tv2', text: 'โทรทัศน์สัญญาณขัดข้อง' }
                ]
            };


            const mainCategorySelect = document.getElementById('main-category');
            const subCategorySelect = document.getElementById('sub-category');

            mainCategorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                const subCategoriesForMain = subCategories[selectedCategory] || [];

                // Clear the subcategory options
                subCategorySelect.innerHTML = '<option value="">เลือกหมวดงานซ่อมย่อย</option>';

                // Populate subcategory options based on the selected main category
                subCategoriesForMain.forEach(function(subCategory) {
                    const option = document.createElement('option');
                    option.value = subCategory.value;
                    option.textContent = subCategory.text;
                    subCategorySelect.appendChild(option);
                });
            });

            // ดูค่า user_id และ room_number ในคอนโซล
            const userId = document.querySelector('input[name="user_id"]').value;
            const roomNumber = document.querySelector('input[name="room_number"]').value;
            console.log('User ID:', userId);
            console.log('Room Number:', roomNumber);
        });
    </script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="./img/หอ-2.png" alt="Logo" class="logo">
        <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
        <a href="{{ route('Payrent') }}">ชำระค่าเช่า</a>
        <a href="{{ route('Report') }}" class="active">แจ้งปัญหา</a>
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
            <form method="POST" action="{{ route('report.store') }}">
                @csrf
                <!-- ฟิลด์ซ่อนสำหรับส่ง user_id -->
                <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly style="display: none">

                <!-- ฟิลด์สำหรับส่ง room_number -->
                <input type="text" name="room_number" value="{{ Auth::user()->room->room_number }}" readonly style="display: none">

                <!-- Dynamically show room number from user data -->
                <label for="room">ห้อง</label>
                <input type="text" id="room" name="room" value="{{ Auth::user()->room->room_number }}"
                    readonly>

                <label for="main-category">เลือกหมวดงานซ่อมหลัก</label>
                <select id="main-category" name="main_category">
                    <option value="">เลือกหมวดงานซ่อมหลัก</option>
                    <option value="aircon">เครื่องปรับอากาศ (แอร์)</option>
                    <option value="water-heater">เครื่องทำน้ำอุ่น</option>
                    <option value="electricity">ไฟฟ้าและหลอดไฟ</option>
                    <option value="door-window">ประตูและหน้าต่าง</option>
                    <option value="furniture">เฟอร์นิเจอร์</option>
                    <option value="plumbing">ระบบประปา</option>
                    <option value="bathroom">ห้องน้ำ</option>
                    <option value="washing-machine">เครื่องซักผ้า (ถ้ามีในห้อง)</option>
                    <option value="wall-floor">ผนังและพื้นห้อง</option>
                    <option value="internet-tv">อินเทอร์เน็ตและโทรทัศน์</option>
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
</body>

</html>
