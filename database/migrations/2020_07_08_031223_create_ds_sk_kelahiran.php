<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkKelahiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_kelahiran', function (Blueprint $table) {
            $table->string('id',50)->index();
            $table->string('desa_id',50);
            $table->string('no_surat',150)->nullable();
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('nama_kepala_keluarga',150);
            $table->string('no_kk',30);
            $table->string('nama_bayi',150);
            $table->enum('jk_bayi',['laki-laki','perempuan']);
            $table->enum('tempat_dilahirkan',['rs/rb','puskesmas','polindes','rumah','lainnya']);
            $table->string('tempat_lahir',150);
            $table->string('hari',150);
            $table->date('tgl_lahir_bayi');
            $table->string('pukul',50);
            $table->enum('jenis_kelahiran',['tunggal','kembar 2','kembar 3','kembar 4','lainnya']);
            $table->string('kelahiran_ke',2);
            $table->enum('penolong_kelahiran',['dokter','bidan/perawat','dukun','lainnya']);
            $table->string('berat_bayi',10);
            $table->string('panjang_bayi',10);
            $table->string('nik_ibu',16);
            $table->string('nama_ibu',150);
            $table->date('tgl_lahir_ibu');
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
            $table->enum('kewarganegaraan_ibu',['wni','wna']);
            $table->string('kebangsaan_ibu',150);
            $table->date('tgl_pencatatan_perkawinan');
            $table->string('nik_ayah',16);
            $table->string('nama_ayah',150);
            $table->date('tgl_lahir_ayah');
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
            $table->enum('kewarganegaraan_ayah',['wni','wna']);
            $table->string('kebangsaan_ayah',150);
            $table->string('nik_pelapor',16);
            $table->string('nama_pelapor',150);
            $table->string('umur_pelapor',3);
            $table->enum('jk_pelapor',['laki-laki','perempuan']);
            $table->string('pekerjaan_id_pelapor',50);
            $table->foreign('pekerjaan_id_pelapor')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_pelapor');
            $table->string('provinsi_id_pelapor',50);
            $table->foreign('provinsi_id_pelapor')->references('id')->on('ds_provinsi');
            $table->string('kota_id_pelapor',50);
            $table->foreign('kota_id_pelapor')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_pelapor',50);
            $table->foreign('kecamatan_id_pelapor')->references('id')->on('ds_kecamatan');
            $table->string('area_id_pelapor',50);
            $table->foreign('area_id_pelapor')->references('id')->on('ds_desa');
            $table->string('nik_saksi1',16);
            $table->string('nama_saksi1',150);
            $table->string('umur_saksi1',3);
            $table->string('pekerjaan_id_saksi1',50);
            $table->foreign('pekerjaan_id_saksi1')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_saksi1');
            $table->string('provinsi_id_saksi1',50);
            $table->foreign('provinsi_id_saksi1')->references('id')->on('ds_provinsi');
            $table->string('kota_id_saksi1',50);
            $table->foreign('kota_id_saksi1')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_saksi1',50);
            $table->foreign('kecamatan_id_saksi1')->references('id')->on('ds_kecamatan');
            $table->string('area_id_saksi1',50);
            $table->foreign('area_id_saksi1')->references('id')->on('ds_desa');
            $table->string('nik_saksi2',16);
            $table->string('nama_saksi2',150);
            $table->string('umur_saksi2',3);
            $table->string('pekerjaan_id_saksi2',50);
            $table->foreign('pekerjaan_id_saksi2')->references('id')->on('ds_pekerjaan');
            $table->text('alamat_saksi2');
            $table->string('provinsi_id_saksi2',50);
            $table->foreign('provinsi_id_saksi2')->references('id')->on('ds_provinsi');
            $table->string('kota_id_saksi2',50);
            $table->foreign('kota_id_saksi2')->references('id')->on('ds_kota');
            $table->string('kecamatan_id_saksi2',50);
            $table->foreign('kecamatan_id_saksi2')->references('id')->on('ds_kecamatan');
            $table->string('area_id_saksi2',50);
            $table->foreign('area_id_saksi2')->references('id')->on('ds_desa');
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
        Schema::dropIfExists('ds_sk_kelahiran');
    }
}
