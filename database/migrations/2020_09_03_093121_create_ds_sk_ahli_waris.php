<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkAhliWaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_ahli_waris', function (Blueprint $table) {
            $table->string('id',50)->index();
            $table->string('no_surat',150)->nullable();
            $table->string('desa_id',50);
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('user_id',50);
            $table->foreign('user_id')->references('id')->on('ds_users');
            $table->string('nama_alm',150);
            $table->enum('jk_alm',['laki-laki','perempuan']);
            $table->string('tgl_kematian',150);
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
            $table->string('file_surat_permohonan');
            $table->string('file_ktp');
            $table->string('file_kk');
            $table->string('file_buku_nikah');
            $table->string('file_silsilah');
            $table->string('file_sk_kematian');
            $table->string('file_akta_lahir');
            $table->string('file_surat_pernyataan');
            $table->timestamps();
        });

        Schema::create('ds_skaw_pasangan', function (Blueprint $table) {
            $table->id();
            $table->string('skaw_id',50);
            $table->foreign('skaw_id')->references('id')->on('ds_sk_ahli_waris');
            $table->string('nama',150);
            $table->enum('jk_alm',['laki-laki','perempuan']);
            $table->string('tempat_lahir',150);
            $table->date('tgl_lahir');
            $table->string('pekerjaan_id',50);
            $table->foreign('pekerjaan_id')->references('id')->on('ds_pekerjaan');
            $table->timestamps();
        });

        Schema::create('ds_skaw_anak', function (Blueprint $table) {
            $table->id();
            $table->string('skaw_id',50);
            $table->foreign('skaw_id')->references('id')->on('ds_sk_ahli_waris');
            $table->string('nama',150);
            $table->string('tempat_lahir',150);
            $table->date('tgl_lahir');
            $table->enum('kewarganegaraan',['indonesia','wna']);
            $table->text('alamat');
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
        Schema::dropIfExists('ds_skaw_anak');
        Schema::dropIfExists('ds_skaw_pasangan');
        Schema::dropIfExists('ds_sk_ahli_waris');
    }
}
