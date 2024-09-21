@extends('layouts.sidebar-admin')
@section('content')
<h1>Guest Room Details</h1>
<p>Room Number: {{ $room->room_number }}</p>
<p>Room Size: {{ $room->roomType->room_description }}</p>
<P>Floor : {{ $room->floor }}
<p>Other Info: {{ $room->description }}</p>
<p>Contract date: {{ $room->contract}}</p>
<p>Room Price : {{ $room->roomType->room_price }}
<p>Electrical Unit : {{ $room->roomType->water_unit }}
<p>Water Unit : {{ $room->roomType->electrical_unit }}
<p>Furniture : {{  $room->roomType->furniture_details }}
<p>Payment Status:
    @if(optional($room->billing)->status == 'ส่งไปยังผู้ใช้แล้ว')
        There is a balance that needs to be paid.
    @else
        No Dept
    @endif
</p>
@endsection
