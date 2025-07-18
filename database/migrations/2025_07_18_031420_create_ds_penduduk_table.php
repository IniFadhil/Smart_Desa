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
        Schema::create('ds_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->nullable()->unique();
            $table->string('nama_lengkap');
            $table->string('no_kk', 50)->nullable();
            $table->integer('kk_level')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 30)->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_kawin', 30)->nullable();
            $table->string('status_keluarga', 50)->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('golongan_darah', 5)->nullable();
            $table->text('alamat_sekarang')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email')->nullable();
            $table->integer('status_dasar')->nullable();
            $table->string('status_rekam', 50)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps(); // membuat kolom created_at dan updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_penduduk');
    }
};
