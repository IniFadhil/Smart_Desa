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
        Schema::create('ds_sk_usaha', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('no_surat', 150)->nullable();
            $table->string('desa_id', 50)->index('ds_sk_usaha_desa_id_foreign');
            $table->string('user_id', 50)->index('fk_ds_sk_usaha_ds_users');
            $table->string('nama', 150);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 150);
            $table->date('tgl_lahir');
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->string('pekerjaan_id', 50)->index('ds_sk_usaha_pekerjaan_id_foreign');
            $table->string('jenis_usaha', 190);
            $table->text('alamat');
            $table->string('kota_id', 50)->index('ds_sk_usaha_kota_id_foreign');
            $table->string('kecamatan_id', 50)->index('ds_sk_usaha_kecamatan_id_foreign');
            $table->string('area_id', 50)->index('ds_sk_usaha_area_id_foreign');
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id', 50)->nullable();
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
            $table->date('finished_date')->nullable();
            $table->string('file_sp_rtrw', 191);
            $table->string('file_ktp', 191);
            $table->string('file_kk', 191);
            $table->string('file_surat_pernyataan', 191);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_usaha');
    }
};
