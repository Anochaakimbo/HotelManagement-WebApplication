<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use PHPUnit\Framework\Attributes\Group;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/Roomdetails', function () {
        return view('Roomdetails');  // ชื่อไฟล์ต้องตรงกันกับที่อยู่ใน views
    })->name('Roomdetails');
    Route::get('/Payrent', function () {
        return view('Payrent');
    })->name('Payrent');
    Route::get('/Report', function () {
        return view('Report');
    })->name('Report');
});

route::get('/home',[HomeController::class,'index'])->name('home');

route::get('/adminpage',[HomeController::class,'page'])->Middleware('admin')->name('adminpage');

route::get('/guestpage',[HomeController::class,'guest'])->Middleware('auth')->name('guestpage');

Route::get('/select', function () {
    return view('selectbook');
});

Route::get('/Roomdetail_Guest', function () {
    return view('roomdetail');
});
