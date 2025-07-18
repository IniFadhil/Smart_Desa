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
        Schema::create('ds_buku_tamu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desa_id');
            $table->string('nama');
            $table->string('telepon');
            $table->string('subjek');
            $table->text('pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_buku_tamu');
    }
};
