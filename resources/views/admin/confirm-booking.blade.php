@extends('layouts.sidebar-admin')

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="main-content">
        <div class="booking-details">
            <p><strong>Room:</strong> {{ $booking->room->room_number }}</p>
            <p><strong>Guest:</strong> {{ $booking->guest->name }}</p>
            <p><strong>Status:</strong> {{ $booking->status }}</p>

            @if ($booking->payment_slip)
                <p><strong>Payment Slip:</strong></p>
                <img src="{{ asset('uploads/' . $booking->payment_slip) }}" alt="Payment Slip" style="max-width: 400px; height: auto;">
            @else
                <h1>Paymented by credit card</h1>
            @endif

            @if ($booking->status == 'รอยืนยัน')
                <!-- Confirm Booking Button with SweetAlert -->
                <button class="btn btn-success" onclick="confirmBooking({{ $booking->id }})">Confirm Booking</button>

                <!-- Deny Booking Button with SweetAlert -->
                <button class="btn btn-danger" onclick="denyBooking({{ $booking->id }})">Deny Booking</button>
            @endif

            @if ($booking->status == 'จองสำเร็จ' && !App\Models\User::where('email', $booking->guest->email)->exists())
                <form id="createUserForm" action="{{ route('admin.create.user') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <label for="password">Set Password for User:</label>
                    <input type="text" name="password" required>
                    <button type="button" class="btn btn-primary" onclick="createUser()">Create User</button>
                </form>
            @endif
        </div>
    </div>

    <script>
        function confirmBooking(bookingId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to confirm this booking.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/booking/confirm/${bookingId}`;
                    form.innerHTML = '@csrf';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function denyBooking(bookingId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to deny this booking.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Deny'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/booking/delete/${bookingId}`;
                    form.innerHTML = '@csrf';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function createUser() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to create a new user with this password.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createUserForm').submit();
                }
            });
        }
    </script>

@endsection
