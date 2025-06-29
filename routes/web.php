<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LandingController;

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'checkrole:customer'])->name('dashboard');

Route::get('/', [LandingController::class, 'index'])->name('landing');


Route::get('/lapangan/{id}', [LapanganController::class, 'show']);

Auth::routes();

Route::middleware(['auth', 'checkrole:customer'])->group(function () {
    Route::resource('booking', BookingController::class)->except(['index']);
    Route::resource('review', ReviewController::class)->except(['index']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments/upload', [PaymentController::class, 'upload']);
});


Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('booking.admin');
    Route::patch('/admin/bookings/{id}/konfirmasi', [BookingController::class, 'konfirmasi'])->name('booking.konfirmasi');
});





// ========================
// ✨ FRONTEND UMUM (Publik)
// ========================
// Route::get('/', [LapanganController::class, 'landing']); // landing page
// Route::get('/lapangan/{id}', [LapanganController::class, 'show']); // detail lapangan

// ====================
// 🔐 LOGIN (tanpa regis)
// ====================
// Auth::routes(['register' => false]);

// ============================
// 👤 CUSTOMER (dengan middleware)
// ============================
// Route::middleware(['auth', 'checkrole:customer'])->group(function () {
//     // Booking
//     Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
//     Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

//     // Payment
//     Route::get('/payments/create/{booking_id}', [PaymentController::class, 'create'])->name('payments.create');
//     Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

//     // Review
//     Route::get('/review/create/{lapangan_id}', [ReviewController::class, 'create'])->name('review.create');
//     Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
// });

// =========================
// 🛠️ ADMIN (dengan middleware)
// =========================
// Route::middleware(['auth', 'checkrole:admin'])->group(function () {
//     // Kelola Lapangan
//     Route::resource('/admin/lapangan', LapanganController::class);

//     // Manajemen Booking
//     Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings');
//     Route::post('/admin/bookings/konfirmasi/{id}', [BookingController::class, 'konfirmasi'])->name('admin.bookings.konfirmasi');

//     // Verifikasi Pembayaran
//     Route::post('/admin/payments/verifikasi/{id}', [PaymentController::class, 'verifikasi'])->name('admin.payments.verifikasi');
// });


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
