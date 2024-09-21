@extends('layouts.sidebar-admin')
@section('content')
<div class="billing-history">
    <h1>Billing Send</h1>
        <!-- Billing Form Table -->
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
    @if(!$room->billing)
    <form action="{{ route('EASYOKOK') }}" method="POST">
        @csrf
        <tr>
            <td>{{ $room->room_number }}</td>
            <td>{{ $room->user->name }}</td>
            <td>
                <input type="number" name="water_units[{{ $room->id }}]" min="0" required>
            </td>
            <td>
                <input type="number" name="electric_units[{{ $room->id }}]" min="0" required>
            </td>
            <td>
                <!-- แสดงราคาห้องจาก RoomType และตั้งเป็น readonly -->
                <input type="number" name="room_price[{{ $room->id }}]" value="{{ $room->roomType->room_price }}" readonly>
            </td>
            <td>
                <!-- ส่งค่า room_id ไปด้วย -->
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <button type="submit" class="btn btn-success">Submit Billing</button>
            </td>
        </tr>
    </form>
    @endif
    @endforeach
</tbody>
        </table>

@endsection
