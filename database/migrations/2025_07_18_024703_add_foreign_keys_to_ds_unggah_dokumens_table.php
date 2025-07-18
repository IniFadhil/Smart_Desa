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
        Schema::table('ds_unggah_dokumens', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('ds_users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_unggah_dokumens', function (Blueprint $table) {
            $table->dropForeign('ds_unggah_dokumens_user_id_foreign');
        });
    }
};
