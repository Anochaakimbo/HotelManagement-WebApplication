@extends('layouts.sidebar-admin')
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->room->room_number }}</td> <!-- assuming 'number' is a field in rooms table -->
                        <td><a href="{{ route('guest.details', $user->room->id) }}" class="btn btn-primary">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
@endsection

