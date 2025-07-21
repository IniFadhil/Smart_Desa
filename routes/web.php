<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Master\PendudukController;

Route::get('/', function () {
    return view('welcome');
});

// Ini adalah rute autentikasi dari Breeze
// Baris ini yang hilang dan menyebabkan error
require __DIR__.'/auth.php';

// Grup untuk semua route backend/admin
Route::prefix('admin')->group(function () {
    // Route untuk dashboard
    Route::get('/dashboard', function () {
        return "Ini halaman dashboard admin";
    })->name('admin.dashboard')->middleware('auth'); // Tambahkan middleware auth

    // Route untuk CRUD data penduduk
    Route::resource('penduduk', PendudukController::class)->middleware('auth');
});