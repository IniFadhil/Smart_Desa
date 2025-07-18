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
        Schema::create('ds_notifikasi_admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_id')->index('ds_notifikasi_admin_admin_id_foreign');
            $table->string('judul', 150);
            $table->string('deskripsi', 250);
            $table->string('photo');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_notifikasi_admin');
    }
};
