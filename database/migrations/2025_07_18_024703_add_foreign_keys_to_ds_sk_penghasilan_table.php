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
        Schema::table('ds_sk_penghasilan', function (Blueprint $table) {
            $table->foreign(['area_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['desa_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kasi_id'])->references(['id'])->on('ds_admins')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kecamatan_id'])->references(['id'])->on('ds_kecamatan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kota_id'])->references(['id'])->on('ds_kota')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pekerjaan_id'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_sk_penghasilan', function (Blueprint $table) {
            $table->dropForeign('ds_sk_penghasilan_area_id_foreign');
            $table->dropForeign('ds_sk_penghasilan_desa_id_foreign');
            $table->dropForeign('ds_sk_penghasilan_kasi_id_foreign');
            $table->dropForeign('ds_sk_penghasilan_kecamatan_id_foreign');
            $table->dropForeign('ds_sk_penghasilan_kota_id_foreign');
            $table->dropForeign('ds_sk_penghasilan_pekerjaan_id_foreign');
        });
    }
};
