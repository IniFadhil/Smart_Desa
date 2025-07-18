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
        Schema::create('ds_skbn_detail', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('skbn_id', 50)->index('ds_skbn_detail_skbn_id_foreign');
            $table->enum('jenis_dok', ['ktp', 'sim', 'kk', 'ijazah', 'akta nikah']);
            $table->string('nomor_dok', 50);
            $table->string('nama_dok', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_skbn_detail');
    }
};
