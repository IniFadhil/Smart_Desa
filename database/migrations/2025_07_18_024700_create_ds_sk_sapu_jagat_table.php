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
        Schema::create('ds_sk_sapu_jagat', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('no_surat', 150)->nullable();
            $table->string('desa_id', 50)->index('ds_sk_sapu_jagat_desa_id_foreign');
            $table->string('user_id', 50)->index('ds_sk_sapu_jagat_user_id_foreign');
            $table->string('nama_pejabat', 150);
            $table->string('jabatan', 150);
            $table->text('alamat');
            $table->string('no_nik', 16)->unique();
            $table->string('nama_penduduk', 150);
            $table->string('umur', 150);
            $table->string('keperluan', 150);
            $table->date('tgl_menetap');
            $table->string('pekerjaan_id', 50)->index('ds_sk_sapu_jagat_pekerjaan_id_foreign');
            $table->text('alamat_kantor');
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id')->nullable()->index('ds_sk_sapu_jagat_kasi_id_foreign');
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('file_ktp');
            $table->string('file_rtrw');
            $table->string('file_surat_pernyataan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_sapu_jagat');
    }
};
