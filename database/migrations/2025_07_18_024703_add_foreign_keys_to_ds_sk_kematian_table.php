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
        Schema::table('ds_sk_kematian', function (Blueprint $table) {
            $table->foreign(['area_id_ayah'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['area_id_ibu'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['area_id_jenazah'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['desa_id'])->references(['id'])->on('ds_desa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kasi_id'])->references(['id'])->on('ds_admins')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kecamatan_id_ayah'])->references(['id'])->on('ds_kecamatan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kecamatan_id_ibu'])->references(['id'])->on('ds_kecamatan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kecamatan_id_jenazah'])->references(['id'])->on('ds_kecamatan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kota_id_ayah'])->references(['id'])->on('ds_kota')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kota_id_ibu'])->references(['id'])->on('ds_kota')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kota_id_jenazah'])->references(['id'])->on('ds_kota')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pekerjaan_id_ayah'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pekerjaan_id_ibu'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pekerjaan_id_jenazah'])->references(['id'])->on('ds_pekerjaan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['provinsi_id_ayah'])->references(['id'])->on('ds_provinsi')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['provinsi_id_ibu'])->references(['id'])->on('ds_provinsi')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['provinsi_id_jenazah'])->references(['id'])->on('ds_provinsi')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_sk_kematian', function (Blueprint $table) {
            $table->dropForeign('ds_sk_kematian_area_id_ayah_foreign');
            $table->dropForeign('ds_sk_kematian_area_id_ibu_foreign');
            $table->dropForeign('ds_sk_kematian_area_id_jenazah_foreign');
            $table->dropForeign('ds_sk_kematian_desa_id_foreign');
            $table->dropForeign('ds_sk_kematian_kasi_id_foreign');
            $table->dropForeign('ds_sk_kematian_kecamatan_id_ayah_foreign');
            $table->dropForeign('ds_sk_kematian_kecamatan_id_ibu_foreign');
            $table->dropForeign('ds_sk_kematian_kecamatan_id_jenazah_foreign');
            $table->dropForeign('ds_sk_kematian_kota_id_ayah_foreign');
            $table->dropForeign('ds_sk_kematian_kota_id_ibu_foreign');
            $table->dropForeign('ds_sk_kematian_kota_id_jenazah_foreign');
            $table->dropForeign('ds_sk_kematian_pekerjaan_id_ayah_foreign');
            $table->dropForeign('ds_sk_kematian_pekerjaan_id_ibu_foreign');
            $table->dropForeign('ds_sk_kematian_pekerjaan_id_jenazah_foreign');
            $table->dropForeign('ds_sk_kematian_provinsi_id_ayah_foreign');
            $table->dropForeign('ds_sk_kematian_provinsi_id_ibu_foreign');
            $table->dropForeign('ds_sk_kematian_provinsi_id_jenazah_foreign');
        });
    }
};
