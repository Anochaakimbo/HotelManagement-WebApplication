@extends('layouts.sidebar-admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('content')
<div class="billing-history">
    <h1>Guest</h1>
    @if($users->isEmpty())
    <h1>There is no guest right now!</h1>
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
        <script>
            function confirmCheckout(userId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to check out this guest?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, check out!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('/guest/checkout') }}/" + userId;
                    }
                })
            }
        </script>
@endsection

