@extends('layouts.sidebar-admin')
@section('content')
    <div class="main-content">
        <form action="/Addroom/addroom" method="POST">
            @csrf
            <label for="">Room Type:</label><br>
            <select name="room_type_id" id="" required>
                @foreach ($rooms as $room )
                <option value="{{ $room->id }}">
                    @if ($room->id == "1")
                    Premium Bed Room
                @elseif ($room->id == "2")
                    Twin Bed Room
                @elseif ($room->id == "3")
                    Single Bed Room
                @endif
                </option>
                @endforeach
            </select>
            <br>
            <br>
            <label for="">Room Number:</label><br>
            <input type="text" name="room_number">
            <br>
            <br>
            <label for="">Floor:</label><br>
            <input type="number" name="floor" id="">
            <br>
            <label for="">Description:</label>
            <br>
            <textarea name="description" id="" cols="30" rows="10" required></textarea>
            <br>
            <button type="submit" onclick="return confirm('Are you sure you want to add room?')" class="submitbutton">Submit</button>


        </form>
    </div>
</div>
@endsection
