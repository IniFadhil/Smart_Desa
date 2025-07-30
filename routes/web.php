<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Auth\LoginController as BackendLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\BumdesController;

// Rute untuk halaman utama (welcome page)
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// routue bumdes produk //
Route::get('/bumdes/produk', [BumdesController::class, 'produk'])->name('bumdes.produk');

// route bumdes profile //
Route::get('/bumdes/profil', [BumdesController::class, 'profil'])->name('bumdes.profil');
// NONAKTIFKAN baris ini untuk menghindari duplikasi route dengan Volt
// require __DIR__ . '/auth.php';

// --- START: Rute Autentikasi Frontend (Pengguna Biasa) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
// --- END: Rute Autentikasi Frontend (Pengguna Biasa) ---


// Rute untuk halaman dashboard yang hanya bisa diakses setelah login (pengguna biasa)
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk profil pengguna yang hanya bisa diakses setelah login (pengguna biasa)
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');


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
    return view('frontend.profile.geografis');
})->name('kondisi-geografis');


// Grup Rute untuk SUKET (Surat Keterangan)
Route::prefix('suket')->name('suket.')->group(function () {
    Route::get('/sk-kematian', function () { return view('frontend.SUKET.SKM'); })->name('sk-kematian');
    Route::get('/sk-usaha', function () { return view('frontend.SUKET.SKU'); })->name('sk-usaha');
    Route::get('/sk-beda-nama', function () { return view('frontend.SUKET.SKBN'); })->name('sk-beda-nama');
    Route::get('/sk-tidak-mampu', function () { return view('frontend.SUKET.SKTM'); })->name('sk-tidak-mampu');
    Route::get('/sk-penghasilan', function () { return view('frontend.SUKET.SKP'); })->name('sk-penghasilan');
    Route::get('/sk-status-pernikahan', function () { return view('frontend.SUKET.SKSP'); })->name('sk-status-pernikahan');
    Route::get('/sk-riwayat-tanah', function () { return view('frontend.SUKET.SKRT'); })->name('sk-riwayat-tanah');
    Route::get('/sk-kelahiran', function () { return view('frontend.SUKET.SKL'); })->name('sk-kelahiran');
    Route::get('/sk-ahli-waris', function () { return view('frontend.SUKET.SKAW'); })->name('sk-ahli-waris');
    Route::get('/sk-lain', function () { return view('frontend.SUKET.SJ'); })->name('sk-lain');
});


// Rute untuk halaman Galeri Foto
Route::get('/galeri-foto', function () {
    return view('frontend.foto');
})->name('galeri-foto');

// Rute untuk halaman Galeri Video
Route::get('/galeri-vidio', function () {
    return view('frontend.vidio');
})->name('galeri-video');


// --- START: Rute Berita (KHUSUS UNTUK UI/FRONT-END SAJA) ---
Route::prefix('berita')->name('berita.')->group(function () {
    // Rute untuk menampilkan formulir unggah berita baru (INI HARUS DI ATAS)
    Route::get('/upload', function () {
        return view('frontend.berita.upload');
    })->name('upload.create');

    // Rute untuk mensimulasikan proses unggah berita (pengiriman formulir)
    Route::post('/upload', function () {
        if (!request()->filled('title') || !request()->filled('short_content') || !request()->filled('content')) {
            return back()->withInput()->with('error', 'Semua kolom bertanda * wajib diisi.');
        }
        return back()->with('success', 'Berita Anda berhasil diunggah (simulasi)!');
    })->name('upload.store');

    // Rute untuk menampilkan daftar semua berita (index)
    Route::get('/', function () {
        return view('frontend.berita.index');
    })->name('index');

    // Rute untuk menampilkan detail berita berdasarkan slug (INI DIBAWAH KARENA PALING GENERAL)
    Route::get('/{slug}', function ($slug) {
        return view('frontend.berita.show');
    })->name('show');
});
// --- END: Rute Berita

// Rute untuk Halaman Hubungi Kami
Route::get('/hubungi-kami', function () {
    return view('frontend.hubungi_kami'); // Pastikan nama file blade sudah benar
})->name('hubungi-kami');

Route::get('/pengumuman', function () {
    // Laravel mencari file 'pengumuman.blade.php' di dalam folder 'frontend'
    return view('frontend.pengumuman');
})->name('pengumuman.index');


// --- Route BackEnd --- //
Route::prefix('backoffice')->name('backend.')->group(function () {
    // Rute tamu backend (untuk admin)
    Route::name('auth.')->group(function () {
        Route::get('/login', [BackendLoginController::class, 'index'])->name('login');
        Route::post('/login', [BackendLoginController::class, 'login'])->name('prosesLogin');
    });

    // Rute admin yang butuh login
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [BackendLoginController::class, 'logout'])->name('auth.logout');
    });
});