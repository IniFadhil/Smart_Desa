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
        Schema::create('ds_sk_ahli_waris', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('no_surat', 150)->nullable();
            $table->string('desa_id', 50)->index('ds_sk_ahli_waris_desa_id_foreign');
            $table->string('user_id', 50)->index('ds_sk_ahli_waris_user_id_foreign');
            $table->string('nama_alm', 150);
            $table->enum('jk_alm', ['laki-laki', 'perempuan']);
            $table->string('tgl_kematian', 150);
            $table->text('alamat');
            $table->string('nama_saksi1')->nullable();
            $table->string('nik_saksi1', 16)->nullable();
            $table->string('nama_saksi2')->nullable();
            $table->string('nik_saksi2', 16)->nullable();
            $table->string('kota_id', 50)->index('ds_sk_ahli_waris_kota_id_foreign');
            $table->string('kecamatan_id', 50)->index('ds_sk_ahli_waris_kecamatan_id_foreign');
            $table->string('area_id', 50)->index('ds_sk_ahli_waris_area_id_foreign');
            $table->enum('verifikasi_kasi', ['1', '0'])->default('0');
            $table->string('kasi_id')->nullable()->index('ds_sk_ahli_waris_kasi_id_foreign');
            $table->enum('verifikasi_sekdes', ['1', '0'])->default('0');
            $table->enum('verifikasi_kades', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('file_surat_permohonan');
            $table->string('file_ktp');
            $table->string('file_kk');
            $table->string('file_buku_nikah');
            $table->string('file_silsilah');
            $table->string('file_sk_kematian');
            $table->string('file_akta_lahir');
            $table->string('file_surat_pernyataan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_sk_ahli_waris');
    }
};
