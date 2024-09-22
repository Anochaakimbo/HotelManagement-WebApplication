<link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
@extends('layouts.sidebar-admin')

@section('content')
    <div class="report-info">
        <div class="details">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Roomnumber</th>
                        <th>User Name</th>
                        <th>Description</th>
                        <th>Date Submitted</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->room->room_number }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->main_category }}</td>
                            <td>{{ $report->created_at }}</td>
                            <td>
                                <a href="{{ route('csp2.view', $report->id) }}" class="viewbutton">View</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
