<?php

use App\Models\rooms;
use App\Models\Booking;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\AdminComtroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Rent_3Controller;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\RoompreController;
use App\Http\Controllers\RoomsingleController;
use App\Http\Controllers\RoomtwinController;
use App\Http\Controllers\PaymentCreditController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\PaymentQrcodeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\IssueReportController;
use App\Http\Controllers\cspController;
use App\Http\Controllers\csp2Controller;
use App\Http\Controllers\ReportHistoryController;

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
Route::post('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->middleware('admin');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/admin/create-user', [AdminComtroller::class, 'createUserFromBooking']);
Route::get('/admin/booking', [HomeController::class, 'booking'])->middleware('admin')->name('booking');
Route::get('/adminpage', [AdminComtroller::class, 'index'])->middleware('admin')->name('adminpage');
Route::get('/guestpage', [AdminComtroller::class, 'guest'])->middleware('admin')->name('guestpage');
Route::get('/cspxx', [ReportController::class, 'index'])->middleware('admin')->name('cspxx');

// Merged route for selectbook and bookings
Route::get('/select', function () {
    $rooms = rooms::all();
    $bookings = Booking::all();
    return view('selectbook', ['rooms' => $rooms], ['bookings' => $bookings]);
})->name('select');

Route::post('/guest/bookings/{booking}/pay', [BookingController::class, 'pay']);

// Admin routes
Route::post('/admin/create-user', [AdminComtroller::class, 'createUserFromBooking'])->name('admin.create.user')->middleware('admin');
Route::post('/admin/booking/confirm/{id}', [AdminComtroller::class, 'confirmBooking'])->name('admin.booking.confirm.post')->middleware('admin');
Route::post('/admin/booking/delete/{id}', [AdminComtroller::class, 'deleteBooking'])->name('admin.booking.delete')->middleware('admin');

// Admin view routes
Route::get('/admin/booking', [HomeController::class, 'booking'])->middleware('admin')->name('booking');
Route::get('/adminpage', [AdminComtroller::class, 'index'])->middleware('admin')->name('adminpage');
Route::get('/booking-history', [BookingController::class, 'historybooking'])->middleware('admin')->name('bookinghistory');

// Routes for Room and Roomtype controllers
Route::get('/selectbook', [RoomtypeController::class, 'showAvailableRooms'])->name('selectbook');
Route::get('/Roomdetail_Guest_SingleBed', [RoomsingleController::class, 'showSingleBed'])->name('roomdetail-1');
Route::get('/Roomdetail_Guest_TwoBed', [RoomtwinController::class, 'showTwinBed'])->name('roomdetail-2');
Route::get('/Roomdetail_Guest_PremiumBed', [RoompreController::class, 'showPremiumBed'])->name('roomdetail-3');

// Problem report and booking confirmation
Route::get('/customerproblem', [HomeController::class, 'customerprob'])->middleware('admin')->name('customerproblem');
Route::get('/admin/booking/confirm/{id}', [AdminComtroller::class, 'showConfirmBooking'])->name('admin.booking.confirm')->middleware('admin');

// Billing routes
Route::post('/submit-billing', [ChargeController::class, 'calculate'])->name('EASYOKOK')->middleware('admin');
Route::get('/billing', [ChargeController::class, 'showAdminForm'])->name('adminbilling')->middleware('admin');
Route::get('/billing-confirm', [ChargeController::class, 'showAdminForm1'])->name('confirmbill')->middleware('admin');
Route::post('/confirm-payment/{id}', [ChargeController::class, 'confirmPayment'])->name('confirmPayment');
Route::post('/billing/deny/{id}', [ChargeController::class, 'denyPayment'])->name('denyPayment');
Route::post('/pay-billing/{id}', [ChargeController::class, 'payBilling'])->name('payBilling');
Route::get('/payment-history', [ChargeController::class, 'showPaymentHistory'])->name('paymenthistory')->middleware('admin');

// Rental views (multiple options)
Route::get('/Rent_1', function () {
    return view('rent_1');
})->name('rent_1');

Route::get('/rent_2/{guest_id}', [Rent_3Controller::class, 'showRent2'])->name('rent_2');
Route::get('/rent_3', [Rent_3Controller::class, 'showPaymentPage'])->name('rent_3');
Route::get('/rent_4', [Rent_3Controller::class, 'showRent4'])->name('rent_4');
Route::get('/Rent_4_2', [Rent_3Controller::class, 'showRent4'])->name('rent_4_2');

// Payment processing routes
Route::post('/payment-process-Qr', [PaymentQrcodeController::class, 'processQrPayment'])->name('payment_process_qr');
Route::post('/payment-process-CreditCard', [PaymentCreditController::class, 'processPayment'])->name('payment_process');
Route::post('/upload-slip/{billing}', [PaymentQrcodeController::class, 'uploadSlip'])->name('uploadSlip');

// Additional routes from arnoldtest2 branch
Route::get('/roomdetail', [HomeController::class, 'roomdetail'])->middleware('admin')->name('roomdetail');
Route::get('/roomdetail/delete/{room_id}', [HomeController::class, 'delete'])->name('roomdelete');
Route::get('/Addroom/addroom', [HomeController::class, 'preparetoAdd']);
Route::post('/Addroom/addroom', [HomeController::class, 'addRoom']);
Route::get('/Addroom', [HomeController::class, 'preparetoAdd'])->middleware('admin')->name('Addroom');

// Booking details and room updates
Route::get('/booking_detail', [BookingDetailController::class, 'showBookings'])->name('booking_detail');
Route::get('/guest/{id}', [AdminComtroller::class, 'showinfo'])->name('guest.details');
Route::get('/roomdetail/updated', [HomeController::class, 'showDetailroom']);
Route::post('/roomdetail/updated', [HomeController::class, 'updateroom']);
Route::get('/checkout/{id}', [AdminComtroller::class, 'checkout'])->name('guest.checkout');
Route::get('/search', [BookingDetailController::class, 'search'])->name('search');

// Report-related routes
Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
Route::get('/csp/delete/{id}', [cspController::class, 'destroy'])->name('reportdelete');
Route::get('/csp2/view/{id}', [csp2Controller::class, 'view'])->name('csp2.view');

// Report history
Route::get('/report-history', [ReportHistoryController::class, 'index'])->name('report-history');
Route::delete('/reports/{id}', [ReportHistoryController::class, 'destroy'])->name('reports.destroy');

