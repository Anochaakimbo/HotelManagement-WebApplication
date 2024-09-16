<?php
use App\Models\rooms;
use App\Models\Booking;
use GuzzleHttp\Middleware;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\AdminComtroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomdetailsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Rent_3Controller;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\RoompreController;
use App\Http\Controllers\RoomsingleController;
use App\Http\Controllers\RoomtwinController;

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
        return view('Report');
    })->name('Report');

    Route::get('/Payrent', [ChargeController::class, 'showPayRent'])->name('Payrent');

    Route::get('/Roomdetails', function () {
        return view('Roomdetails');
    })->name('Roomdetails');
});

// Routes for ChargeController and BookingController

Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->Middleware('admin');


route::get('/home',[HomeController::class,'index'])->name('home');
Route::post('/admin/create-user', [AdminComtroller::class, 'createUserFromBooking']);
route::get('/admin/booking',[HomeController::class,'booking'])->Middleware('admin')->name('booking');
route::get('/adminpage',[AdminComtroller::class,'index'])->Middleware('admin')->name('adminpage');
route::get('/guestpage',[HomeController::class,'guest'])->Middleware('auth')->name('guestpage');
route::get('/customerproblem',[HomeController::class,'customerprob'])->Middleware('admin')->name('customerproblem');

// Merged route for selectbook and bookings
Route::get('/select', function () {
    $rooms = rooms::all();
    $bookings = Booking::all();
    return view('selectbook', ['rooms' => $rooms], ['bookings' => $bookings]);
})->name('select');

Route::post('/guest/bookings/{booking}/pay', [BookingController::class, 'pay']);

// Admin routes
Route::post('/admin/create-user', [AdminComtroller::class, 'createUserFromBooking'])->name('admin.create.user')->Middleware('admin');
Route::post('/admin/booking/confirm/{id}', [AdminComtroller::class, 'confirmBooking'])->name('admin.booking.confirm.post')->Middleware('admin');
Route::post('/admin/booking/delete/{id}', [AdminComtroller::class, 'deleteBooking'])->name('admin.booking.delete')->Middleware('admin');

// Admin view routes
Route::get('/admin/booking', [HomeController::class, 'booking'])->Middleware('admin')->name('booking');
Route::get('/adminpage', [AdminComtroller::class, 'index'])->Middleware('admin')->name('adminpage');


// Routes for Room and Roomtype controllers
Route::get('/selectbook', [RoomtypeController::class, 'showAvailableRooms'])->name('selectbook');
Route::get('/Roomdetail_Guest_SingleBed', [RoomsingleController::class, 'showSingleBed'])->name('roomdetail-1');
Route::get('/Roomdetail_Guest_TwoBed', [RoomtwinController::class, 'showTwinBed'])->name('roomdetail-2');
Route::get('/Roomdetail_Guest_PremiumBed', [RoompreController::class, 'showPremiumBed'])->name('roomdetail-3');

// Problem report and booking confirmation
Route::get('/customerproblem', [HomeController::class, 'customerprob'])->Middleware('admin')->name('customerproblem');
Route::get('/admin/booking/confirm/{id}', [AdminComtroller::class, 'showConfirmBooking'])->name('admin.booking.confirm')->Middleware('admin');

// Billing routes
Route::post('/submit-billing', [ChargeController::class, 'calculate'])->name('EASYOKOK')->Middleware('admin');
Route::get('/billing', [ChargeController::class, 'showAdminForm'])->name('adminbilling')->Middleware('admin');
Route::post('/confirm-payment/{id}', [ChargeController::class, 'confirmPayment'])->name('confirmPayment');
Route::post('/pay-billing/{id}', [ChargeController::class, 'payBilling'])->name('payBilling');
Route::get('/history', [ChargeController::class, 'showPaymentHistory'])->name('history')->Middleware('admin');

// Rental views (multiple options)
Route::get('/Rent_1', function () {
    return view('rent_1');
})->name('rent_1');

Route::get('/Rent_2', function () {
    return view('rent_2');
})->name('rent_2');

Route::get('/rent_3', [Rent_3Controller::class, 'showPaymentPage'])->name('rent_3');

Route::get('/rent_4', [Rent_3Controller::class, 'showRent4'])->name('rent_4');

Route::get('/Rent_4_2', function () {
    return view('rent_4_2');
})->name('rent_4_2');

// Additional routes from arnoldtest2 branch
Route::get('/roomdetail',[HomeController::class,'roomdetail'])->Middleware('auth')->name('roomdetail');
Route::get('/roomdetail/delete/{room_id}',[HomeController::class,'delete'])->name('roomdelete');
Route::get('/Addroom/addroom',[HomeController::class,'preparetoAdd']);
Route::post('/Addroom/addroom',[HomeController::class,'addRoom']);
Route::get('/Addroom',[HomeController::class,'preparetoAdd'])->Middleware('auth')->name('Addroom');
