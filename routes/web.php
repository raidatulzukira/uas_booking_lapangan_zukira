<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PemesananController;

// use App\Http\Middleware\CheckUserRole

// Route::get('/home', function () {
//     return redirect('/dasboard');
// });

Route::get('/home', function () {
    return redirect('/dasboard');

});


// Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'checkrole:customer']);
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'checkrole:customer']);

// Route::get('/dashboard', function () {
//     return 'Dashboard aman';
// })->middleware(['auth']);



// Route::get('/admin/dashboard', [AdminController::class, 'index'])
//     ->middleware(['auth', 'checkrole:admin']);



// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'checkrole:customer'])->name('dashboard');

Route::get('/', [LandingController::class, 'index'])->name('landing');


Route::get('/lapangan/{id}', [LapanganController::class, 'show']);

Auth::routes();

Route::middleware(['auth', 'checkrole:customer'])->group(function () {
    Route::resource('booking', BookingController::class); // index, create, store, edit, update, destroy
    Route::resource('review', ReviewController::class)->except(['index']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments/upload', [PaymentController::class, 'upload']);
    // Route::get('/dashboard', [HomeController::class, 'index']);
});

Route::resource('lapangan', LapanganController::class)->only(['index']);

// Route::middleware(['auth', 'checkuserrole:admin'])->group(function () {
//     Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('booking.admin');
//     Route::patch('/admin/bookings/{id}/konfirmasi', [BookingController::class, 'konfirmasi'])->name('booking.konfirmasi');



// Route untuk menampilkan halaman form booking
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');

// Route untuk MENYIMPAN data dari form booking
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
// });
Route::get('/riwayat-booking', [BookingController::class, 'index'])->name('booking.index');

Route::get('/booking/detail/{id}', [BookingController::class, 'detail'])->name('booking.detail');

