<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkKematian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_kematian', function (Blueprint $table) {
            $table->string('id',50)->index();
            $table->string('no_surat',150)->nullable();
            $table->string('desa_id',50);
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('nama_kepala_keluarga',150);
            $table->string('no_kk',30);
            $table->string('nik_jenazah',16);
            $table->string('nama_jenazah',150);
            $table->enum('jk_jenazah',['laki-laki','perempuan']);
            $table->date('tgl_lahir_jenazah');
            $table->string('tempat_lahir',150);
            $table->enum('agama',['islam','kristen','katolik','hindu','budha']);
            $table->string('pekerjaan_id_jenazah',50);
            $table->foreign('pekerjaan_id_jenazah')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_jenazah');
            $table->string('provinsi_id_jenazah',50);
            $table->foreign('provinsi_id_jenazah')->references('id')->on('ds_provinsi');
            $table->string('kota_id_jenazah',50);
            $table->foreign('kota_id_jenazah')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_jenazah',50);
            $table->foreign('kecamatan_id_jenazah')->references('id')->on('ds_kecamatan');
            $table->string('area_id_jenazah',50);
            $table->foreign('area_id_jenazah')->references('id')->on('ds_desa');
            $table->enum('kewarganegaraan',['wni','wna']);
            $table->enum('keturunan',['eropa','cina/timur asing lainnya','indonesia','indonesia nasrani','lainnya']);
            $table->string('kebangsaan',150);
            $table->string('anak_ke',2);
            $table->date('tgl_kematian');
            $table->string('pukul',50);
            $table->enum('sebab_kematian',['sakit biasa.tua','wabah penyakit','kecelakaan','kriminalitas','bunuh diri','lainnya']);
            $table->string('tempat_kematian',150);
            $table->enum('yang_menerangkan',['dokter','tenaga kesehatan','kepolisian','lainnya']);
            $table->string('nik_ibu',16);
            $table->string('nama_ibu',150);
            $table->string('umur_ibu',3);
            $table->string('pekerjaan_id_ibu',50);
            $table->foreign('pekerjaan_id_ibu')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_ibu');
            $table->string('provinsi_id_ibu',50);
            $table->foreign('provinsi_id_ibu')->references('id')->on('ds_provinsi');
            $table->string('kota_id_ibu',50);
            $table->foreign('kota_id_ibu')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_ibu',50);
            $table->foreign('kecamatan_id_ibu')->references('id')->on('ds_kecamatan');
            $table->string('area_id_ibu',50);
            $table->foreign('area_id_ibu')->references('id')->on('ds_desa');
            $table->string('nik_ayah',16);
            $table->string('nama_ayah',150);
            $table->string('umur_ayah',3);
            $table->string('pekerjaan_id_ayah',50);
            $table->foreign('pekerjaan_id_ayah')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_ayah');
            $table->string('provinsi_id_ayah',50);
            $table->foreign('provinsi_id_ayah')->references('id')->on('ds_provinsi');
            $table->string('kota_id_ayah',50);
            $table->foreign('kota_id_ayah')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_ayah',50);
            $table->foreign('kecamatan_id_ayah')->references('id')->on('ds_kecamatan');
            $table->string('area_id_ayah',50);
            $table->foreign('area_id_ayah')->references('id')->on('ds_desa');
            $table->string('nik_pelapor',16);
            $table->string('nama_pelapor',150);
            $table->string('nik_saksi1',16);
            $table->string('nama_saksi1',150);
            $table->string('nik_saksi2',16);
            $table->string('nama_saksi2',150);
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
        Schema::dropIfExists('ds_sk_kematian');
    }
}
