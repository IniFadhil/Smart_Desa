<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang digunakan dari rekan Anda
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfilController;
use App\Http\Controllers\Backend\PengaturanController;
use App\Http\Controllers\Backend\MaintenanceController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Master\PendudukController;
// Jangan lupa import Captcha jika itu adalah class
// use Mews\Captcha\Facades\Captcha; // Uncomment jika Anda menggunakan package ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman utama (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk autentikasi frontend (login & register user biasa) dari Breeze
// INI SANGAT PENTING AGAR HALAMAN REGISTER ANDA BERFUNGSI
require __DIR__ . '/auth.php';


// --- GRUP UNTUK SEMUA ROUTE BACKEND (DARI REKAN ANDA) ---
Route::prefix('backoffice') // URL akan menjadi: /backoffice/dashboard, /backoffice/login, dst.
    ->name('backend.')      // Nama route akan menjadi: backend.dashboard, backend.auth.login, dst.
    // ->middleware('domain')   // Saya beri komentar dulu, bisa diaktifkan jika middleware 'domain' sudah ada
    ->group(function () {

        // == ROUTE UNTUK TAMU (TIDAK PERLU LOGIN) ==
        Route::name('auth.')->group(function () {
            Route::get('/login', [LoginController::class, 'index'])->name('login');
            Route::post('/login', [LoginController::class, 'login'])->name('prosesLogin');
            Route::get('/password/email', [ResetPasswordController::class, 'index'])->name('password');
        });

        // == ROUTE YANG MEMBUTUHKAN LOGIN ADMIN ==
        Route::middleware('auth:admin')->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Logout
            Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

            // Buku Tamu
            Route::get('/bukutamu', [DashboardController::class, 'bukuTamu'])->name('bukutamu');
            Route::get('/bukutamu/detail/{id}', [DashboardController::class, 'bukuTamuDetail'])->name('bukutamu.detail');

            // Profil & Akun
            Route::get('/profil-desa', [DashboardController::class, 'profilDesa'])->name('profilDesa');
            Route::post('/profil-desa', [DashboardController::class, 'updateProfilDesa'])->name('profilDesa.update');
            Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
            Route::post('/profil', [ProfilController::class, 'updateProfile'])->name('profil.update');
            Route::get('/akun', [ProfilController::class, 'showFormChangePassword'])->name('account');
            Route::post('/akun', [ProfilController::class, 'updatePassword'])->name('account.update');

            // Pengaturan
            Route::get('/pengaturan-website', [PengaturanController::class, 'index'])->name('setting');
            Route::post('/pengaturan-website', [PengaturanController::class, 'update'])->name('setting.update');

            // Logout Perangkat
            Route::post('/logout/all', [DashboardController::class, 'logoutAllDevices'])->name('logout.device.all');
            Route::post('/logout/device', [DashboardController::class, 'logoutByDevice'])->name('logout.device');

            // Maintenance Mode
            Route::get('/maintenance/down', [MaintenanceController::class, 'down'])->name('maintenance.on');
            Route::get('/maintenance/live', [MaintenanceController::class, 'live'])->name('maintenance.off');

            // Resource untuk Master Data (contoh: Penduduk)
            Route::resource('penduduk', PendudukController::class);
        });
    });