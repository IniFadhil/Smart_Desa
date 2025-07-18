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
        Schema::create('ds_sk_kelahiran', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50)->index('ds_sk_kelahiran_desa_id_foreign');
            $table->string('no_surat', 150)->nullable();
            $table->string('nama_kepala_keluarga', 150);
            $table->string('no_kk', 30);
            $table->string('nama_bayi', 150);
            $table->enum('jk_bayi', ['laki-laki', 'perempuan']);
            $table->enum('tempat_dilahirkan', ['rs/rb', 'puskesmas', 'polindes', 'rumah', 'lainnya']);
            $table->string('tempat_lahir', 150);
            $table->string('hari', 150);
            $table->date('tgl_lahir_bayi');
            $table->string('pukul', 50);
            $table->enum('jenis_kelahiran', ['tunggal', 'kembar 2', 'kembar 3', 'kembar 4', 'lainnya']);
            $table->string('kelahiran_ke', 2);
            $table->enum('penolong_kelahiran', ['dokter', 'bidan/perawat', 'dukun', 'lainnya']);
            $table->string('berat_bayi', 10);
            $table->string('panjang_bayi', 10);
            $table->string('nik_ibu', 16);
            $table->string('nama_ibu', 150);
            $table->date('tgl_lahir_ibu');
            $table->string('pekerjaan_id_ibu', 50)->index('ds_sk_kelahiran_pekerjaan_id_ibu_foreign');
            $table->text('alamat_ibu');
            $table->string('provinsi_id_ibu', 50)->index('ds_sk_kelahiran_provinsi_id_ibu_foreign');
            $table->string('kota_id_ibu', 50)->index('ds_sk_kelahiran_kota_id_ibu_foreign');
            $table->string('kecamatan_id_ibu', 50)->index('ds_sk_kelahiran_kecamatan_id_ibu_foreign');
            $table->string('area_id_ibu', 50)->index('ds_sk_kelahiran_area_id_ibu_foreign');
            $table->enum('kewarganegaraan_ibu', ['wni', 'wna']);
            $table->string('kebangsaan_ibu', 150);
            $table->date('tgl_pencatatan_perkawinan');
            $table->string('nik_ayah', 16);
            $table->string('nama_ayah', 150);
            $table->date('tgl_lahir_ayah');
            $table->string('pekerjaan_id_ayah', 50)->index('ds_sk_kelahiran_pekerjaan_id_ayah_foreign');
            $table->text('alamat_ayah');
            $table->string('provinsi_id_ayah', 50)->index('ds_sk_kelahiran_provinsi_id_ayah_foreign');
            $table->string('kota_id_ayah', 50)->index('ds_sk_kelahiran_kota_id_ayah_foreign');
            $table->string('kecamatan_id_ayah', 50)->index('ds_sk_kelahiran_kecamatan_id_ayah_foreign');
            $table->string('area_id_ayah', 50)->index('ds_sk_kelahiran_area_id_ayah_foreign');
            $table->enum('kewarganegaraan_ayah', ['wni', 'wna']);
            $table->string('kebangsaan_ayah', 150);
            $table->string('nik_pelapor', 16);
            $table->string('nama_pelapor', 150);
            $table->string('umur_pelapor', 3);
            $table->enum('jk_pelapor', ['laki-laki', 'perempuan']);
            $table->string('pekerjaan_id_pelapor', 50)->index('ds_sk_kelahiran_pekerjaan_id_pelapor_foreign');
            $table->text('alamat_pelapor');
            $table->string('provinsi_id_pelapor', 50)->index('ds_sk_kelahiran_provinsi_id_pelapor_foreign');
            $table->string('kota_id_pelapor', 50)->index('ds_sk_kelahiran_kota_id_pelapor_foreign');
            $table->string('kecamatan_id_pelapor', 50)->index('ds_sk_kelahiran_kecamatan_id_pelapor_foreign');
            $table->string('area_id_pelapor', 50)->index('ds_sk_kelahiran_area_id_pelapor_foreign');
            $table->string('nik_saksi1', 16);
            $table->string('nama_saksi1', 150);
            $table->string('umur_saksi1', 3);
            $table->string('pekerjaan_id_saksi1', 50)->index('ds_sk_kelahiran_pekerjaan_id_saksi1_foreign');
            $table->text('alamat_saksi1');
            $table->string('provinsi_id_saksi1', 50)->index('ds_sk_kelahiran_provinsi_id_saksi1_foreign');
            $table->string('kota_id_saksi1', 50)->index('ds_sk_kelahiran_kota_id_saksi1_foreign');
            $table->string('kecamatan_id_saksi1', 50)->index('ds_sk_kelahiran_kecamatan_id_saksi1_foreign');
            $table->string('area_id_saksi1', 50)->index('ds_sk_kelahiran_area_id_saksi1_foreign');
            $table->string('nik_saksi2', 16);
            $table->string('nama_saksi2', 150);
            $table->string('umur_saksi2', 3);
            $table->string('pekerjaan_id_saksi2', 50)->index('ds_sk_kelahiran_pekerjaan_id_saksi2_foreign');
            $table->text('alamat_saksi2');
            $table->string('provinsi_id_saksi2', 50)->index('ds_sk_kelahiran_provinsi_id_saksi2_foreign');
            $table->string('kota_id_saksi2', 50)->index('ds_sk_kelahiran_kota_id_saksi2_foreign');
            $table->string('kecamatan_id_saksi2', 50)->index('ds_sk_kelahiran_kecamatan_id_saksi2_foreign');
            $table->string('area_id_saksi2', 50)->index('ds_sk_kelahiran_area_id_saksi2_foreign');
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id')->nullable()->index('ds_sk_kelahiran_kasi_id_foreign');
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
            $table->string('no_hp');
            $table->string('file_sk_kelahiran');
            $table->string('file_surat_nikah');
            $table->string('file_kk');
            $table->string('file_ayah');
            $table->string('file_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_kelahiran');
    }
};
