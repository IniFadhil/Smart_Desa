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
        Schema::table('ds_program_list', function (Blueprint $table) {
            $table->foreign(['kategori_id'])->references(['id'])->on('ds_program_kategori')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_program_list', function (Blueprint $table) {
            $table->dropForeign('ds_program_list_kategori_id_foreign');
        });
    }
};
