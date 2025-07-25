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
        Schema::table('ds_notifikasi_admin', function (Blueprint $table) {
            $table->foreign(['admin_id'])->references(['id'])->on('ds_admins')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_notifikasi_admin', function (Blueprint $table) {
            $table->dropForeign('ds_notifikasi_admin_admin_id_foreign');
        });
    }
};
