@extends('layouts.sidebar-admin')
@section('content')
<div class="billing-history">
    <h1>Billing History</h1>
@if ($billings->isNotEmpty())
    <table>
        <thead>
            <tr>
                <th>ห้อง</th>
                <th>ผู้ใช้</th>
                <th>ค่าน้ำ</th>
                <th>ค่าไฟ</th>
                <th>ค่าห้อง</th>
                <th>ค่าใช้จ่ายรวม</th>
                <th>วันที่บันทึก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billings as $billing)
                <tr>
                    <td>{{ $billing->room->name }}</td>
                    <td>{{ $billing->user->name }}</td>
                    <td>{{ $billing->water_charge }} บาท</td>
                    <td>{{ $billing->electric_charge }} บาท</td>
                    <td>{{ $billing->room_price }} บาท</td>
                    <td>{{ $billing->total_charge }} บาท</td>
                    <td>{{ $billing->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No payment history</p>
@endif

        </div>
    </div>
@endsection
