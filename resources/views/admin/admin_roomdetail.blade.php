
    <link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
    @extends('layouts.sidebar-admin')
    @section('content')
    <div class="main-content">
        <div class="room-info">
            <div class="details">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Room number</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th colspan="2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $rooms )
                        <tr>
                            <td>{{ $rooms->room_number }}</td>
                            <td>
                            @if ($rooms->room_type_id == "1")
                                Twin Bed Room
                            @elseif ($rooms->room_type_id == "2")
                                Single Bed Room
                            @elseif ($rooms->room_type_id == "3")
                                Premium Bed Room
                            @endif
                            </td>
                            <td>{{ $rooms->description }}</td>
                            <td>
                            @if ($rooms -> is_available == "1")
                                <p style="color:rgb(0, 255, 0)">Available</p>
                            @else
                                <p style="color:red">Occupied</p>
                            @endif
                            </td>
                            <td class="deletecolumn">
                                <a href="{{ route ('roomdelete',$rooms->id)}}" class="deletebutton" onclick="return confirm('Are you sure you want to delete this room?')">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
