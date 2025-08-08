<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_usaha', function (Blueprint $table) {
            $table->string('id',50)->index();
            $table->string('no_surat',150)->nullable();
            $table->string('desa_id',50);
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('nama',150);
            $table->string('nik',16);
            $table->string('tempat_lahir',150);
            $table->date('tgl_lahir');
            $table->enum('jk',['laki-laki','perempuan']);
            $table->string('pekerjaan_id',50);
            $table->foreign('pekerjaan_id')->references('id')->on('ds_pekerjaan');
            $table->text('alamat');
            $table->string('kota_id',50);
            $table->foreign('kota_id')->references('id')->on('ds_kota');
            $table->string('kecamatan_id',50);
            $table->foreign('kecamatan_id')->references('id')->on('ds_kecamatan');
            $table->string('area_id',50);
            $table->foreign('area_id')->references('id')->on('ds_desa');
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
        Schema::dropIfExists('ds_sk_usaha');
    }
}
