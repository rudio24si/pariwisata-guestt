<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\KamarHomestayController;
use App\Http\Controllers\BookingHomestayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UlasanWisataController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });
Route::get('/', [BookingHomestayController::class, 'index'])->name('dashboard');

// Authentication routes
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Registration
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);
Route::resource('destinasi-wisata', DestinasiWisataController::class);
Route::resource('homestay', HomestayController::class);
Route::resource('kamar-homestay', KamarHomestayController::class);
Route::resource('booking-homestay', BookingHomestayController::class);

Route::post('/ulasan-wisata', [UlasanWisataController::class, 'store'])
    ->name('ulasan-wisata.store');
Route::delete('/ulasan-wisata/{ulasan}', [UlasanWisataController::class, 'destroy'])
    ->name('ulasan-wisata.destroy');
Route::put('/ulasan-wisata/{id}', [UlasanWisataController::class, 'update'])->name('ulasan-wisata.update');


// Route::get('/booking/{kamar_id}', [BookingHomestayController::class, 'create'])
//     ->name('booking.create');

// Route::post('/booking', [BookingHomestayController::class, 'store'])
//     ->name('booking.store');
