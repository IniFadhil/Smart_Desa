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
        Schema::table('ds_download', function (Blueprint $table) {
            $table->foreign(['desa_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_download', function (Blueprint $table) {
            $table->dropForeign('ds_download_desa_id_foreign');
        });
    }
};
