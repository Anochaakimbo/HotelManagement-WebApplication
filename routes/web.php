<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
});


route::get('/home',[HomeController::class,'index']);

route::get('/adminpage',[HomeController::class,'page'])->Middleware('admin')->name('adminpage');

route::get('/guestpage',[HomeController::class,'guest'])->Middleware('admin')->name('guestpage');

Route::get('/select', function () {
    return view('selectbook');
});

Route::get('/Roomdetails', function () {
    return view('Roomdetails');  
})->name('Roomdetails');

Route::get('/Payrent', function () {
    return view('Payrent');
})->name('Payrent');

Route::get('/Report', function () {
    return view('Report');
})->name('Report');
