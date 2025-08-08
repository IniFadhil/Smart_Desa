<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLER FRONTEND ---
use App\Http\Controllers\Frontend\BumdesController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\RegisterController;

// --- CONTROLLER BACKEND ---
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Dokumen\SkkController;
use App\Http\Controllers\Backend\Dokumen\SkmController;
use App\Http\Controllers\Backend\Dokumen\SknController;
use App\Http\Controllers\Backend\Dokumen\SkpController;
use App\Http\Controllers\Backend\Dokumen\SkuController;
use App\Http\Controllers\Backend\Galeri\FotoController;
use App\Http\Controllers\Backend\Dokumen\SkawController;
use App\Http\Controllers\Backend\Dokumen\SkbnController;
use App\Http\Controllers\Backend\Dokumen\SkrtController;
use App\Http\Controllers\Backend\Dokumen\SksjController;
use App\Http\Controllers\Backend\Dokumen\SktmController;
use App\Http\Controllers\Backend\Galeri\VideoController;
use App\Http\Controllers\Backend\Kontak\PesanController;
use App\Http\Controllers\Backend\Potensi\ListController;
use App\Http\Controllers\Backend\BUMDES\ProdukController;
use App\Http\Controllers\Backend\BUMDES\ProfilController;
use App\Http\Controllers\Backend\Pemdes\PerdesController;
use App\Http\Controllers\Backend\Manajemen\MenuController;
use App\Http\Controllers\Backend\Manajemen\RoleController;
use App\Http\Controllers\Backend\Manajemen\UserController;
use App\Http\Controllers\Backend\Pemdes\JabatanController;
use App\Http\Controllers\Backend\Manajemen\AdminController;
use App\Http\Controllers\Backend\Manajemen\ModulController;
use App\Http\Controllers\Backend\Pemdes\StrukturController;
use App\Http\Controllers\Backend\Dokumen\DownloadController;
use App\Http\Controllers\Backend\Informasi\AgendaController;
use App\Http\Controllers\Backend\Informasi\BeritaController;
use App\Http\Controllers\Backend\Potensi\KategoriController;
use App\Http\Controllers\Backend\DataMaster\SliderController;
use App\Http\Controllers\Backend\Informasi\KomentarController;
use App\Http\Controllers\Backend\Informasi\InfoGrafisController;
use App\Http\Controllers\Backend\Informasi\PengumumanController;
use App\Http\Controllers\Frontend\LoginController as FrontendLoginController;
use App\Http\Controllers\Backend\Progdes\ListController as ProgramListController;
use App\Http\Controllers\Backend\Progdes\KategoriController as ProgramKategoriController;
use App\Http\Controllers\Backend\Pengaturan\PassphraseController;




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

    // routue bumdes produk //
    Route::get('/bumdes/produk', [BumdesController::class, 'produk'])->name('bumdes.produk');

    // route bumdes profile //
    Route::get('/bumdes/profil', [BumdesController::class, 'profil'])->name('bumdes.profil');

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
        Route::get('/sk-beda-nama', function () {
            return view('frontend.SUKET.SKBN');
        })->name('sk-beda-nama');
        Route::get('/sk-tidak-mampu', function () {
            return view('frontend.SUKET.SKTM');
        })->name('sk-tidak-mampu');
        Route::get('/sk-penghasilan', function () {
            return view('frontend.SUKET.SKP');
        })->name('sk-penghasilan');
        Route::get('/sk-status-pernikahan', function () {
            return view('frontend.SUKET.SKSP');
        })->name('sk-status-pernikahan');
        Route::get('/sk-riwayat-tanah', function () {
            return view('frontend.SUKET.SKRT');
        })->name('sk-riwayat-tanah');
        Route::get('/sk-kelahiran', function () {
            return view('frontend.SUKET.SKL');
        })->name('sk-kelahiran');
        Route::get('/sk-ahli-waris', function () {
            return view('frontend.SUKET.SKAW');
        })->name('sk-ahli-waris');
        Route::get('/sk-lain', function () {
            return view('frontend.SUKET.SJ');
        })->name('sk-lain');
    });

    // --- Berita, Pengumuman, Agenda ---
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BerandaController::class, 'berita'])->name('index');
        Route::get('/{slug}', [BerandaController::class, 'beritaDetail'])->name('show');
    });
    Route::get('/pengumuman', [BerandaController::class, 'pengumuman'])->name('pengumuman.index');
    Route::get('/agenda', [BerandaController::class, 'agenda'])->name('agenda.index');

    // Rute untuk halaman Kepala Desa
    Route::get('/pemerintah-desa/kepala_desa', function () {
        return view('frontend.pemdes.kepala_desa');
    })->name('pemerintah.kepala_desa');

    // TAMBAHKAN RUTE INI untuk halaman Perangkat Desa
    Route::get('/pemerintah-desa/perangkat_desa', function () {
        return view('frontend.pemdes.perangkat_desa');
    })->name('pemerintah.perangkat_desa');


    // Rute untuk halaman Kantor Desa
    Route::get('/profil-desa/kantor-desa', function () {
        return view('frontend.pemdes.kantor_desa');
    })->name('profil.kantor-desa');

    Route::get('/pemerintah-desa/struktur_organisasi', function () {
        return view('frontend.pemdes.struktur_organisasi');
    })->name('pemerintah.struktur_organisasi');

    Route::get('/potensi-desa/kuliner', function () {
        return view('frontend.potdes.kuliner');
    })->name('potensi.kuliner');

    // Rute untuk halaman Wisata
    Route::get('/potensi-desa/wisata', function () {
        // Pastikan Anda sudah membuat file wisata.blade.php di dalam folder potdes
        return view('frontend.potdes.wisata'); // Mengarah ke resources/views/frontend/potdes/wisata.blade.php
    })->name('potensi.wisata');

    Route::get('/potensi-desa/wisata/{slug}', function ($slug) {
        // Nanti, backend akan menggunakan $slug untuk mengambil data dari database
        return view('frontend.potdes.detail-wisata');
    })->name('potensi.wisata.detail');

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

            // --- SURAT KETERANGAN
            Route::prefix('dokumen')->name('dokumen.')->group(function () {
                Route::resource('download', DownloadController::class);
                Route::resource('skaw', SkawController::class);
                Route::resource('skbn', SkbnController::class);
                Route::resource('skk', SkkController::class);
                Route::resource('skm', SkmController::class);
                Route::resource('skn', SknController::class);
                Route::resource('skp', SkpController::class);
                Route::resource('skrt', SkrtController::class);
                Route::resource('sksj', SksjController::class);
                Route::resource('sktm', SktmController::class);
                Route::resource('sku', SkuController::class);
            });

            // Grup Program Desa
            Route::prefix('program')->name('program.')->group(function () {
                Route::resource('kategori', ProgramKategoriController::class, ['names' => 'category']);
                Route::patch('/kategori/{kategori}/toggle-status', [ProgramKategoriController::class, 'toggleStatus'])->name('category.toggleStatus');
                Route::resource('kegiatan', ProgramListController::class);
                Route::patch('/kegiatan/{kegiatan}/toggle-status', [ProgramListController::class, 'toggleStatus'])->name('kegiatan.toggleStatus');
            });

            // Grup Galeri
            Route::prefix('galeri')->name('galeri.')->group(function () {
                Route::resource('foto', FotoController::class);
                Route::patch('/foto/{foto}/toggle-status', [FotoController::class, 'toggleStatus'])->name('foto.toggleStatus');
                Route::resource('video', VideoController::class);
                Route::patch('/video/{video}/toggle-status', [VideoController::class, 'toggleStatus'])->name('video.toggleStatus');
            });

            // Grup Kontak
            Route::prefix('kontak')->name('kontak.')->group(function () {
                Route::resource('pesan', PesanController::class);
                Route::patch('/pesan/{pesan}/toggle-status', [PesanController::class, 'toggleStatus'])->name('pesan.toggleStatus');
            });

            // Grup Pemerintah Desa (Pemdes)
            Route::prefix('pemdes')->name('pemdes.')->group(function () {
                Route::resource('jabatan', JabatanController::class);
                Route::patch('/jabatan/{jabatan}/toggle-status', [JabatanController::class, 'toggleStatus'])->name('jabatan.toggleStatus');
                Route::resource('perdes', PerdesController::class);
                Route::patch('/perdes/{perde}/toggle-status', [PerdesController::class, 'toggleStatus'])->name('perdes.toggleStatus');
                Route::resource('struktur', StrukturController::class);
            });

            Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
                Route::resource('passphrase', PassphraseController::class);
                Route::patch('/passphrase/{passphrase}/toggle-status', [PassphraseController::class, 'toggleStatus'])->name('passphrase.toggleStatus');
            });
            // ... (dan semua grup rute backend Anda yang lain)
        });
    });
});
