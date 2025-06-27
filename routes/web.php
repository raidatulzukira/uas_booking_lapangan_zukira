<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

// // Halaman depan untuk publik
// Route::get('/', function () {
//     return view('welcome'); // Nanti bisa ganti ke halaman landing booking
// });

// // Nonaktifkan register
// Auth::routes(['register' => false]);

// // Home setelah login (sementara)
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Contoh routing untuk admin
// Route::middleware(['auth', 'checkrole:admin'])->group(function () {
//     Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
// });

// // Contoh routing untuk customer
// Route::middleware(['auth', 'checkrole:customer'])->group(function () {
//     Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
// });




// Guest / Frontend
Route::get('/', [LapanganController::class, 'index']);
Route::get('/lapangan/{id}', [LapanganController::class, 'show']);

// Auth
Auth::routes(['register' => false]);

// Customer
// Route::middleware(['auth', 'checkrole:customer'])->group(function () {
//     Route::get('/booking', [BookingController::class, 'index']);
//     Route::post('/booking', [BookingController::class, 'store']);
//     Route::get('/payments', [PaymentController::class, 'index']);
//     Route::post('/payments', [PaymentController::class, 'upload']);
//     Route::post('/review', [ReviewController::class, 'store']);
// });

// Customer
Route::middleware(['auth', 'checkrole:customer'])->group(function () {
    Route::resource('booking', BookingController::class)->except(['index']);
    Route::resource('review', ReviewController::class)->except(['index']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments/upload', [PaymentController::class, 'upload']);
});

// Admin
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::resource('/admin/lapangan', LapanganController::class);
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex']);
    Route::post('/admin/bookings/konfirmasi/{id}', [BookingController::class, 'konfirmasi']);
    Route::post('/admin/payments/verifikasi/{id}', [PaymentController::class, 'verifikasi']);
    // Route::get('/admin/bookings', [BookingController::class, 'adminIndex']);
    // Route::post('/admin/bookings/konfirmasi/{id}', [BookingController::class, 'konfirmasi']);
    // Route::get('/admin/payments', [PaymentController::class, 'adminIndex']);
    // Route::post('/admin/payments/verifikasi/{id}', [PaymentController::class, 'verifikasi']);
});

// Untuk publik (landing page)
Route::get('/', [LapanganController::class, 'landing']);

// Untuk admin (halaman kelola data lapangan)
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::resource('/admin/lapangan', LapanganController::class);
});


Route::get('/lapangan/{id}', [LapanganController::class, 'show']);

Route::middleware(['auth', 'checkrole:customer'])->group(function () {
    Route::get('/booking/create', [BookingController::class, 'create']);
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/payments/create/{booking_id}', [PaymentController::class, 'create']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/review/create/{lapangan_id}', [ReviewController::class, 'create']);
    Route::post('/review', [ReviewController::class, 'store']);
});

