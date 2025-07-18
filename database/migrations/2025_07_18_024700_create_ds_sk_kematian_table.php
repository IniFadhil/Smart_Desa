<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ds_sk_kematian', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('no_surat', 150)->nullable();
            $table->string('desa_id', 50)->index('ds_sk_kematian_desa_id_foreign');
            $table->string('nama_kepala_keluarga', 150);
            $table->string('no_kk', 30);
            $table->string('nik_jenazah', 16);
            $table->string('nama_jenazah', 150);
            $table->enum('jk_jenazah', ['laki-laki', 'perempuan']);
            $table->date('tgl_lahir_jenazah');
            $table->string('tempat_lahir', 150);
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha']);
            $table->string('pekerjaan_id_jenazah', 50)->index('ds_sk_kematian_pekerjaan_id_jenazah_foreign');
            $table->text('alamat_jenazah');
            $table->string('provinsi_id_jenazah', 50)->index('ds_sk_kematian_provinsi_id_jenazah_foreign');
            $table->string('kota_id_jenazah', 50)->index('ds_sk_kematian_kota_id_jenazah_foreign');
            $table->string('kecamatan_id_jenazah', 50)->index('ds_sk_kematian_kecamatan_id_jenazah_foreign');
            $table->string('area_id_jenazah', 50)->index('ds_sk_kematian_area_id_jenazah_foreign');
            $table->enum('kewarganegaraan', ['wni', 'wna']);
            $table->enum('keturunan', ['eropa', 'cina/timur asing lainnya', 'indonesia', 'indonesia nasrani', 'lainnya']);
            $table->string('kebangsaan', 150);
            $table->string('anak_ke', 2);
            $table->date('tgl_kematian');
            $table->string('pukul', 50);
            $table->enum('sebab_kematian', ['sakit biasa.tua', 'wabah penyakit', 'kecelakaan', 'kriminalitas', 'bunuh diri', 'lainnya']);
            $table->string('tempat_kematian', 150);
            $table->enum('yang_menerangkan', ['dokter', 'tenaga kesehatan', 'kepolisian', 'lainnya']);
            $table->string('nik_ibu', 16);
            $table->string('nama_ibu', 150);
            $table->string('umur_ibu', 3);
            $table->string('pekerjaan_id_ibu', 50)->index('ds_sk_kematian_pekerjaan_id_ibu_foreign');
            $table->text('alamat_ibu');
            $table->string('provinsi_id_ibu', 50)->index('ds_sk_kematian_provinsi_id_ibu_foreign');
            $table->string('kota_id_ibu', 50)->index('ds_sk_kematian_kota_id_ibu_foreign');
            $table->string('kecamatan_id_ibu', 50)->index('ds_sk_kematian_kecamatan_id_ibu_foreign');
            $table->string('area_id_ibu', 50)->index('ds_sk_kematian_area_id_ibu_foreign');
            $table->string('nik_ayah', 16);
            $table->string('nama_ayah', 150);
            $table->string('umur_ayah', 3);
            $table->string('pekerjaan_id_ayah', 50)->index('ds_sk_kematian_pekerjaan_id_ayah_foreign');
            $table->text('alamat_ayah');
            $table->string('provinsi_id_ayah', 50)->index('ds_sk_kematian_provinsi_id_ayah_foreign');
            $table->string('kota_id_ayah', 50)->index('ds_sk_kematian_kota_id_ayah_foreign');
            $table->string('kecamatan_id_ayah', 50)->index('ds_sk_kematian_kecamatan_id_ayah_foreign');
            $table->string('area_id_ayah', 50)->index('ds_sk_kematian_area_id_ayah_foreign');
            $table->string('nik_pelapor', 16);
            $table->string('nama_pelapor', 150);
            $table->string('nik_saksi1', 16);
            $table->string('nama_saksi1', 150);
            $table->string('nik_saksi2', 16);
            $table->string('nama_saksi2', 150);
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id')->nullable()->index('ds_sk_kematian_kasi_id_foreign');
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
            $table->string('no_hp');
            $table->string('file_ktp_alm');
            $table->string('file_ktp_pelapor');
            $table->string('file_ktp_saksi');
            $table->string('file_sk_rs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_kematian');
    }
};
