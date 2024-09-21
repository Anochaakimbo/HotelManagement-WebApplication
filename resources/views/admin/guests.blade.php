@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('content')
<div class="billing-history">
    <h1>Guest</h1>
    @if($users->isEmpty())
    <p>ขณะนี้ยังไม่มีผู้พัก</p>
        @else
        <table class="styled-table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Room Number</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->room->room_number }}</td> <!-- assuming 'number' is a field in rooms table -->
                        <td><a href="{{ route('guest.details', $user->room->id) }}" class="btn btn-primary">View</a></td>
                        <td><a href="{{ route ('guest.checkout',$user->id)}}" class="btn btn-danger">Check out</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
@endsection

