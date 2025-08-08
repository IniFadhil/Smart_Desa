<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('domain')->namespace('Frontend')->group(function () {
    Route::get('/sukses',function(){
        return view('webview.sukses');
    })->name('frontend.success');
  	Route::get('/privacy-policy',function(){
      return view('frontend.privacy');
    });
    Route::get('/dokumen/{jenis_surat}/{no_surat}/detail', 'BerandaController@dokPdfView')->name('frontend.dokumen.pdfView');
    Route::get('/sitemap.xml', 'BerandaController@sitemap')->name('frontend.sitemap');
    Route::get('/register', 'RegisterController@index')->name('frontend.register');
	Route::get('/login', 'LoginController@index')->name('frontend.login');
    Route::post('/login', 'LoginController@login')->name('frontend.login.proses');
    Route::get('/logout', 'LoginController@logout')->name('frontend.logout');
    Route::post('/register', 'RegisterController@register')->name('frontend.register.proses');
    Route::post('/register/otp', 'RegisterController@verifikasi')->name('frontend.verifikasi');
    Route::get('/password-reset', 'RegisterController@password')->name('frontend.forgotPassword');
    Route::post('/password-reset', 'RegisterController@passwordReset')->name('frontend.password.reset');
    Route::post('/komentar', 'BerandaController@komentar')->name('frontend.komentar');
    //Subscribe
    // Route::post('/subscribe', 'SubscribeController@subscribe')->name('frontend.subscribe');
  	Route::get('/', 'BerandaController@home')->name('frontend.home');
    Route::get('/agenda', 'BerandaController@agenda')->name('frontend.agenda.list');
    Route::get('/agenda/{slug}', 'BerandaController@agendaDetail')->name('frontend.agenda.detail');
    Route::get('/berita', 'BerandaController@berita')->name('frontend.berita.list');
    Route::get('/berita/{slug}', 'BerandaController@beritaDetail')->name('frontend.berita.detail');
    Route::get('/pengumuman', 'BerandaController@pengumuman')->name('frontend.pengumuman.list');
    Route::get('/pengumuman/{slug}', 'BerandaController@pengumumanDetail')->name('frontend.pengumuman.detail');
    Route::get('/infografis/list', 'BerandaController@infografis')->name('frontend.infografis');
    Route::get('/infografis/{slug}', 'BerandaController@infografisDetail')->name('frontend.infografis.detail');
    Route::get('/foto', 'BerandaController@foto')->name('frontend.foto.list');
    Route::get('/foto/{slug}', 'BerandaController@fotoDetail')->name('frontend.foto.detail');
    Route::get('/video', 'BerandaController@video')->name('frontend.video.list');
    Route::get('/video/{slug}', 'BerandaController@videoDetail')->name('frontend.video.detail');
    Route::get('/download', 'BerandaController@download')->name('frontend.download.list');
    Route::get('/download/{slug}', 'BerandaController@downloadDetail')->name('frontend.download.detail');
	//Hubungi Kami
    Route::get('/kontak', 'BerandaController@bukutamu')->name('frontend.hubungikami');
    Route::post('/kontak', 'BerandaController@kirim')->name('frontend.hubungikami.kirim');
	//Cari
	Route::post('/pencarian', 'BerandaController@cari')->name('frontend.search');
    //Profil Desa
    Route::get('/profil/visimisi', 'BerandaController@visimisi')->name('frontend.profil.visimisi');
    Route::get('/profil/sejarah', 'BerandaController@sejarah')->name('frontend.profil.sejarah');
    Route::get('/profil/gambaran-umum', 'BerandaController@gambaranumum')->name('frontend.profil.gambaranumum');
    Route::get('/profil/geografis', 'BerandaController@geografis')->name('frontend.profil.geografis');
	//Potensi Desa
    Route::get('/sda', 'BerandaController@sda')->name('frontend.potensi.sda');
    Route::get('/sdm', 'BerandaController@sdm')->name('frontend.potensi.sdm');
    Route::get('/sarpras', 'BerandaController@sarpras')->name('frontend.potensi.sarpras');
    Route::get('/kelembagaan', 'BerandaController@kelembagaan')->name('frontend.potensi.kelembagaan');
    Route::get('/bumdes/profil', 'BerandaController@bumdesProfil')->name('frontend.bumdes.profil');
    Route::get('/bumdes/profil/{slug}', 'BerandaController@bumdesProfilDetail')->name('frontend.bumdes.profil.detail');
    Route::get('/bumdes/produk', 'BerandaController@bumdesProduk')->name('frontend.bumdes.produk');
    Route::get('/bumdes/produk/{slug}', 'BerandaController@bumdesProdukDetail')->name('frontend.bumdes.produk.detail');
	//Potensi Desa
    Route::get('/potensi/kategori/{PotensiKategori}', 'BerandaController@potensiDesa')->name('frontend.potensi.list');
    Route::get('/potensi/{slug}', 'BerandaController@potensiDesaDetail')->name('frontend.potensi.detail');
    //Program Desa
    Route::get('/program/kategori/{ProgramKategori}', 'BerandaController@programDesa')->name('frontend.program.list');
    Route::get('/program/{slug}', 'BerandaController@programDesaDetail')->name('frontend.program.detail');    
    //Program Desa
    Route::get('/penyelenggaraan-pemerintah', 'BerandaController@penyelenggaraan')->name('frontend.program.penyelenggaraan');
    Route::get('/pelayanan-administrasi', 'BerandaController@pelayanan')->name('frontend.program.pelayanan');
    Route::get('/pembangunan', 'BerandaController@pembangunan')->name('frontend.program.pembangunan');
    Route::get('/pemberdayaan', 'BerandaController@pemberdayaan')->name('frontend.program.pemberdayaan');
    Route::get('/pembinaan', 'BerandaController@pembinaan')->name('frontend.program.pembinaan');
    //Pemerintah Desa
    Route::get('/kades', 'BerandaController@kades')->name('frontend.pemdes.kades');
    Route::get('/perangkat', 'BerandaController@perangkat')->name('frontend.pemdes.perangkat');
    Route::get('/kantor', 'BerandaController@kantor')->name('frontend.pemdes.kantor');
    Route::get('/struktur-organisasi', 'BerandaController@struktur')->name('frontend.pemdes.struktur');
    //Form Pengajuan
    Route::middleware(['auth:masyarakat'])->group(function(){
    //Progress
    Route::get('/ubah-password', 'ProfilController@showChangePassword')->name('frontend.changePassword');
    Route::post('/ubah-password', 'ProfilController@updatePassword')->name('frontend.password.update');
    Route::get('/listprogress', 'BerandaController@listprogress')->name('frontend.listprogress');
	Route::get('/lihatprogress/{id}/{jenis_suket}', 'BerandaController@lihatProgress')->name('frontend.lihatprogress');
    Route::get('/progress', 'BerandaController@progress')->name('frontend.progress');
	Route::post('/progress', 'BerandaController@cekProgress')->name('frontend.progress.proses');
	Route::get('/suket/skl', 'SklController@index')->name('frontend.skl');
	Route::post('/suket/skl', 'SklController@createProccess')->name('frontend.skl.submit');
	Route::get('/suket/skl/{id}/edit', 'SklController@edit')->name('frontend.suket.skl.edit');
	Route::post('/suket/skl/{id}/edit', 'SklController@editProccess')->name('frontend.suket.skl.editProccess');
	Route::get('/suket/skm', 'SkmController@index')->name('frontend.suket.kematian');
	Route::post('/suket/skm', 'SkmController@createProccess')->name('frontend.suket.kematian.submit');
	Route::get('/suket/skm/{id}/edit', 'SkmController@edit')->name('frontend.suket.kematian.edit');
	Route::post('/suket/skm/{id}/edit', 'SkmController@editProccess')->name('frontend.suket.kematian.editProccess');
	Route::get('/suket/sku', 'SkuController@index')->name('frontend.suket.usaha');
	Route::get('/suket/sku/{id}/edit', 'SkuController@edit')->name('frontend.suket.usaha.edit');
	Route::post('/suket/sku/{id}/edit', 'SkuController@editProccess')->name('frontend.suket.usaha.editProccess');
	Route::post('/suket/sku', 'SkuController@createProccess')->name('frontend.suket.usaha.submit');
	Route::get('/suket/skbn', 'SkbnController@index')->name('frontend.suket.bedanama');
	Route::post('/suket/skbn', 'SkbnController@createProccess')->name('frontend.suket.bedanama.submit');
	Route::get('/suket/skbn/{id}/edit', 'SkbnController@edit')->name('frontend.suket.bedanama.edit');
	Route::post('/suket/skbn/{id}/edit', 'SkbnController@editProccess')->name('frontend.suket.bedanama.editProccess');
	Route::get('/suket/sktm', 'SktmController@index')->name('frontend.suket.tidakMampu');
	Route::post('/suket/sktm', 'SktmController@createProccess')->name('frontend.suket.tidakMampu.submit');
	Route::get('/suket/sktm/{id}/edit', 'SktmController@edit')->name('frontend.suket.tidakMampu.edit');
	Route::post('/suket/sktm/{id}/edit', 'SktmController@editProccess')->name('frontend.suket.tidakMampu.editProccess');
	Route::get('/suket/skp', 'SkpController@index')->name('frontend.suket.penghasilan');
	Route::post('/suket/skp', 'SkpController@createProccess')->name('frontend.suket.penghasilan.submit');
	Route::get('/suket/skp/{id}/edit', 'SkpController@edit')->name('frontend.suket.penghasilan.edit');
	Route::post('/suket/skp/{id}/edit', 'SkpController@editProccess')->name('frontend.suket.penghasilan.editProccess');
	Route::get('/suket/sksp', 'SkspController@index')->name('frontend.suket.status');
	Route::post('/suket/sksp', 'SkspController@createProccess')->name('frontend.suket.status.submit');
	Route::get('/suket/sksp/{id}/edit', 'SkspController@edit')->name('frontend.suket.status.edit');
	Route::post('/suket/sksp/{id}/edit', 'SkspController@editProccess')->name('frontend.suket.status.editProccess');
	Route::get('/suket/skrt', 'SkrtController@index')->name('frontend.suket.tanah');
	Route::post('/suket/skrt', 'SkrtController@createProccess')->name('frontend.suket.tanah.submit');
	Route::get('/suket/skrt/{id}/edit', 'SkrtController@edit')->name('frontend.suket.tanah.edit');
	Route::post('/suket/skrt/{id}/edit', 'SkrtController@editProccess')->name('frontend.suket.tanah.editProccess');
	Route::get('/suket/skaw', 'SkawController@index')->name('frontend.suket.ahliwaris');
	Route::post('/suket/skaw', 'SkawController@createProccess')->name('frontend.suket.ahliwaris.submit');
	Route::get('/suket/skaw/{id}/edit', 'SkawController@edit')->name('frontend.suket.ahliwaris.edit');
	Route::post('/suket/skaw/{id}/edit', 'SkawController@editProccess')->name('frontend.suket.ahliwaris.editProccess');
	Route::get('/suket/sksj', 'SksjController@index')->name('frontend.suket.sapujagad');
	Route::post('/suket/sksj', 'SksjController@createProccess')->name('frontend.suket.sapujagad.submit');
	Route::get('/suket/sksj/{id}/edit', 'SksjController@edit')->name('frontend.suket.sapujagad.edit');
	Route::post('/suket/sksj/{id}/edit', 'SksjController@editProccess')->name('frontend.suket.sapujagad.editProccess');
	Route::get('/suket/{suket_id}/{jenis_suket}/print', 'BerandaController@print')->name('frontend.suket.print');
});  
    //web view
    Route::get('/suket/print','BerandaController@printWebView')->name('frontend.webview.suket.print');
    Route::get('/suket/wv-skl','SklController@indexWebView')->name('frontend.webview.skl');
    Route::post('/suket/wv-skl','SklController@createProccess')->name('frontend.webview.skl.createProccess');
    Route::get('/suket/wv-sktm','SktmController@indexWebView')->name('frontend.webview.sktm');
    Route::post('/suket/wv-sktm','SktmController@createProccess')->name('frontend.webview.sktm.createProccess');
    Route::get('/suket/wv-lainnya','SksjController@indexWebView')->name('frontend.webview.sksj');
    Route::post('/suket/wv-lainnya','SksjController@createProccess')->name('frontend.webview.sksj.createProccess');
    Route::get('/suket/wv-sku','SkuController@indexWebView')->name('frontend.webview.sku');
    Route::post('/suket/wv-sku','SkuController@createProccess')->name('frontend.webview.sku.createProccess');
    Route::get('/suket/wv-skp','SkpController@indexWebView')->name('frontend.webview.skp');
    Route::post('/suket/wv-skp','SkpController@createProccess')->name('frontend.webview.skp.createProccess');
    Route::get('/suket/wv-sksp','SkspController@indexWebView')->name('frontend.webview.sksp');
    Route::post('/suket/wv-sksp','SkspController@createProccess')->name('frontend.webview.sksp.createProccess');
    Route::get('/suket/wv-skbn','SkbnController@indexWebView')->name('frontend.webview.skbn');
    Route::post('/suket/wv-skbn','SkbnController@createProccess')->name('frontend.webview.skbn.createProccess');
    Route::get('/suket/wv-skm','SkmController@indexWebView')->name('frontend.webview.skm');
    Route::post('/suket/wv-skm','SkmController@createProccess')->name('frontend.webview.skm.createProccess');
    Route::get('/suket/wv-skaw','SkawController@indexWebView')->name('frontend.webview.skaw');
    Route::post('/suket/wv-skaw','SkawController@createProccess')->name('frontend.webview.skaw.createProccess');
    Route::get('/suket/wv-skrt','SkrtController@indexWebView')->name('frontend.webview.skrt');
	Route::post('/suket/wv-skrt','SkrtController@createProccess')->name('frontend.webview.skrt.createProccess');
	
    Route::get('/suket/wv-skl/edit','SklController@editWebView')->name('frontend.webview.skl.edit');
    Route::get('/suket/wv-skm/edit','SkmController@editWebView')->name('frontend.webview.skm.edit');
    Route::get('/suket/wv-skp/edit','SkpController@editWebView')->name('frontend.webview.skp.edit');
    Route::get('/suket/wv-sksp/edit','SkspController@editWebView')->name('frontend.webview.sksp.edit');
    Route::get('/suket/wv-sktm/edit','SktmController@editWebView')->name('frontend.webview.sktm.edit');
    Route::get('/suket/wv-sksj/edit','SksjController@editWebView')->name('frontend.webview.sksj.edit');
    Route::get('/suket/wv-skaw/edit','SkawController@editWebView')->name('frontend.webview.skaw.edit');
    Route::get('/suket/wv-skrt/edit','skrtController@editWebView')->name('frontend.webview.skrt.edit');
    Route::get('/suket/wv-sku/edit','SkuController@editWebView')->name('frontend.webview.sku.edit');
	Route::get('/suket/wv-skbn/edit','SkbnController@editWebView')->name('frontend.webview.skbn.edit');
	
    Route::post('/suket/wv-skl/edit','SklController@editProccess')->name('frontend.webview.skl.editProccess');
    Route::post('/suket/wv-skm/edit','SkmController@editProccess')->name('frontend.webview.skm.editProccess');
    Route::post('/suket/wv-skp/edit','SkpController@editProccess')->name('frontend.webview.skp.editProccess');
    Route::post('/suket/wv-sksp/edit','SkspController@editProccess')->name('frontend.webview.sksp.editProccess');
    Route::post('/suket/wv-sktm/edit','SktmController@editProccess')->name('frontend.webview.sktm.editProccess');
    Route::post('/suket/wv-sksj/edit','SksjController@editProccess')->name('frontend.webview.sksj.editProccess');
    Route::post('/suket/wv-skaw/edit','SkawController@editProccess')->name('frontend.webview.skaw.editProccess');
    Route::post('/suket/wv-skrt/edit','skrtController@editProccess')->name('frontend.webview.skrt.editProccess');
    Route::post('/suket/wv-sku/edit','SkuController@editProccess')->name('frontend.webview.sku.editProccess');
	Route::post('/suket/wv-skbn/edit','SkbnController@editProccess')->name('frontend.webview.skbn.editProccess');
	
	Route::get('/suket/wv-skl/detail','SklController@detailWebView')->name('frontend.webview.skl.detail');
    Route::get('/suket/wv-skm/detail','SkmController@detailWebView')->name('frontend.webview.skm.detail');
    Route::get('/suket/wv-skp/detail','SkpController@detailWebView')->name('frontend.webview.skp.detail');
    Route::get('/suket/wv-sksp/detail','SkspController@detailWebView')->name('frontend.webview.sksp.detail');
    Route::get('/suket/wv-sktm/detail','SktmController@detailWebView')->name('frontend.webview.sktm.detail');
    Route::get('/suket/wv-sksj/detail','SksjController@detailWebView')->name('frontend.webview.sksj.detail');
    Route::get('/suket/wv-skaw/detail','SkawController@detailWebView')->name('frontend.webview.skaw.detail');
    Route::get('/suket/wv-skrt/detail','skrtController@detailWebView')->name('frontend.webview.skrt.detail');
    Route::get('/suket/wv-sku/detail','SkuController@detailWebView')->name('frontend.webview.sku.detail');
    Route::get('/suket/wv-skbn/detail','SkbnController@detailWebView')->name('frontend.webview.skbn.detail');

    //Unggah dokumen kk dan ktp web
    Route::get('/unggah-dokumen','UnggahDokumenController@index')->name('frontend.unggah');
    Route::get('/wv-unggah-dokumen','UnggahDokumenController@indexWebView')->name('frontend.webview.unggah');
    Route::post('/unggah-dokumen','UnggahDokumenController@upload')->name('frontend.unggah.proses');
});


Route::middleware('domain')->namespace('Backend')->prefix('backoffice')->group(function () {
    Route::get('/refresh-captcha', function(){
        return Captcha::img();
    })->name('backend.captcha');

    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard')->middleware(['auth:admin']);
    Route::get('/bukutamu', 'DashboardController@bukuTamu')->name('backend.bukutamu')->middleware(['auth:admin']);
    Route::get('/bukutamu/detail/{id}', 'DashboardController@bukuTamuDetail')->name('backend.bukutamu.detail')->middleware(['auth:admin']);
    Route::get('/profil-desa', 'DashboardController@profilDesa')->name('backend.profilDesa')->middleware(['auth:admin']);
    Route::post('/profil-desa', 'DashboardController@updateProfilDesa')->name('backend.profilDesa.update')->middleware(['auth:admin']);
    Route::get('/profil', 'ProfilController@index')->name('backend.profil')->middleware(['auth:admin']);
    Route::post('/profil', 'ProfilController@updateProfile')->name('backend.profil.update')->middleware(['auth:admin']);
    Route::get('/akun', 'ProfilController@showFormChangePassword')->name('backend.account')->middleware(['auth:admin']);
    Route::post('/akun', 'ProfilController@updatePassword')->name('backend.account.update')->middleware(['auth:admin']);
    Route::get('/pengaturan-website', 'PengaturanController@index')->name('backend.setting')->middleware(['auth:admin']);
    Route::post('/pengaturan-website', 'PengaturanController@update')->name('backend.setting.update')->middleware(['auth:admin']);
    Route::post('/logout/all', 'DashboardController@logoutAllDevices')->name('backend.logout.device.all')->middleware(['auth:admin']);
    Route::post('/logout/device', 'DashboardController@logoutByDevice')->name('backend.logout.device')->middleware(['auth:admin']);

    //Maintenande Mode
    Route::get('/maintenance/down', 'MaintenanceController@down')->name('backend.maintenance.on')->middleware(['auth:admin']);
	Route::get('/maintenance/live', 'MaintenanceController@live')->name('backend.maintenance.off')->middleware(['auth:admin']);
	
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@index')->name('backend.auth.login');
        Route::post('/logout', 'LoginController@logout')->name('backend.auth.logout');
        Route::post('/login', 'LoginController@login')->name('backend.auth.prosesLogin');
        Route::get('/password/email', 'ResetPasswordController@index')->name('backend.auth.password');
        // Route::post('/password/email', 'ResetPasswordController@sendEmail')->name('backend.auth.password.send');
        // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('backend.auth.password.show');
        // Route::post('/password/reset', 'ResetPasswordController@reset')->name('backend.auth.password.reset');
    });

    Route::post('/ajax/provinsi', 'Ajax\WilayahController@provinsi')->name('backend.ajax.provinsi');
    Route::post('/ajax/kota', 'Ajax\WilayahController@kota')->name('backend.ajax.kota');
	Route::post('/ajax/kecamatan', 'Ajax\WilayahController@kecamatan')->name('backend.ajax.kecamatan');
	
	Route::middleware(['auth:admin'])->namespace('Pengaturan')->prefix('pengaturan')->group(function () {		
        Route::get('/passphrase', 'PassphraseController@index')->name('backend.pengaturan.passphrase');
        Route::get('/passphrase/tambah', 'PassphraseController@create')->name('backend.pengaturan.passphrase.create');
        Route::post('/passphrase/tambah', 'PassphraseController@createProccess')->name('backend.pengaturan.passphrase.createProccess');
        Route::get('/passphrase/{id}/edit', 'PassphraseController@edit')->name('backend.pengaturan.passphrase.edit');
        Route::post('/passphrase/{id}/edit', 'PassphraseController@editProccess')->name('backend.pengaturan.passphrase.editProccess');
        Route::post('/passphrase/hapus', 'PassphraseController@delete')->name('backend.pengaturan.passphrase.delete');
        Route::get('/passphrase/{id}/detail', 'PassphraseController@detail')->name('backend.pengaturan.passphrase.detail');
        Route::post('/passphrase/aktif', 'PassphraseController@active')->name('backend.pengaturan.passphrase.active');
        Route::post('/passphrase/non-aktif', 'PassphraseController@inactive')->name('backend.pengaturan.passphrase.inactive');
    });

    Route::middleware(['auth:admin'])->namespace('Manajemen')->prefix('manajemen')->group(function () {
        Route::get('/modul', 'ModulController@index')->name('backend.manajemen.modul');
        Route::get('/modul/tambah', 'ModulController@create')->name('backend.manajemen.modul.create');
        Route::post('/modul/tambah', 'ModulController@createProccess')->name('backend.manajemen.modul.createProccess');
        Route::get('/modul/{id}/edit', 'ModulController@edit')->name('backend.manajemen.modul.edit');
        Route::post('/modul/{id}/edit', 'ModulController@editProccess')->name('backend.manajemen.modul.editProccess');
        Route::post('/modul/hapus', 'ModulController@delete')->name('backend.manajemen.modul.delete');
        Route::get('/modul/{id}/detail', 'ModulController@detail')->name('backend.manajemen.modul.detail');
        Route::post('/modul/aktif', 'ModulController@active')->name('backend.manajemen.modul.active');
		Route::post('/modul/non-aktif', 'ModulController@inactive')->name('backend.manajemen.modul.inactive');
		
		Route::get('/menu', 'MenuController@index')->name('backend.manajemen.menu');
        Route::get('/menu/tambah', 'MenuController@create')->name('backend.manajemen.menu.create');
        Route::post('/menu/tambah', 'MenuController@createProccess')->name('backend.manajemen.menu.createProccess');
        Route::get('/menu/{id}/edit', 'MenuController@edit')->name('backend.manajemen.menu.edit');
        Route::post('/menu/{id}/edit', 'MenuController@editProccess')->name('backend.manajemen.menu.editProccess');
        Route::post('/menu/hapus', 'MenuController@delete')->name('backend.manajemen.menu.delete');
        Route::get('/menu/{id}/detail', 'MenuController@detail')->name('backend.manajemen.menu.detail');
        Route::post('/menu/aktif', 'MenuController@active')->name('backend.manajemen.menu.active');
		Route::post('/menu/non-aktif', 'MenuController@inactive')->name('backend.manajemen.menu.inactive');
		
        Route::get('/role', 'RoleController@index')->name('backend.manajemen.role');
        Route::get('/role/tambah', 'RoleController@create')->name('backend.manajemen.role.create');
        Route::post('/role/tambah', 'RoleController@createProccess')->name('backend.manajemen.role.createProccess');
        Route::get('/role/{id}/edit', 'RoleController@edit')->name('backend.manajemen.role.edit');
        Route::post('/role/{id}/edit', 'RoleController@editProccess')->name('backend.manajemen.role.editProccess');
        Route::post('/role/hapus', 'RoleController@delete')->name('backend.manajemen.role.delete');
        Route::get('/role/{id}/detail', 'RoleController@detail')->name('backend.manajemen.role.detail');
        Route::post('/role/aktif', 'RoleController@active')->name('backend.manajemen.role.active');
		Route::post('/role/non-aktif', 'RoleController@inactive')->name('backend.manajemen.role.inactive');
		
        Route::get('/admin', 'AdminController@index')->name('backend.manajemen.admin');
        Route::get('/admin/tambah', 'AdminController@create')->name('backend.manajemen.admin.create');
        Route::post('/admin/tambah', 'AdminController@createProccess')->name('backend.manajemen.admin.createProccess');
        Route::get('/admin/{id}/edit', 'AdminController@edit')->name('backend.manajemen.admin.edit');
        Route::post('/admin/{id}/edit', 'AdminController@editProccess')->name('backend.manajemen.admin.editProccess');
        Route::post('/admin/hapus', 'AdminController@delete')->name('backend.manajemen.admin.delete');
        Route::get('/admin/{id}/detail', 'AdminController@detail')->name('backend.manajemen.admin.detail');
        Route::post('/admin/aktif', 'AdminController@active')->name('backend.manajemen.admin.active');
        Route::post('/admin/non-aktif', 'AdminController@inactive')->name('backend.manajemen.admin.inactive');

		Route::get('/user', 'UserController@index')->name('backend.manajemen.user');
        Route::get('/user/tambah', 'UserController@create')->name('backend.manajemen.user.create');
        Route::post('/user/tambah', 'UserController@createProccess')->name('backend.manajemen.user.createProccess');
        Route::get('/user/{id}/edit', 'UserController@edit')->name('backend.manajemen.user.edit');
        Route::post('/user/{id}/edit', 'UserController@editProccess')->name('backend.manajemen.user.editProccess');
        Route::post('/user/hapus', 'UserController@delete')->name('backend.manajemen.user.delete');
        Route::get('/user/{id}/detail', 'UserController@detail')->name('backend.manajemen.user.detail');
        Route::post('/user/aktif', 'UserController@active')->name('backend.manajemen.user.active');
        Route::post('/user/non-aktif', 'UserController@inactive')->name('backend.manajemen.user.inactive');
    });

    Route::middleware(['auth:admin'])->namespace('Informasi')->prefix('informasi')->group(function () {
        Route::get('/berita', 'BeritaController@index')->name('backend.informasi.berita');
        Route::get('/berita/tambah', 'BeritaController@create')->name('backend.informasi.berita.create');
        Route::post('/berita/tambah', 'BeritaController@createProccess')->name('backend.informasi.berita.createProccess');
        Route::get('/berita/{id}/edit', 'BeritaController@edit')->name('backend.informasi.berita.edit');
        Route::post('/berita/{id}/edit', 'BeritaController@editProccess')->name('backend.informasi.berita.editProccess');
        Route::post('/berita/hapus', 'BeritaController@delete')->name('backend.informasi.berita.delete');
        Route::get('/berita/{id}/detail', 'BeritaController@detail')->name('backend.informasi.berita.detail');
        Route::post('/berita/aktif', 'BeritaController@active')->name('backend.informasi.berita.active');
        Route::post('/berita/non-aktif', 'BeritaController@inactive')->name('backend.informasi.berita.inactive');

        Route::get('/pengumuman', 'PengumumanController@index')->name('backend.informasi.pengumuman');
        Route::get('/pengumuman/tambah', 'PengumumanController@create')->name('backend.informasi.pengumuman.create');
        Route::post('/pengumuman/tambah', 'PengumumanController@createProccess')->name('backend.informasi.pengumuman.createProccess');
        Route::get('/pengumuman/{id}/edit', 'PengumumanController@edit')->name('backend.informasi.pengumuman.edit');
        Route::post('/pengumuman/{id}/edit', 'PengumumanController@editProccess')->name('backend.informasi.pengumuman.editProccess');
        Route::post('/pengumuman/hapus', 'PengumumanController@delete')->name('backend.informasi.pengumuman.delete');
        Route::get('/pengumuman/{id}/detail', 'PengumumanController@detail')->name('backend.informasi.pengumuman.detail');
        Route::post('/pengumuman/aktif', 'PengumumanController@active')->name('backend.informasi.pengumuman.active');
		Route::post('/pengumuman/non-aktif', 'PengumumanController@inactive')->name('backend.informasi.pengumuman.inactive');
		
        Route::get('/agenda', 'AgendaController@index')->name('backend.informasi.agenda');
        Route::get('/agenda/tambah', 'AgendaController@create')->name('backend.informasi.agenda.create');
        Route::post('/agenda/tambah', 'AgendaController@createProccess')->name('backend.informasi.agenda.createProccess');
        Route::get('/agenda/{id}/edit', 'AgendaController@edit')->name('backend.informasi.agenda.edit');
        Route::post('/agenda/{id}/edit', 'AgendaController@editProccess')->name('backend.informasi.agenda.editProccess');
        Route::post('/agenda/hapus', 'AgendaController@delete')->name('backend.informasi.agenda.delete');
        Route::get('/agenda/{id}/detail', 'AgendaController@detail')->name('backend.informasi.agenda.detail');
        Route::post('/agenda/aktif', 'AgendaController@active')->name('backend.informasi.agenda.active');
        Route::post('/agenda/non-aktif', 'AgendaController@inactive')->name('backend.informasi.agenda.inactive');

        Route::get('/info-grafis', 'InfoGrafisController@index')->name('backend.informasi.infoGrafis');
        Route::get('/info-grafis/tambah', 'InfoGrafisController@create')->name('backend.informasi.infoGrafis.create');
        Route::post('/info-grafis/tambah', 'InfoGrafisController@createProccess')->name('backend.informasi.infoGrafis.createProccess');
        Route::get('/info-grafis/{id}/edit', 'InfoGrafisController@edit')->name('backend.informasi.infoGrafis.edit');
        Route::post('/info-grafis/{id}/edit', 'InfoGrafisController@editProccess')->name('backend.informasi.infoGrafis.editProccess');
        Route::post('/info-grafis/hapus', 'InfoGrafisController@delete')->name('backend.informasi.infoGrafis.delete');
        Route::get('/info-grafis/{id}/detail', 'InfoGrafisController@detail')->name('backend.informasi.infoGrafis.detail');
        Route::post('/info-grafis/aktif', 'InfoGrafisController@active')->name('backend.informasi.infoGrafis.active');
        Route::post('/info-grafis/non-aktif', 'InfoGrafisController@inactive')->name('backend.informasi.infoGrafis.inactive');

        Route::get('/komentar', 'KomentarController@index')->name('backend.informasi.komentar');
        Route::get('/komentar/tambah', 'KomentarController@create')->name('backend.informasi.komentar.create');
        Route::post('/komentar/tambah', 'KomentarController@createProccess')->name('backend.informasi.komentar.createProccess');
        Route::get('/komentar/{id}/edit', 'KomentarController@edit')->name('backend.informasi.komentar.edit');
        Route::post('/komentar/{id}/edit', 'KomentarController@editProccess')->name('backend.informasi.komentar.editProccess');
        Route::get('/komentar/{id}/reply', 'KomentarController@reply')->name('backend.informasi.komentar.reply');
        Route::post('/komentar/{id}/reply', 'KomentarController@replyProcess')->name('backend.informasi.komentar.replyProccess');
        Route::post('/komentar/hapus', 'KomentarController@delete')->name('backend.informasi.komentar.delete');
        Route::get('/komentar/{id}/detail', 'KomentarController@detail')->name('backend.informasi.komentar.detail');
        Route::post('/komentar/aktif', 'KomentarController@active')->name('backend.informasi.komentar.active');
        Route::post('/komentar/non-aktif', 'KomentarController@inactive')->name('backend.informasi.komentar.inactive');
    });

    Route::middleware(['auth:admin'])->namespace('Galeri')->prefix('galeri')->group(function () {
        Route::get('/foto', 'FotoController@index')->name('backend.galeri.foto');
        Route::get('/foto/tambah', 'FotoController@create')->name('backend.galeri.foto.create');
        Route::post('/foto/tambah', 'FotoController@createProccess')->name('backend.galeri.foto.createProccess');
        Route::get('/foto/{id}/edit', 'FotoController@edit')->name('backend.galeri.foto.edit');
        Route::post('/foto/{id}/edit', 'FotoController@editProccess')->name('backend.galeri.foto.editProccess');
        Route::post('/foto/hapus', 'FotoController@delete')->name('backend.galeri.foto.delete');
        Route::get('/foto/{id}/detail', 'FotoController@detail')->name('backend.galeri.foto.detail');
        Route::post('/foto/aktif', 'FotoController@active')->name('backend.galeri.foto.active');
        Route::post('/foto/non-aktif', 'FotoController@inactive')->name('backend.galeri.foto.inactive');

        Route::get('/video', 'VideoController@index')->name('backend.galeri.video');
        Route::get('/video/tambah', 'VideoController@create')->name('backend.galeri.video.create');
        Route::post('/video/tambah', 'VideoController@createProccess')->name('backend.galeri.video.createProccess');
        Route::get('/video/{id}/edit', 'VideoController@edit')->name('backend.galeri.video.edit');
        Route::post('/video/{id}/edit', 'VideoController@editProccess')->name('backend.galeri.video.editProccess');
        Route::post('/video/hapus', 'VideoController@delete')->name('backend.galeri.video.delete');
        Route::get('/video/{id}/detail', 'VideoController@detail')->name('backend.galeri.video.detail');
        Route::post('/video/aktif', 'VideoController@active')->name('backend.galeri.video.active');
        Route::post('/video/non-aktif', 'VideoController@inactive')->name('backend.galeri.video.inactive');
	});
	
    Route::middleware(['auth:admin'])->namespace('Dokumen')->prefix('dokumen')->group(function () {
        Route::get('/download', 'DownloadController@index')->name('backend.dokumen.download');
        Route::get('/download/tambah', 'DownloadController@create')->name('backend.dokumen.download.create');
        Route::post('/download/tambah', 'DownloadController@createProccess')->name('backend.dokumen.download.createProccess');
        Route::get('/download/{id}/edit', 'DownloadController@edit')->name('backend.dokumen.download.edit');
        Route::post('/download/{id}/edit', 'DownloadController@editProccess')->name('backend.dokumen.download.editProccess');
        Route::post('/download/hapus', 'DownloadController@delete')->name('backend.dokumen.download.delete');
        Route::get('/download/{id}/detail', 'DownloadController@detail')->name('backend.dokumen.download.detail');
        Route::post('/download/aktif', 'DownloadController@active')->name('backend.dokumen.download.active');
        Route::post('/download/non-aktif', 'DownloadController@inactive')->name('backend.dokumen.download.inactive');

        Route::get('/sktm', 'SktmController@index')->name('backend.dokumen.sktm');
        Route::get('/sktm/tambah', 'SktmController@create')->name('backend.dokumen.sktm.create');
        Route::post('/sktm/tambah', 'SktmController@createProccess')->name('backend.dokumen.sktm.createProccess');
        Route::get('/sktm/{id}/edit', 'SktmController@edit')->name('backend.dokumen.sktm.edit');
        Route::post('/sktm/{id}/edit', 'SktmController@editProccess')->name('backend.dokumen.sktm.editProccess');
        Route::get('/sktm/{id}/detail', 'SktmController@detail')->name('backend.dokumen.sktm.detail');
        Route::post('/sktm/print', 'SktmController@print')->name('backend.dokumen.sktm.print');
        Route::post('/sktm/kades', 'SktmController@verifikasiKades')->name('backend.dokumen.sktm.kades');
        Route::post('/sktm/sekdes', 'SktmController@verifikasiSekdes')->name('backend.dokumen.sktm.sekdes');
        Route::post('/sktm/kasi', 'SktmController@verifikasiKasi')->name('backend.dokumen.sktm.kasi');
        Route::post('/sktm/hapus', 'SktmController@delete')->name('backend.dokumen.sktm.delete');
        Route::post('/sktm/tolak', 'SktmController@rejected')->name('backend.dokumen.sktm.reject');
        Route::post('/sktm/terima', 'SktmController@accepted')->name('backend.dokumen.sktm.accept');

        Route::get('/skbn', 'SkbnController@index')->name('backend.dokumen.skbn');
        Route::get('/skbn/tambah', 'SkbnController@create')->name('backend.dokumen.skbn.create');
        Route::post('/skbn/tambah', 'SkbnController@createProccess')->name('backend.dokumen.skbn.createProccess');
        Route::get('/skbn/{id}/edit', 'SkbnController@edit')->name('backend.dokumen.skbn.edit');
        Route::post('/skbn/{id}/edit', 'SkbnController@editProccess')->name('backend.dokumen.skbn.editProccess');
        Route::get('/skbn/{id}/detail', 'SkbnController@detail')->name('backend.dokumen.skbn.detail');
        Route::post('/skbn/print', 'SkbnController@print')->name('backend.dokumen.skbn.print');
        Route::post('/skbn/kades', 'SkbnController@verifikasiKades')->name('backend.dokumen.skbn.kades');
        Route::post('/skbn/sekdes', 'SkbnController@verifikasiSekdes')->name('backend.dokumen.skbn.sekdes');
        Route::post('/skbn/kasi', 'SkbnController@verifikasiKasi')->name('backend.dokumen.skbn.kasi');
        Route::post('/skbn/hapus', 'SkbnController@delete')->name('backend.dokumen.skbn.delete');
        Route::post('/skbn/tolak', 'SkbnController@rejected')->name('backend.dokumen.skbn.reject');
        Route::post('/skbn/terima', 'SkbnController@accepted')->name('backend.dokumen.skbn.accept');

        Route::get('/skn', 'SknController@index')->name('backend.dokumen.skn');
        Route::get('/skn/tambah', 'SknController@create')->name('backend.dokumen.skn.create');
        Route::post('/skn/tambah', 'SknController@createProccess')->name('backend.dokumen.skn.createProccess');
        Route::get('/skn/{id}/edit', 'SknController@edit')->name('backend.dokumen.skn.edit');
        Route::post('/skn/{id}/edit', 'SknController@editProccess')->name('backend.dokumen.skn.editProccess');
        Route::get('/skn/{id}/detail', 'SknController@detail')->name('backend.dokumen.skn.detail');
        Route::post('/skn/print', 'SknController@print')->name('backend.dokumen.skn.print');
        Route::post('/skn/kades', 'SknController@verifikasiKades')->name('backend.dokumen.skn.kades');
        Route::post('/skn/sekdes', 'SknController@verifikasiSekdes')->name('backend.dokumen.skn.sekdes');
        Route::post('/skn/kasi', 'SknController@verifikasiKasi')->name('backend.dokumen.skn.kasi');
        Route::post('/skn/hapus', 'SknController@delete')->name('backend.dokumen.skn.delete');
        Route::post('/skn/tolak', 'SknController@rejected')->name('backend.dokumen.skn.reject');
        Route::post('/skn/terima', 'SknController@accepted')->name('backend.dokumen.skn.accept');

        Route::get('/skp', 'SkpController@index')->name('backend.dokumen.skp');
        Route::get('/skp/tambah', 'SkpController@create')->name('backend.dokumen.skp.create');
        Route::post('/skp/tambah', 'SkpController@createProccess')->name('backend.dokumen.skp.createProccess');
        Route::get('/skp/{id}/edit', 'SkpController@edit')->name('backend.dokumen.skp.edit');
        Route::post('/skp/{id}/edit', 'SkpController@editProccess')->name('backend.dokumen.skp.editProccess');
        Route::get('/skp/{id}/detail', 'SkpController@detail')->name('backend.dokumen.skp.detail');
        Route::post('/skp/print', 'SkpController@print')->name('backend.dokumen.skp.print');
        Route::post('/skp/kades', 'SkpController@verifikasiKades')->name('backend.dokumen.skp.kades');
        Route::post('/skp/sekdes', 'SkpController@verifikasiSekdes')->name('backend.dokumen.skp.sekdes');
        Route::post('/skp/kasi', 'SkpController@verifikasiKasi')->name('backend.dokumen.skp.kasi');
        Route::post('/skp/hapus', 'SkpController@delete')->name('backend.dokumen.skp.delete');
        Route::post('/skp/tolak', 'SkpController@rejected')->name('backend.dokumen.skp.reject');
        Route::post('/skp/terima', 'SkpController@accepted')->name('backend.dokumen.skp.accept');

        Route::get('/sku', 'SkuController@index')->name('backend.dokumen.sku');
        Route::get('/sku/tambah', 'SkuController@create')->name('backend.dokumen.sku.create');
        Route::post('/sku/tambah', 'SkuController@createProccess')->name('backend.dokumen.sku.createProccess');
        Route::get('/sku/{id}/edit', 'SkuController@edit')->name('backend.dokumen.sku.edit');
        Route::post('/sku/{id}/edit', 'SkuController@editProccess')->name('backend.dokumen.sku.editProccess');
        Route::get('/sku/{id}/detail', 'SkuController@detail')->name('backend.dokumen.sku.detail');
        Route::post('/sku/print', 'SkuController@print')->name('backend.dokumen.sku.print');
        Route::post('/sku/kades', 'SkuController@verifikasiKades')->name('backend.dokumen.sku.kades');
        Route::post('/sku/sekdes', 'SkuController@verifikasiSekdes')->name('backend.dokumen.sku.sekdes');
        Route::post('/sku/kasi', 'SkuController@verifikasiKasi')->name('backend.dokumen.sku.kasi');
        Route::post('/sku/hapus', 'SkuController@delete')->name('backend.dokumen.sku.delete');
        Route::post('/sku/tolak', 'SkuController@rejected')->name('backend.dokumen.sku.reject');
        Route::post('/sku/terima', 'SkuController@accepted')->name('backend.dokumen.sku.accept');

        Route::get('/skk', 'SkkController@index')->name('backend.dokumen.skk');
        Route::get('/skk/tambah', 'SkkController@create')->name('backend.dokumen.skk.create');
        Route::post('/skk/tambah', 'SkkController@createProccess')->name('backend.dokumen.skk.createProccess');
        Route::get('/skk/{id}/edit', 'SkkController@edit')->name('backend.dokumen.skk.edit');
        Route::post('/skk/{id}/edit', 'SkkController@editProccess')->name('backend.dokumen.skk.editProccess');
        Route::get('/skk/{id}/detail', 'SkkController@detail')->name('backend.dokumen.skk.detail');
        Route::post('/skk/print', 'SkkController@print')->name('backend.dokumen.skk.print');
        Route::post('/skk/kades', 'SkkController@verifikasiKades')->name('backend.dokumen.skk.kades');
        Route::post('/skk/sekdes', 'SkkController@verifikasiSekdes')->name('backend.dokumen.skk.sekdes');
        Route::post('/skk/kasi', 'SkkController@verifikasiKasi')->name('backend.dokumen.skk.kasi');
        Route::post('/skk/hapus', 'SkkController@delete')->name('backend.dokumen.skk.delete');
        Route::post('/skk/tolak', 'SkkController@rejected')->name('backend.dokumen.skk.reject');
        Route::post('/skk/terima', 'SkkController@accepted')->name('backend.dokumen.skk.accept');


        Route::get('/skm', 'SkmController@index')->name('backend.dokumen.skm');
        Route::get('/skm/tambah', 'SkmController@create')->name('backend.dokumen.skm.create');
        Route::post('/skm/tambah', 'SkmController@createProccess')->name('backend.dokumen.skm.createProccess');
        Route::get('/skm/{id}/edit', 'SkmController@edit')->name('backend.dokumen.skm.edit');
        Route::post('/skm/{id}/edit', 'SkmController@editProccess')->name('backend.dokumen.skm.editProccess');
        Route::get('/skm/{id}/detail', 'SkmController@detail')->name('backend.dokumen.skm.detail');
        Route::post('/skm/print', 'SkmController@print')->name('backend.dokumen.skm.print');
        Route::post('/skm/kades', 'SkmController@verifikasiKades')->name('backend.dokumen.skm.kades');
        Route::post('/skm/sekdes', 'SkmController@verifikasiSekdes')->name('backend.dokumen.skm.sekdes');
        Route::post('/skm/kasi', 'SkmController@verifikasiKasi')->name('backend.dokumen.skm.kasi');
        Route::post('/skm/hapus', 'SkmController@delete')->name('backend.dokumen.skm.delete');
        Route::post('/skm/tolak', 'SkmController@rejected')->name('backend.dokumen.skm.reject');
        Route::post('/skm/terima', 'SkmController@accepted')->name('backend.dokumen.skm.accept');

        Route::get('/skrt', 'SkrtController@index')->name('backend.dokumen.skrt');
        Route::get('/skrt/tambah', 'SkrtController@create')->name('backend.dokumen.skrt.create');
        Route::post('/skrt/tambah', 'SkrtController@createProccess')->name('backend.dokumen.skrt.createProccess');
        Route::get('/skrt/{id}/edit', 'SkrtController@edit')->name('backend.dokumen.skrt.edit');
        Route::post('/skrt/{id}/edit', 'SkrtController@editProccess')->name('backend.dokumen.skrt.editProccess');
        Route::get('/skrt/{id}/detail', 'SkrtController@detail')->name('backend.dokumen.skrt.detail');
        Route::post('/skrt/print', 'SkrtController@print')->name('backend.dokumen.skrt.print');
        Route::post('/skrt/kades', 'SkrtController@verifikasiKades')->name('backend.dokumen.skrt.kades');
        Route::post('/skrt/sekdes', 'SkrtController@verifikasiSekdes')->name('backend.dokumen.skrt.sekdes');
        Route::post('/skrt/kasi', 'SkrtController@verifikasiKasi')->name('backend.dokumen.skrt.kasi');
        Route::post('/skrt/hapus', 'SkrtController@delete')->name('backend.dokumen.skrt.delete');
        Route::post('/skrt/tolak', 'SkrtController@rejected')->name('backend.dokumen.skrt.reject');
        Route::post('/skrt/terima', 'SkrtController@accepted')->name('backend.dokumen.skrt.accept');

        Route::get('/sksj', 'SksjController@index')->name('backend.dokumen.sksj');
        Route::get('/sksj/tambah', 'SksjController@create')->name('backend.dokumen.sksj.create');
        Route::post('/sksj/tambah', 'SksjController@createProccess')->name('backend.dokumen.sksj.createProccess');
        Route::get('/sksj/{id}/edit', 'SksjController@edit')->name('backend.dokumen.sksj.edit');
        Route::post('/sksj/{id}/edit', 'SksjController@editProccess')->name('backend.dokumen.sksj.editProccess');
        Route::get('/sksj/{id}/detail', 'SksjController@detail')->name('backend.dokumen.sksj.detail');
        Route::post('/sksj/print', 'SksjController@print')->name('backend.dokumen.sksj.print');
        Route::post('/sksj/kades', 'SksjController@verifikasiKades')->name('backend.dokumen.sksj.kades');
        Route::post('/sksj/sekdes', 'SksjController@verifikasiSekdes')->name('backend.dokumen.sksj.sekdes');
        Route::post('/sksj/kasi', 'SksjController@verifikasiKasi')->name('backend.dokumen.sksj.kasi');
        Route::post('/sksj/hapus', 'SksjController@delete')->name('backend.dokumen.sksj.delete');
        Route::post('/sksj/tolak', 'SksjController@rejected')->name('backend.dokumen.sksj.reject');
        Route::post('/sksj/terima', 'SksjController@accepted')->name('backend.dokumen.sksj.accept');

        Route::get('/skaw', 'SkawController@index')->name('backend.dokumen.skaw');
        Route::get('/skaw/tambah', 'SkawController@create')->name('backend.dokumen.skaw.create');
        Route::post('/skaw/tambah', 'SkawController@createProccess')->name('backend.dokumen.skaw.createProccess');
        Route::get('/skaw/{id}/edit', 'SkawController@edit')->name('backend.dokumen.skaw.edit');
        Route::post('/skaw/{id}/edit', 'SkawController@editProccess')->name('backend.dokumen.skaw.editProccess');
        Route::get('/skaw/{id}/detail', 'SkawController@detail')->name('backend.dokumen.skaw.detail');
        Route::post('/skaw/print', 'SkawController@print')->name('backend.dokumen.skaw.print');
        Route::post('/skaw/kades', 'SkawController@verifikasiKades')->name('backend.dokumen.skaw.kades');
        Route::post('/skaw/sekdes', 'SkawController@verifikasiSekdes')->name('backend.dokumen.skaw.sekdes');
        Route::post('/skaw/kasi', 'SkawController@verifikasiKasi')->name('backend.dokumen.skaw.kasi');
        Route::post('/skaw/hapus', 'SkawController@delete')->name('backend.dokumen.skaw.delete');
        Route::post('/skaw/tolak', 'SkawController@rejected')->name('backend.dokumen.skaw.reject');
        Route::post('/skaw/terima', 'SkawController@accepted')->name('backend.dokumen.skaw.accept');
    });

    Route::middleware(['auth:admin'])->namespace('Pemdes')->prefix('pemdes')->group(function () {
        Route::get('/perdes', 'PerdesController@index')->name('backend.pemdes.perdes');
        Route::get('/perdes/tambah', 'PerdesController@create')->name('backend.pemdes.perdes.create');
        Route::post('/perdes/tambah', 'PerdesController@createProccess')->name('backend.pemdes.perdes.createProccess');
        Route::get('/perdes/{id}/edit', 'PerdesController@edit')->name('backend.pemdes.perdes.edit');
        Route::post('/perdes/{id}/edit', 'PerdesController@editProccess')->name('backend.pemdes.perdes.editProccess');
        Route::post('/perdes/hapus', 'PerdesController@delete')->name('backend.pemdes.perdes.delete');
        Route::get('/perdes/{id}/detail', 'PerdesController@detail')->name('backend.pemdes.perdes.detail');
        Route::post('/perdes/aktif', 'PerdesController@active')->name('backend.pemdes.perdes.active');
        Route::post('/perdes/non-aktif', 'PerdesController@inactive')->name('backend.pemdes.perdes.inactive');
        Route::get('/struktur', 'StrukturController@index')->name('backend.pemdes.struktur');
        Route::post('/struktur', 'StrukturController@update')->name('backend.pemdes.struktur.update');
	});
	
    Route::middleware(['auth:admin'])->namespace('BUMDES')->prefix('bumdes')->group(function () {
      	Route::get('/profil', 'ProfilController@index')->name('backend.bumdes.profil');
      	Route::get('/profil/tambah', 'ProfilController@create')->name('backend.bumdes.profil.create');
		Route::post('/profil/tambah', 'ProfilController@createProccess')->name('backend.bumdes.profil.createProccess');
		Route::get('/profil/{id}/edit', 'ProfilController@edit')->name('backend.bumdes.profil.edit');
		Route::post('/profil/{id}/edit', 'ProfilController@editProccess')->name('backend.bumdes.profil.editProccess');
		Route::post('/profil/hapus', 'ProfilController@delete')->name('backend.bumdes.profil.delete');
		Route::get('/profil/{id}/detail', 'ProfilController@detail')->name('backend.bumdes.profil.detail');
		Route::post('/profil/aktif', 'ProfilController@active')->name('backend.bumdes.profil.active');
		Route::post('/profil/non-aktif', 'ProfilController@inactive')->name('backend.bumdes.profil.inactive');

    	Route::get('/produk', 'ProdukController@index')->name('backend.bumdes.produk');
		Route::get('/produk/tambah', 'ProdukController@create')->name('backend.bumdes.produk.create');
		Route::post('/produk/tambah', 'ProdukController@createProccess')->name('backend.bumdes.produk.createProccess');
		Route::get('/produk/{id}/edit', 'ProdukController@edit')->name('backend.bumdes.produk.edit');
		Route::post('/produk/{id}/edit', 'ProdukController@editProccess')->name('backend.bumdes.produk.editProccess');
		Route::post('/produk/hapus', 'ProdukController@delete')->name('backend.bumdes.produk.delete');
		Route::get('/produk/{id}/detail', 'ProdukController@detail')->name('backend.bumdes.produk.detail');
		Route::post('/produk/aktif', 'ProdukController@active')->name('backend.bumdes.produk.active');
		Route::post('/produk/non-aktif', 'ProdukController@inactive')->name('backend.bumdes.produk.inactive');
    });

    Route::middleware(['auth:admin'])->namespace('Potensi')->prefix('potensi')->group(function () {
		Route::get('/kategori', 'KategoriController@index')->name('backend.potensi.kategori');
		Route::get('/kategori/tambah', 'KategoriController@create')->name('backend.potensi.kategori.create');
		Route::post('/kategori/tambah', 'KategoriController@createProccess')->name('backend.potensi.kategori.createProccess');
		Route::get('/kategori/{id}/edit', 'KategoriController@edit')->name('backend.potensi.kategori.edit');
		Route::post('/kategori/{id}/edit', 'KategoriController@editProccess')->name('backend.potensi.kategori.editProccess');
		Route::post('/kategori/hapus', 'KategoriController@delete')->name('backend.potensi.kategori.delete');
		Route::get('/kategori/{id}/detail', 'KategoriController@detail')->name('backend.potensi.kategori.detail');
		Route::post('/kategori/aktif', 'KategoriController@active')->name('backend.potensi.kategori.active');
		Route::post('/kategori/non-aktif', 'KategoriController@inactive')->name('backend.potensi.kategori.inactive');

		Route::get('/list', 'ListController@index')->name('backend.potensi.list');
		Route::get('/list/tambah', 'ListController@create')->name('backend.potensi.list.create');
		Route::post('/list/tambah', 'ListController@createProccess')->name('backend.potensi.list.createProccess');
		Route::get('/list/{id}/edit', 'ListController@edit')->name('backend.potensi.list.edit');
		Route::post('/list/{id}/edit', 'ListController@editProccess')->name('backend.potensi.list.editProccess');
		Route::post('/list/hapus', 'ListController@delete')->name('backend.potensi.list.delete');
		Route::get('/list/{id}/detail', 'ListController@detail')->name('backend.potensi.list.detail');
		Route::post('/list/aktif', 'ListController@active')->name('backend.potensi.list.active');
		Route::post('/list/non-aktif', 'ListController@inactive')->name('backend.potensi.list.inactive');
  	});

  	Route::middleware(['auth:admin'])->namespace('Progdes')->prefix('program')->group(function () {
		Route::get('/kategori', 'KategoriController@index')->name('backend.program.category');
		Route::get('/kategori/tambah', 'KategoriController@create')->name('backend.program.category.create');
		Route::post('/kategori/tambah', 'KategoriController@createProccess')->name('backend.program.category.createProccess');
		Route::get('/kategori/{id}/edit', 'KategoriController@edit')->name('backend.program.category.edit');
		Route::post('/kategori/{id}/edit', 'KategoriController@editProccess')->name('backend.program.category.editProccess');
		Route::post('/kategori/hapus', 'KategoriController@delete')->name('backend.program.category.delete');
		Route::get('/kategori/{id}/detail', 'KategoriController@detail')->name('backend.program.category.detail');
		Route::post('/kategori/aktif', 'KategoriController@active')->name('backend.program.category.active');
		Route::post('/kategori/non-aktif', 'KategoriController@inactive')->name('backend.program.category.inactive');

		Route::get('/list', 'ListController@index')->name('backend.program.kegiatan');
		Route::get('/list/tambah', 'ListController@create')->name('backend.program.kegiatan.create');
		Route::post('/list/tambah', 'ListController@createProccess')->name('backend.program.kegiatan.createProccess');
		Route::get('/list/{id}/edit', 'ListController@edit')->name('backend.program.kegiatan.edit');
		Route::post('/list/{id}/edit', 'ListController@editProccess')->name('backend.program.kegiatan.editProccess');
		Route::post('/list/hapus', 'ListController@delete')->name('backend.program.kegiatan.delete');
		Route::get('/list/{id}/detail', 'ListController@detail')->name('backend.program.kegiatan.detail');
		Route::post('/list/aktif', 'ListController@active')->name('backend.program.kegiatan.active');
		Route::post('/list/non-aktif', 'ListController@inactive')->name('backend.program.kegiatan.inactive');
  	});

  	Route::middleware(['auth:admin'])->namespace('Kontak')->prefix('kontak')->group(function () {
		Route::get('/pesan', 'PesanController@index')->name('backend.kontak.pesan');
		Route::get('/pesan/tambah', 'PesanController@create')->name('backend.kontak.pesan.create');
		Route::post('/pesan/tambah', 'PesanController@createProccess')->name('backend.kontak.pesan.createProccess');
		Route::get('/pesan/{id}/edit', 'PesanController@edit')->name('backend.kontak.pesan.edit');
		Route::post('/pesan/{id}/edit', 'PesanController@editProccess')->name('backend.kontak.pesan.editProccess');
		Route::post('/pesan/hapus', 'PesanController@delete')->name('backend.kontak.pesan.delete');
		Route::get('/pesan/{id}/detail', 'PesanController@detail')->name('backend.kontak.pesan.detail');
		Route::post('/pesan/aktif', 'PesanController@active')->name('backend.kontak.pesan.active');
		Route::post('/pesan/non-aktif', 'PesanController@inactive')->name('backend.kontak.pesan.inactive');
    });

    Route::middleware(['auth:admin'])->namespace('DataMaster')->prefix('datamaster')->group(function () {
        Route::get('/slider', 'SliderController@index')->name('backend.datamaster.slider');
        Route::get('/slider/tambah', 'SliderController@create')->name('backend.datamaster.slider.create');
        Route::post('/slider/tambah', 'SliderController@createProccess')->name('backend.datamaster.slider.createProccess');
        Route::get('/slider/{id}/edit', 'SliderController@edit')->name('backend.datamaster.slider.edit');
        Route::post('/slider/{id}/edit', 'SliderController@editProccess')->name('backend.datamaster.slider.editProccess');
        Route::post('/slider/hapus', 'SliderController@delete')->name('backend.datamaster.slider.delete');
        Route::get('/slider/{id}/detail', 'SliderController@detail')->name('backend.datamaster.slider.detail');
        Route::post('/slider/aktif', 'SliderController@active')->name('backend.datamaster.slider.active');
        Route::post('/slider/non-aktif', 'SliderController@inactive')->name('backend.datamaster.slider.inactive');
    });

	Route::get('/clear-cache', function() {
		Artisan::call('cache:clear');
		toastr()->success('Cache Clear Successfully','Berhasil');

		return redirect()->back();
	});

	Route::get('/config-cache', function() {
		Artisan::call('config:cache');
		toastr()->success('Config Clear Successfully','Berhasil');

		return redirect()->back();
	});

	Route::get('/view-clear', function() {
		Artisan::call('view:clear');
		toastr()->success('View Clear Successfully','Berhasil');
		return redirect()->back();
	});

	Route::get('/storage-link', function() {
		Artisan::call('storage:link');
		toastr()->success('Storage Successfully','Berhasil');
		return redirect()->back();
	});

    Route::get('/apps-down', function() {
		Artisan::call('down');
		toastr()->success('Smartdesa is Maintenance','Berhasil');
		return redirect()->back();
	});

	Route::get('/apps-up', function() {
		Artisan::call('up');
		toastr()->success('Smartdesa is back','Berhasil');
		return redirect()->back();
	});

});



