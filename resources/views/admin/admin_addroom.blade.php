@extends('layouts.sidebar-admin')
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<div class="main-content">
    <!-- SweetAlert for session alert -->
    @if (session('alert'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Notification',
                text: "{{ session('alert') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- ฟอร์มกรอกค่าห้องที่ต้องการเพิ่มลง db -->
    <form action="/Addroom/addroom" method="POST" id="addRoomForm">
        @csrf
        <label for="">ประเภทห้อง :</label><br>
        <select name="room_type_id" id="room_type" required>
            @foreach ($rooms as $room )
            <option value="{{ $room->id }}">
                @if ($room->id == "1")
                Premium Bed Room
                @elseif ($room->id == "2")
                Twin Bed Room
                @elseif ($room->id == "3")
                Single Bed Room
                @endif
            </option>
            @endforeach
        </select>
        <br><br>

        <label for="">เลขห้อง :</label><br>
        <input type="text" name="room_number" id="room_number" maxlength="4" required>
        <br><br>

        <label for="">ชั้น :</label><br>
        <input type="number" name="floor" id="" required>
        <br><br>

        <label for="">ข้อมูลเพิ่มเติม :</label><br>
        <textarea name="description" id="" cols="30" rows="10" required></textarea>
        <br><br>

        <button type="button" onclick="confirmAddRoom()" class="addroombutton">เพิ่มห้อง</button>
    </form>
</div>

<script>
    // Function to update the room number prefix based on the selected room type
    document.getElementById('room_type').addEventListener('change', function() {
        let roomType = this.value;
        let roomNumberField = document.getElementById('room_number');

        // เวลาเลือกประเภทห้อง จะตั้งค่า Default ในช่องกรอกเป็นตัวอักษรห้องนั้นๆ
        if (roomType == "1") { // Premium Bed Room
            roomNumberField.value = 'P';
        } else if (roomType == "2") { // Twin Bed Room
            roomNumberField.value = 'T';
        } else if (roomType == "3") { // Single Bed Room
            roomNumberField.value = 'S';
        } else {
            roomNumberField.value = '';
        }
    });

    function confirmAddRoom() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to add this room?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('addRoomForm').submit();
            }
        });
    }
</script>

@endsection
