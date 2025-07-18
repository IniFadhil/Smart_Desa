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
        Schema::table('ds_potensi_list', function (Blueprint $table) {
            $table->foreign(['kategori_id'])->references(['id'])->on('ds_potensi_kategori')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_potensi_list', function (Blueprint $table) {
            $table->dropForeign('ds_potensi_list_kategori_id_foreign');
        });
    }
};
