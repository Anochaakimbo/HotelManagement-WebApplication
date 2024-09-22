<link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
@extends('layouts.sidebar-admin')

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<form action="/roomdetail/updated" method="POST" style="display: none;" id="updateroom">
    @csrf
    <h2 class="updateroomheader">Update Room</h2>
    <input type="hidden" name="id" id="room_id">
    <label for="">Room number:</label><br>
    <input type="text" name="room_number" id="room_number" readonly class="textroomnumber"><br>
    <label for="roomtype">Room Type:</label><br>
    <input name="room_type_id" id="room_type_id" required readonly class="textroomtype"><br>
    <label for="">Floor:</label><br>
    <input type="number" name="floor" id="floor" readonly class="textroomfloor"><br>
    <label for="">Description:</label><br>
    <textarea name="description" id="description" cols="30" rows="10" required></textarea><br><br>
    <div class="btninform">
        <button type="button" class="backbtn" onclick="hideupdateform()">Back</button>
        <button type="button" onclick="confirmUpdateRoom()" class="addroombutton1">Submit</button>
    </div>
</form>

<div class="main-content">
    <div class="room-info">
        <div class="details">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Room number</th>
                        <th>Room Type</th>
                        <th>Description</th>
                        <th>Floor</th>
                        <th colspan="3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $rooms )
                    <tr>
                        <td>{{ $rooms->room_number }}</td>
                        <td>{{ $rooms->roomType->room_description }}</td>
                        <td>{{ $rooms->description }}</td>
                        <td>{{ $rooms->floor }}</td>
                        <td>
                        @if ($rooms->is_available == "1")
                            <p style="color:rgb(0, 255, 0)">Available</p>
                        @else
                            <p style="color:red">Occupied</p>
                        @endif
                        </td>
                        <td class="updatecolumn">
                            <a href="javascript:void(0)" class="updatebutton"
                               onclick="showupdateform({{ $rooms->id }}, '{{ $rooms->roomType->room_description }}', '{{ $rooms->room_number }}', '{{ $rooms->description }}', {{ $rooms->floor }})">
                               Update
                            </a>
                        </td>
                        <td class="deletecolumn">
                            <a href="javascript:void(0)" class="deletebutton"
                               onclick="confirmDeleteRoom('{{ route('roomdelete', $rooms->id) }}')">
                               Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function showupdateform(id, room_description, room_number, description, floor) {
        document.getElementById('room_id').value = id;
        document.getElementById('room_number').value = room_number;
        document.getElementById('room_type_id').value = room_description;
        document.getElementById('floor').value = floor;
        document.getElementById('description').value = description;

        document.getElementById('updateroom').style.display = 'block';
    }

    function hideupdateform() {
        document.getElementById('updateroom').style.display = 'none';
    }

    function confirmUpdateRoom() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this room?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('updateroom').submit();
            }
        });
    }

    function confirmDeleteRoom(deleteUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this room?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    }
</script>

@endsection
