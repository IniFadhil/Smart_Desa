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
        Schema::table('ds_desa', function (Blueprint $table) {
            $table->foreign(['kota_id'], 'ds_desa_ibfk_1')->references(['id'])->on('ds_kota')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['negara_id'], 'ds_desa_ibfk_2')->references(['id'])->on('ds_negara')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['kecamatan_id'], 'ds_desa_ibfk_3')->references(['id'])->on('ds_kecamatan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['provinsi_id'], 'ds_desa_ibfk_4')->references(['id'])->on('ds_provinsi')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_desa', function (Blueprint $table) {
            $table->dropForeign('ds_desa_ibfk_1');
            $table->dropForeign('ds_desa_ibfk_2');
            $table->dropForeign('ds_desa_ibfk_3');
            $table->dropForeign('ds_desa_ibfk_4');
        });
    }
};
