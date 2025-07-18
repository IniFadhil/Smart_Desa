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
        Schema::table('ds_sk_usaha', function (Blueprint $table) {
            $table->foreign(['area_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['desa_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kecamatan_id'])->references(['id'])->on('ds_kecamatan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kota_id'])->references(['id'])->on('ds_kota')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pekerjaan_id'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'FK_ds_sk_usaha_ds_users')->references(['id'])->on('ds_users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_sk_usaha', function (Blueprint $table) {
            $table->dropForeign('ds_sk_usaha_area_id_foreign');
            $table->dropForeign('ds_sk_usaha_desa_id_foreign');
            $table->dropForeign('ds_sk_usaha_kecamatan_id_foreign');
            $table->dropForeign('ds_sk_usaha_kota_id_foreign');
            $table->dropForeign('ds_sk_usaha_pekerjaan_id_foreign');
            $table->dropForeign('FK_ds_sk_usaha_ds_users');
        });
    }
};
