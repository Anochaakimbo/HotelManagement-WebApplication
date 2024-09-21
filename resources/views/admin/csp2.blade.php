@extends('layouts.sidebar-admin')
@section('content')
    <div class="report-details">
        <h1>Report Details</h1>
        <div class="report-item">
            <p><strong>User ID:</strong> {{ $report->user_id }}</p>
        </div>
        <div class="report-item">
            <p><strong>Room Number:</strong> {{ $report->room_number }}</p>
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
@endsection
