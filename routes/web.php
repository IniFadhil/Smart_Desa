<?php

use Illuminate\Support\Facades\Route;
// use Livewire\Volt\Volt; // Komentari atau hapus jika tidak digunakan sama sekali
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfilController;
use App\Http\Controllers\Backend\PengaturanController;
use App\Http\Controllers\Backend\MaintenanceController;
use App\Http\Controllers\Backend\Auth\LoginController as BackendLoginController; // Alias untuk menghindari konflik nama
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Master\PendudukController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Import controller untuk login frontend
use App\Http\Controllers\Auth\RegisteredUserController; // Import controller untuk register frontend

// Rute untuk halaman utama (welcome page)
Route::get('/', function () {
    // Path yang benar: folder 'frontend', file 'home'
    return view('frontend.home');
})->name('home');

// NONAKTIFKAN baris ini untuk menghindari duplikasi route dengan Volt
// require __DIR__ . '/auth.php'; // Biarkan ini dikomentari sesuai keinginan Anda

// --- START: Rute Autentikasi Frontend (Pengguna Biasa) ---
// Karena 'auth.php' dikomentari, kita definisikan rute login dan register frontend di sini.
Route::middleware('guest')->group(function () {
    // Rute untuk menampilkan form login frontend
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login'); // Nama rute ini harus 'login' sesuai form action di blade

    // Rute untuk memproses login frontend (POST request)
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Rute untuk menampilkan form register frontend
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Rute untuk memproses pendaftaran frontend (POST request)
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Fitur "Lupa kata sandi?" tidak diaktifkan, jadi tidak ada rute terkait di sini.
});

// Rute untuk logout frontend (pengguna biasa)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
// --- END: Rute Autentikasi Frontend (Pengguna Biasa) ---


// Rute untuk halaman dashboard yang hanya bisa diakses setelah login (pengguna biasa)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute untuk profil pengguna yang hanya bisa diakses setelah login (pengguna biasa)
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// Rute untuk halaman Sejarah Desa
Route::get('/sejarah-desa', function () {
    return view('frontend.profile.sejarah_desa');
})->name('sejarah-desa');

// Rute untuk halaman Visi dan Misi
Route::get('/visi-misi', function () {
    return view('frontend.profile.visi_misi');
})->name('visi-misi');

// Rute untuk halaman Gambaran Umum Desa
Route::get('/gambaran-umum-desa', function () {
    return view('frontend.profile.gambaran_umum');
})->name('gambaran-umum-desa');

// Rute untuk halaman Kondisi Geografis
Route::get('/kondisi-geografis', function () {
    return view('frontend.profile.geografis'); // <--- PASTIKAN INI ADALAH 'frontend.profile.geografis'
})->name('kondisi-geografis');


// Route BackEnd //
Route::prefix('backoffice')->name('backend.')->group(function () {
    // Rute tamu backend (untuk admin)
    Route::name('auth.')->group(function () {
        Route::get('/login', [BackendLoginController::class, 'index'])->name('login');
        Route::post('/login', [BackendLoginController::class, 'login'])->name('prosesLogin');
        // Route::get('/password/email', [ResetPasswordController::class, 'index'])->name('password'); // Jika ada reset password admin
    });

    // Rute admin yang butuh login
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [BackendLoginController::class, 'logout'])->name('logout'); // Sesuaikan nama rute logout admin

        // ... sisa rute backend Anda yang lain ...
        // Route::resource('penduduk', PendudukController::class);
    });
});
