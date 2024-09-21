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
                            <!-- ปุ่มยืนยันการชำระเงิน -->
                            <form action="{{ route('confirmPayment', $billing->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit">Confirm Payment</button>
                            </form>

                            <!-- ปุ่มปฏิเสธการชำระเงิน (Deny) -->
                            <form action="{{ route('denyPayment', $billing->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="deny-btn">Deny</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
