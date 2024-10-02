@extends('layouts.sidebar-admin')
@section('content')

    <div class="billing-history">
        <h1>Billing Pending Confirmation</h1>

        <!-- เริ่มตาราง -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Status</th>
                    <th>Payment Slip</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billings as $billing)
                    @if ($billing->status == 'รอยืนยัน')
                    <tr>
                        <td>{{ $billing->room->room_number }}</td>
                        <td>{{ $billing->status }}</td>
                        <td>
                            @if ($billing->billing_slip)
                                <!-- ใช้ลิงก์เพื่อเปิด modal -->
                                <a href="#" data-toggle="modal" data-target="#slipModal{{ $billing->id }}">
                                    <img src="{{ asset('billingslip/' . $billing->billing_slip) }}" alt="Payment Slip" style="max-width: 100px; height: auto;">
                                </a>
                            @else
                                <p>No slip uploaded</p>
                            @endif
                            <div class="modal fade" id="slipModal{{ $billing->id }}" tabindex="-1" role="dialog" aria-labelledby="slipModalLabel{{ $billing->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="slipModalLabel{{ $billing->id }}">Payment Slip</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('billingslip/' . $billing->billing_slip) }}" alt="Payment Slip" style="width: 100%;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                        {{ $billing->total_charge }} บาท
                        </td>
                        <td>
                            <!-- ปุ่มยืนยันการชำระเงิน -->
                            <form action="{{ route('confirmPayment', $billing->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirm Payment</button>
                            </form>

                            <!-- ปุ่มปฏิเสธการชำระเงิน (Deny) -->
                            <form action="{{ route('denyPayment', $billing->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Deny</button>
                            </form>
                        </td>
                    </tr>
                    @endif
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
    </script>
@endsection
