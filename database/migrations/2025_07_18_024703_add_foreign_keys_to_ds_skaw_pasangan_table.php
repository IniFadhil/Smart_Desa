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
        Schema::table('ds_skaw_pasangan', function (Blueprint $table) {
            $table->foreign(['pekerjaan_id'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['skaw_id'])->references(['id'])->on('ds_sk_ahli_waris')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_skaw_pasangan', function (Blueprint $table) {
            $table->dropForeign('ds_skaw_pasangan_pekerjaan_id_foreign');
            $table->dropForeign('ds_skaw_pasangan_skaw_id_foreign');
        });
    }
};
