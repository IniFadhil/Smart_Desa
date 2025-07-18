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
        Schema::table('ds_users', function (Blueprint $table) {
            $table->foreign(['desa_id'], 'FK_ds_users_ds_desa')->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_users', function (Blueprint $table) {
            $table->dropForeign('FK_ds_users_ds_desa');
        });
    }
};
