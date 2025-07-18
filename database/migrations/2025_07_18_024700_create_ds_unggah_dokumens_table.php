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
        Schema::create('ds_unggah_dokumens', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('user_id', 50)->index('ds_unggah_dokumens_user_id_foreign');
            $table->string('file_ktp', 150);
            $table->string('file_kk', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_unggah_dokumens');
    }
};
