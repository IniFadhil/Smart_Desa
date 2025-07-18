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
        Schema::create('ds_komentar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desa_id', 50)->default('');
            $table->string('informasi_id');
            $table->string('kategori');
            $table->string('nama', 150);
            $table->string('email', 150);
            $table->text('komentar');
            $table->text('balas');
            $table->string('admin', 191);
            $table->enum('status', ['show', 'hide'])->default('hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_komentar');
    }
};
