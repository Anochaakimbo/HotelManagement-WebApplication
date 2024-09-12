<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            eiei
            <h1>ประวัติการชำระเงิน</h1>

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
    <p>ไม่มีประวัติการชำระเงินที่ถูกลบ</p>
@endif

        </div>
    </div>
</x-app-layout>