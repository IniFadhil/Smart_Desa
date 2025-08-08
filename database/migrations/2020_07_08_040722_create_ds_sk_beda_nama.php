<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkBedaNama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_beda_nama', function (Blueprint $table) {
            $table->string('id',50)->index();
            $table->string('no_surat',150)->nullable();
            $table->string('desa_id',50);
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('data_dok_benar',50);
            $table->enum('verifikasi_kasi',[1,0])->default(0);
            $table->enum('verifikasi_sekdes',[1,0])->default(0);
            $table->enum('verifikasi_kades',[1,0])->default(0);
            $table->enum('status',['1','0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ds_sk_beda_nama');
    }
}
