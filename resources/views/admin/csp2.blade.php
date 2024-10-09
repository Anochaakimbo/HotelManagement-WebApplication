<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/booking1.css') }}">
@extends('layouts.sidebar-admin')

@section('content')
    <div class="report-details">
        <h1>Report Details</h1>
        <div class="report-item">
            <p><strong>ชื่อผู้ใช้:</strong> {{ $report->user->name ?? 'N/A' }}</p>
        </div>
        <div class="report-item">
            <p><strong>หมายเลขห้อง:</strong> {{ $report->room->room_number ?? 'N/A' }}</p>
        </div>
        <div class="report-item">
            <p><strong>หมวดงานซ่อมหลัก:</strong> {{ $report->mainCategory->name ?? 'ไม่มีข้อมูลหมวดหมู่หลัก' }}</p>
        </div>
        <div class="report-item">
            <p><strong>หมวดงานซ่อมย่อย:</strong> {{ $report->subCategory->name ?? 'ไม่มีข้อมูลหมวดหมู่ย่อย' }}</p>
        </div>
        <div class="report-item">
            <p><strong>รายละเอียด:</strong> {{ $report->description }}</p>
        </div>
        <div class="report-item">
            <p><strong>เบอร์โทรติดต่อกลับ:</strong> {{ $report->contact_number ?? 'N/A' }}</p>
        </div>
        <div class="report-item">
            <p><strong>สิทธิ์ในการเข้าถึงห้อง:</strong> {{ $report->permission ?? 'N/A' }}</p>
        </div>
        <div class="report-item">
            <p><strong>วันที่แจ้ง:</strong> {{ $report->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('cspxx', $report->id) }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
