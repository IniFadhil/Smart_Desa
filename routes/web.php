<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLER FRONTEND ---
use App\Http\Controllers\Frontend\BumdesController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\RegisterController;

// --- CONTROLLER BACKEND ---
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Potensi\ListController;
use App\Http\Controllers\Backend\BUMDES\ProdukController;
use App\Http\Controllers\Backend\BUMDES\ProfilController;
use App\Http\Controllers\Backend\Manajemen\MenuController;
use App\Http\Controllers\Backend\Manajemen\RoleController;
use App\Http\Controllers\Backend\Manajemen\UserController;
use App\Http\Controllers\Backend\Manajemen\AdminController;
use App\Http\Controllers\Backend\Manajemen\ModulController;
use App\Http\Controllers\Backend\Informasi\AgendaController;
use App\Http\Controllers\Backend\Informasi\BeritaController;
use App\Http\Controllers\Backend\Potensi\KategoriController;
use App\Http\Controllers\Backend\DataMaster\SliderController;
use App\Http\Controllers\Backend\Informasi\KomentarController;
use App\Http\Controllers\Backend\Informasi\InfoGrafisController;
use App\Http\Controllers\Backend\Informasi\PengumumanController;
use App\Http\Controllers\Frontend\LoginController as FrontendLoginController;

// ... (dan semua use statement Anda yang lain)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// BUNGKUS SEMUA RUTE DENGAN MIDDLEWARE DOMAIN
Route::middleware('domain')->group(function () {

    //======================================================================
    // RUTE FRONTEND
    //======================================================================

    Route::get('/', [BerandaController::class, 'home'])->name('home');

    // --- Autentikasi Pengguna Biasa ---
    Route::middleware('guest:masyarakat')->group(function () {
        Route::get('/login', [FrontendLoginController::class, 'index'])->name('login');
        Route::post('/login', [FrontendLoginController::class, 'login']);
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });
    Route::middleware('auth:masyarakat')->group(function () {
        Route::post('/logout', [FrontendLoginController::class, 'logout'])->name('logout');
        // Route::view('dashboard', 'dashboard')->name('dashboard');
        Route::view('profile', 'profile')->name('profile');
    });

    // --- Halaman Profil ---
    Route::get('/sejarah-desa', function () {
        return view('frontend.profile.sejarah_desa');
    })->name('sejarah-desa');
    Route::get('/visi-misi', function () {
        return view('frontend.profile.visi_misi');
    })->name('visi-misi');
    Route::get('/gambaran-umum-desa', function () {
        return view('frontend.profile.gambaran_umum');
    })->name('gambaran-umum-desa');
    Route::get('/kondisi-geografis', function () {
        return view('frontend.profile.geografis');
    })->name('kondisi-geografis');

    // --- Grup Rute SUKET ---
    Route::prefix('suket')->name('suket.')->group(function () {
        Route::get('/sk-kematian', function () {
            return view('frontend.SUKET.SKM');
        })->name('sk-kematian');
        Route::get('/sk-usaha', function () {
            return view('frontend.SUKET.SKU');
        })->name('sk-usaha');
        // ... (dan semua rute suket Anda)
    });

    // --- Berita, Pengumuman, Agenda ---
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BerandaController::class, 'berita'])->name('index');
        Route::get('/{slug}', [BerandaController::class, 'beritaDetail'])->name('show');
    });
    Route::get('/pengumuman', [BerandaController::class, 'pengumuman'])->name('pengumuman.index');
    Route::get('/agenda', [BerandaController::class, 'agenda'])->name('agenda.index');

    // --- Rute Lainnya ---
    Route::get('/galeri-foto', function () {
        return view('frontend.foto');
    })->name('galeri-foto');
    Route::get('/galeri-vidio', function () {
        return view('frontend.vidio');
    })->name('galeri-video');
    Route::get('/hubungi-kami', function () {
        return view('frontend.hubungi_kami');
    })->name('hubungi-kami');
    // ... (dan semua rute frontend Anda yang lain)

    //======================================================================
    // RUTE BACKEND
    //======================================================================
    Route::prefix('backoffice')->name('backend.')->group(function () {

        // --- Rute Autentikasi Admin ---
        Route::name('auth.')->group(function () {
            Route::get('/login', [LoginController::class, 'index'])->name('login');
            Route::post('/login', [LoginController::class, 'login'])->name('prosesLogin');
            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
            Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reloadCaptcha');
        });

        // --- Rute yang Membutuhkan Login Admin ---
        Route::middleware('auth:admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Grup Manajemen
            Route::prefix('/manajemen')->name('manajemen.')->group(function () {
                Route::resource('modul', ModulController::class);
                Route::patch('/modul/{modul}/toggle-status', [ModulController::class, 'toggleStatus'])->name('modul.toggleStatus');
                Route::resource('menu', MenuController::class);
                Route::patch('/menu/{menu}/toggle-status', [MenuController::class, 'toggleStatus'])->name('menu.toggleStatus');
                Route::resource('role', RoleController::class);
                Route::patch('/role/{role}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
                Route::resource('admin', AdminController::class);
                Route::patch('/admin/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggleStatus');
                Route::resource('user', UserController::class);
                Route::patch('/user/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');
            });

            // Grup Informasi
            Route::prefix('informasi')->name('informasi.')->group(function () {
                Route::resource('agenda', AgendaController::class);
                Route::patch('/agenda/{agenda}/toggle-status', [AgendaController::class, 'toggleStatus'])->name('agenda.toggleStatus');
                Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
                Route::patch('/berita/{berita}/toggle-status', [BeritaController::class, 'toggleStatus'])->name('berita.toggleStatus');
                Route::resource('infoGrafis', InfoGrafisController::class)->parameters(['infoGrafis' => 'infoGrafis']);
                Route::patch('/infoGrafis/{infoGrafis}/toggle-status', [InfoGrafisController::class, 'toggleStatus'])->name('infoGrafis.toggleStatus');
                Route::resource('komentar', KomentarController::class);
                Route::patch('/komentar/{komentar}/toggle-status', [KomentarController::class, 'toggleStatus'])->name('komentar.toggleStatus');
                Route::resource('pengumuman', PengumumanController::class);
                Route::patch('/pengumuman/{pengumuman}/toggle-status', [PengumumanController::class, 'toggleStatus'])->name('pengumuman.toggleStatus');
            });

            // GRUP BUMDES
            Route::prefix('bumdes')->name('bumdes.')->group(function () {
                Route::resource('profil', ProfilController::class);
                Route::patch('/profil/{profil}/toggle-status', [ProfilController::class, 'toggleStatus'])->name('profil.toggleStatus');

                Route::resource('produk', ProdukController::class);
                Route::patch('/produk/{produk}/toggle-status', [ProdukController::class, 'toggleStatus'])->name('produk.toggleStatus');
            });

            // GRUP DATAMASTER
            Route::prefix('datamaster')->name('datamaster.')->group(function () {
                Route::resource('slider', SliderController::class);
                Route::patch('/slider/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('slider.toggleStatus');
            });

            // GRUP POTENSI
            Route::prefix('potensi')->name('potensi.')->group(function () {
                Route::resource('kategori', KategoriController::class);
                Route::patch('/kategori/{kategori}/toggle-status', [KategoriController::class, 'toggleStatus'])->name('kategori.toggleStatus');

                Route::resource('list', ListController::class);
                Route::patch('/list/{list}/toggle-status', [ListController::class, 'toggleStatus'])->name('list.toggleStatus');
            });
            // ... (dan semua grup rute backend Anda yang lain)
        });
    });
});