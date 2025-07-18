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
        Schema::create('ds_struktur_organisasi', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50)->index('ds_struktur_organisasi_desa_id_foreign');
            $table->string('title', 191);
            $table->text('description');
            $table->string('slug', 191);
            $table->string('img', 191)->nullable();
            $table->bigInteger('hit')->default(0);
            $table->string('created_by', 191)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_struktur_organisasi');
    }
};
