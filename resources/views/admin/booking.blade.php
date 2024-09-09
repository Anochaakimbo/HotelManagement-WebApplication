<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('BOOKING') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            BOOKING INFORMATION
    <h1>Booking List</h1>

    <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Guest Name</th>
                <th>Booking Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>
                        <!-- กดที่เลขห้องเพื่อไปยังหน้าที่ยืนยันการจอง -->
                        <a href="{{ route('admin.booking.confirm', $booking->id) }}">
                            {{ $booking->room->name }}
                        </a>
                    </td>
                    <td>{{ $booking->guest->name }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</x-app-layout>