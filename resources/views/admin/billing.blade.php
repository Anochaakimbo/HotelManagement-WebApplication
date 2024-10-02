@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <div class="billing-history">
        <h1>Billing Send</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>User</th>
                    <th>Water Units</th>
                    <th>Electricity Units</th>
                    <th>Room Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->user->name }}</td>
                        <td>
                            @if (!$room->billing)
                                <input type="number" id="water_units_{{ $room->id }}"
                                    name="water_units[{{ $room->id }}]" min="0" required>
                            @else
                                {{ $room->billing->water_units }} <!-- แสดงจำนวนหน่วยน้ำถ้ามีการส่งบิลแล้ว -->
                            @endif
                        </td>
                        <td>
                            @if (!$room->billing)
                                <input type="number" id="electric_units_{{ $room->id }}"
                                    name="electric_units[{{ $room->id }}]" min="0" required>
                            @else
                                {{ $room->billing->electric_units }} <!-- แสดงจำนวนหน่วยไฟถ้ามีการส่งบิลแล้ว -->
                            @endif
                        </td>
                        <td>
                            <input type="number" id="room_price_{{ $room->id }}" name="room_price[{{ $room->id }}]"
                                value="{{ $room->roomType->room_price }}" readonly>
                        </td>
                        <td>
                            @if (!$room->billing)
                                <!-- หากบิลยังไม่ได้ถูกส่ง -->
                                <button type="button" class="btn btn-success" onclick="confirmBilling({{ $room->id }})">Submit Billing</button>
                            @else
                                @if (Carbon\Carbon::parse($room->billing->billing_date)->format('Y-m') == Carbon\Carbon::now()->format('Y-m') && $room->billing->status == 'ชำระค่าห้องแล้ว')
                                    <!-- แสดงข้อความเมื่อบิลของเดือนนี้ถูกชำระแล้ว -->
                                    <span class="okes">บิลของเดือนนี้ถูกส่งไปแล้ว</span>
                                @elseif ($room->billing->status == 'รอยืนยัน')
                                    <!-- แสดงข้อความและปุ่มเมื่อสถานะเป็น 'รอยืนยัน' -->
                                    <a href="{{ route('confirmbill', ['room_id' => $room->id]) }}" class="btn btn-warning">Wait for confirm</a>
                                @elseif ($room->billing->trashed())
                                    <!-- หากบิลถูก Soft Delete -->
                                    <button type="button" class="btn btn-success" onclick="confirmBilling({{ $room->id }})">Submit Billing</button>
                                @else
                                    <!-- แสดงข้อความเมื่อบิลถูกส่งแล้วในสถานะอื่นๆ -->
                                    <span class="okes">Already Send</span>
                                @endif
                            @endif
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll('.styled-table tbody tr');

            rows.forEach(row => {
                // ตรวจสอบข้อมูลทั้งในคอลัมน์ User Name และ Room Number
                let userName = row.querySelector('td:first-child').textContent.toLowerCase();
                let roomNumber = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (userName.includes(input) || roomNumber.includes(input)) {
                    row.style.display = ''; // แสดงแถวที่ตรงกับการค้นหา
                } else {
                    row.style.display = 'none'; // ซ่อนแถวที่ไม่ตรงกับการค้นหา
                }
            });
        });

        function confirmBilling(roomId) {
            let waterUnits = document.getElementById(`water_units_${roomId}`).value;
            let electricUnits = document.getElementById(`electric_units_${roomId}`).value;
            let roomPrice = document.getElementById(`room_price_${roomId}`).value;

            if (waterUnits === '' || electricUnits === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Information',
                    text: 'Please fill out both Water Units and Electricity Units before submitting.',
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to submit billing`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('EASYOKOK') }}';
                    form.innerHTML = `
                    @csrf
                    <input type="hidden" name="room_id" value="${roomId}">
                    <input type="hidden" name="water_units[${roomId}]" value="${waterUnits}">
                    <input type="hidden" name="electric_units[${roomId}]" value="${electricUnits}">
                    <input type="hidden" name="room_price[${roomId}]" value="${roomPrice}">
                `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
