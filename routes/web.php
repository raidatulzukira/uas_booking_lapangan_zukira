<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LandingController;
use App\Models\ZukiraBooking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Tamu (Guest)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::resource('lapangan', LapanganController::class)->only(['index']);
Route::get('/lapangan/{id}', [LapanganController::class, 'show'])->name('lapangan.show'); // Beri nama untuk konsistensi
Auth::routes(); // Rute login, register, dll.

// Rute untuk Pengguna yang Sudah Login
Route::middleware(['auth'])->group(function () {
    
    // Rute Khusus Customer
    Route::middleware(['checkrole:customer'])->group(function() {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/home', fn() => redirect()->route('dashboard')); // Perbaikan typo dan redirect

        // Booking
        Route::resource('booking', BookingController::class)->except(['index']);
        Route::get('/riwayat-booking', [BookingController::class, 'riwayat'])->name('booking.riwayat');
        Route::get('/booking/detail/{id}', [BookingController::class, 'detail'])->name('booking.detail');
        Route::get('/booking/{booking}/download-ticket', [BookingController::class, 'downloadTicket'])->name('booking.downloadTicket');

        // Review
        Route::resource('review', ReviewController::class)->except(['index']);

        // Payment
        Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
        Route::post('/payment/upload/{booking}', [PaymentController::class, 'upload'])->name('payment.upload');
    });

    // Rute API untuk Pengguna Login (Customer & Admin)
    Route::get('/api/payment-status/{booking}', [PaymentController::class, 'checkStatus'])->name('payment.status');
});

// Rute API Khusus Admin
Route::middleware(['auth', 'checkrole:admin'])->group(function() {
    Route::get('/api/payment-history', [PaymentController::class, 'getPaymentHistory'])->name('payment.history');
    // Rute admin lainnya bisa ditambahkan di sini
});



// Route::get('/review', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/review', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/review/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/review', 'App\Http\Controllers\ReviewController@store')->name('review.store');
Route::get('/review/{id}/edit', 'ReviewController@edit')->name('review.edit');
Route::patch('/review/{id}', 'ReviewController@update')->name('review.update');
Route::delete('/review/{id}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');


Route::get('/cek-php', function () {
    // Tampilkan lokasi file php.ini yang sedang dipakai
    dd(php_ini_loaded_file());
});
