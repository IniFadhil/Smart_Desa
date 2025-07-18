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
        Schema::table('ds_provinsi', function (Blueprint $table) {
            $table->foreign(['negara_id'], 'ds_provinsi_ibfk_1')->references(['id'])->on('ds_negara')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_provinsi', function (Blueprint $table) {
            $table->dropForeign('ds_provinsi_ibfk_1');
        });
    }
};
