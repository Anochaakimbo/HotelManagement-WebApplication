@extends('layouts.sidebar-admin')
@section('content')
<h1>สวัสดี!! {{ Auth::user()->name }}</h1>
<p>คุณสามารถจัดการระบบต่างๆได้แล้ว!</p>
@endsection

