<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DestinasiWisataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// Authentication routes
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Registration
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::resource('warga', WargaController::class);
Route::resource('destinasi-wisata', DestinasiWisataController::class);