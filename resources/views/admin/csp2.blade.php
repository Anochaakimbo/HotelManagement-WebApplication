<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('layouts.sidebar-admin')
@section('content')
    <div class="report-details">
        <h1>Report Details</h1>
        <div class="report-item">
            <p><strong>Username:</strong>
                <td>{{ $report->user->name }}</td>
            </p>
        </div>
        <div class="report-item">
            <p><strong>Room Number:</strong>
                <td>
                <td>{{ $report->room->room_number }}</td>
                </td>
            </p>
        </div>
        <div class="report-item">
            <p><strong>Main Category:</strong> {{ $report->main_category }}</p>
        </div>
        <div class="report-item">
            <p><strong>Sub Category:</strong> {{ $report->sub_category }}</p>
        </div>
        <div class="report-item">
            <p><strong>Description:</strong> {{ $report->description }}</p>
        </div>
        <div class="report-item">
            <p><strong>Contact Number:</strong> {{ $report->contact_number }}</p>
        </div>
        <div class="report-item">
            <p><strong>Permission:</strong> {{ $report->permission }}</p>
        </div>
        <div class="report-item">
            <p><strong>Date Submitted:</strong> {{ $report->created_at }}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('cspxx', $report->id) }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
