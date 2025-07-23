<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfilController;
use App\Http\Controllers\Backend\PengaturanController;
use App\Http\Controllers\Backend\MaintenanceController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Master\PendudukController;

// Rute untuk halaman utama (welcome page)
Route::get('/', function () {
    // Path yang benar: folder 'frontend', file 'home'
    return view('frontend.home');
})->name('home');

// NONAKTIFKAN baris ini untuk menghindari duplikasi route dengan Volt
// require __DIR__ . '/auth.php';


// Rute untuk halaman dashboard yang hanya bisa diakses setelah login
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute untuk profil pengguna yang hanya bisa diakses setelah login
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// Route BackEnd //
Route::prefix('backoffice')->name('backend.')->group(function () {
    // Rute tamu backend
    Route::name('auth.')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('prosesLogin');
        // Route::get('/password/email', [ResetPasswordController::class, 'index'])->name('password');
    });

    // Rute admin yang butuh login
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

        // ... sisa rute backend Anda sudah benar ...
        // Route::resource('penduduk', PendudukController::class);
    });
});
