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
        Schema::create('ds_profil_desa', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('nama', 150)->unique();
            $table->string('foto_desa', 150)->nullable();
            $table->string('kades', 150);
            $table->string('foto_kades', 150)->nullable();
            $table->text('sambutan')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('gambaran_umum')->nullable();
            $table->text('kondisi_geografis')->nullable();
            $table->string('no_telpon', 191);
            $table->string('alamat', 191);
            $table->string('email', 191)->nullable();
            $table->string('website', 191)->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('latitude', 191)->nullable();
            $table->string('longitude', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_profil_desa');
    }
};
