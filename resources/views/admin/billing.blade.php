@extends('layouts.sidebar-admin')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<div class="billing-history">
    <h1>Billing Send</h1>
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
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->user->name }}</td>
                <td>
                    <input type="number" id="water_units_{{ $room->id }}" name="water_units[{{ $room->id }}]" min="0" required>
                </td>
                <td>
                    <input type="number" id="electric_units_{{ $room->id }}" name="electric_units[{{ $room->id }}]" min="0" required>
                </td>
                <td>
                    <input type="number" id="room_price_{{ $room->id }}" name="room_price[{{ $room->id }}]" value="{{ $room->roomType->room_price }}" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-success" onclick="confirmBilling({{ $room->id }})">Submit Billing</button>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmBilling(roomId) {
        let waterUnits = document.getElementById(`water_units_${roomId}`).value;
        let electricUnits = document.getElementById(`electric_units_${roomId}`).value;
        let roomPrice = document.getElementById(`room_price_${roomId}`).value;

        if (waterUnits === '' || electricUnits === '') {
            Swal.fire({
                icon: 'error',
                title: 'Missing Information',
                text: 'Please fill out both Water Units and Electricity Units before submitting.',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to submit billing`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('EASYOKOK') }}';
                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="room_id" value="${roomId}">
                    <input type="hidden" name="water_units[${roomId}]" value="${waterUnits}">
                    <input type="hidden" name="electric_units[${roomId}]" value="${electricUnits}">
                    <input type="hidden" name="room_price[${roomId}]" value="${roomPrice}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection
