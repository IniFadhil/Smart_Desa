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
        Schema::create('ds_kecamatan', function (Blueprint $table) {
            $table->string('id', 50)->index('sys_districts_id_index');
            $table->string('nama', 100);
            $table->tinyInteger('status')->default(0);
            $table->string('negara_id', 50)->index('sys_districts_country_id_foreign');
            $table->string('provinsi_id', 50)->index('sys_districts_province_id_foreign');
            $table->string('kota_id', 50)->index('sys_districts_city_id_foreign');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_kecamatan');
    }
};
