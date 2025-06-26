<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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
