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
        Schema::table('ds_skbn_detail', function (Blueprint $table) {
            $table->foreign(['skbn_id'])->references(['id'])->on('ds_sk_beda_nama')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_skbn_detail', function (Blueprint $table) {
            $table->dropForeign('ds_skbn_detail_skbn_id_foreign');
        });
    }
};
