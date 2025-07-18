<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Master\PendudukController;

Route::get('/', function () {
    return view('welcome');
});

// Grup untuk semua route backend/admin
Route::prefix('admin')->group(function () {

    // Route untuk dashboard
    Route::get('/dashboard', function () {
        return "Ini halaman dashboard admin";
    })->name('admin.dashboard');

    // Route untuk CRUD data penduduk
    // URL yang akan dibuat: admin/penduduk, admin/penduduk/create, dll.
    Route::resource('penduduk', PendudukController::class);
});


// ->middleware(['auth'])