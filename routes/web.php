<?php
use App\Models\rooms;
use App\Models\Booking;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
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
    Route::get('/Report', function () {
        return view('Report');})->name('Report');
    Route::get('/Payrent', function () {
        return view('Payrent');
    })->name('Payrent');
    Route::get('/Roomdetails', function () {
        return view('Roomdetails');
    })->name('Roomdetails');
});
Route::delete('/admin/bookings/{booking}/delete', [BookingController::class, 'destroy'])->Middleware('admin');
Route::post('/guest/book', [BookingController::class, 'create']);
Route::post('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->Middleware('admin');
route::get('/home',[HomeController::class,'index']);

route::get('/admin/booking',[HomeController::class,'booking'])->Middleware('admin')->name('booking');

route::get('/adminpage',[HomeController::class,'page'])->Middleware('admin')->name('adminpage');

route::get('/guestpage',[HomeController::class,'guest'])->Middleware('admin')->name('guestpage');

route::get('/customerproblem',[HomeController::class,'customerprob'])->Middleware('admin')->name('customerproblem');

Route::get('/select', function () {
    $rooms = rooms::all();
    $bookings = Booking::all();
    return view('selectbook',['rooms' => $rooms],['bookings' => $bookings]);
})->name('select');

Route::post('/guest/bookings/{booking}/pay', [BookingController::class, 'pay']);



// Route::get('/Roomdetails', function () {
//     return view('Roomdetails');
// })->name('Roomdetails');

// Route::get('/Payrent', function () {
//     return view('Payrent');
// })->name('Payrent');