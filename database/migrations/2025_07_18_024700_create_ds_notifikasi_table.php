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
        Schema::create('ds_notifikasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pengguna', 50);
            $table->string('judul', 250);
            $table->text('deskripsi');
            $table->string('photo', 75)->default('default.jpg');
            $table->dateTime('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_notifikasi');
    }
};
