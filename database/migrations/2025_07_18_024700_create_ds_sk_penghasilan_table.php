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
        Schema::create('ds_sk_penghasilan', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('no_surat', 150)->nullable();
            $table->string('desa_id', 50)->index('ds_sk_penghasilan_desa_id_foreign');
            $table->string('nama', 150);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 150);
            $table->date('tgl_lahir');
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->string('pekerjaan_id', 50)->index('ds_sk_penghasilan_pekerjaan_id_foreign');
            $table->text('alamat');
            $table->string('kota_id', 50)->index('ds_sk_penghasilan_kota_id_foreign');
            $table->string('kecamatan_id', 50)->index('ds_sk_penghasilan_kecamatan_id_foreign');
            $table->string('area_id', 50)->index('ds_sk_penghasilan_area_id_foreign');
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id')->nullable()->index('ds_sk_penghasilan_kasi_id_foreign');
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
            $table->string('no_hp');
            $table->string('slip_gaji');
            $table->string('file_ktp');
            $table->string('file_kk');
            $table->string('file_surat_pernyataan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_penghasilan');
    }
};
