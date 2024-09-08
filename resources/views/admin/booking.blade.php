<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('BOOKING') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            BOOKING INFORMATION
            @foreach ($bookings as $booking)
                <p>{{ $booking->guest->name }} booked {{ $booking->room->name }} - Status: {{ $booking->status }}</p>

                @if ($booking->status == 'รอยืนยัน')
                <form action="/admin/bookings/{{ $booking->id }}/status" method="POST">
            @csrf
            <input type="hidden" name="status" value="จองสำเร็จ">
            <button type="submit">Confirm Booking</button>
                </form>
                @endif
                @endforeach
                @foreach ($bookings as $booking)
    <!-- ปุ่มลบการจอง -->
    <form action="/admin/bookings/{{ $booking->id }}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Booking</button>
    </form>
@endforeach
        </div>
    </div>
</x-app-layout>