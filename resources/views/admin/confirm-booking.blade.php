<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking check') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <p>Room: {{ $booking->room->name }}</p>
    <p>Guest: {{ $booking->guest->name }}</p>
    <p>Status: {{ $booking->status }}</p>
    @if ($booking->status == 'รอชำระเงิน')
    <form action="{{ route('admin.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
        @csrf
        <button type="submit">Delete Booking</button>
    </form>
    @endif
    <!-- ปุ่มยืนยันการจอง -->
    @if ($booking->status == 'รอยืนยัน')
        <form action="{{ route('admin.booking.confirm.post', $booking->id) }}" method="POST">
            @csrf
            <button type="submit">Confirm Booking</button>
        </form>
        <form action="{{ route('admin.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
            @csrf
            <button type="submit">Delete Booking</button>
        </form>
    @endif

    <!-- ปุ่มลบการจอง -->

    <!-- ตรวจสอบว่าผู้ใช้ถูกสร้างแล้วหรือไม่ -->
    @if ($booking->status == 'จองสำเร็จ' && !App\Models\User::where('email', $booking->guest->email)->exists())
    <form action="{{ route('admin.create.user') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <label for="password">Set Password for User:</label>
        <input type="password" name="password" required>
        <button type="submit">Create User</button>
    </form>
@elseif ($booking->status == 'จองสำเร็จ' && App\Models\User::where('email', $booking->guest->email)->exists())
    <p>User has been created</p>
@endif
        </div>
    </div>
</x-app-layout>