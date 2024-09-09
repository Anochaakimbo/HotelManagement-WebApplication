<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            THIS IS DASHBOARD
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('calculateCharges') }}" method="POST">
    @csrf
    <label for="room">เลือกห้อง:</label>
    <select id="room" name="room_id" required>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}">ห้อง {{ $room->name }} - ผู้ใช้: {{ $room->user->name }}</option>
        @endforeach
    </select>
    
    <label for="water_units">หน่วยน้ำที่ใช้:</label>
    <input type="number" id="water_units" name="water_units" min="0" required>
    
    <label for="electric_units">หน่วยไฟที่ใช้:</label>
    <input type="number" id="electric_units" name="electric_units" min="0" required>
    
    <label for="room_price">ค่าห้อง:</label>
    <input type="number" id="room_price" name="room_price" required>
    
    <button type="submit">ส่งค่าห้อง</button>
</form>

<h2>การเรียกเก็บเงินที่ส่งไปแล้ว</h2>
@foreach ($billings as $billing)
    @if ($billing->status == 'ส่งไปยังผู้ใช้แล้ว')
        <p>ห้อง: {{ $billing->room->name }}</p>
        <p>ค่าสถานะ: {{ $billing->status }}</p>
        <hr>
    @endif
@endforeach

<h2>การเรียกเก็บเงินที่รอยืนยัน</h2>
@foreach ($billings as $billing)
    @if ($billing->status == 'รอยืนยัน')
        <p>ห้อง: {{ $billing->room->name }}</p>
        <form action="{{ route('confirmPayment', $billing->id) }}" method="POST">
            @csrf
            <button type="submit">ยืนยันการชำระเงิน</button>
        </form>
    @endif
@endforeach
        </div>
    </div>
</x-app-layout>