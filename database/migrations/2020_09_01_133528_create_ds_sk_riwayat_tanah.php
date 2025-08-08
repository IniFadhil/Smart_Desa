<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsSkRiwayatTanah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_sk_riwayat_tanah', function (Blueprint $table) {
            $table->string('id',50);
            $table->string('no_surat',150)->nullable();
            $table->string('no_sertifikat',150)->nullable();
            $table->string('desa_id',50);
            $table->foreign('desa_id')->references('id')->on('ds_desa');
            $table->string('user_id',50);
            $table->foreign('user_id')->references('id')->on('ds_users');
            $table->string('nama_pemilik',150);
            $table->string('nik_pemilik',16);
            $table->date('tgl_riwayat1');
            $table->string('atas_nama1',150);
            $table->date('tgl_riwayat2');
            $table->string('atas_nama2',150);
            $table->enum('berdasarkan2',['jual beli','hibah','waris']);
            $table->date('tgl_riwayat3');
            $table->string('atas_nama3',150);
            $table->enum('berdasarkan3',['jual beli','hibah','waris']);
            $table->date('tgl_riwayat4');
            $table->string('atas_nama4',150);
            $table->enum('berdasarkan4',['jual beli','hibah','waris']);
            $table->string('no_sppt',150);
            $table->string('blok',150);
            $table->string('persil',150);
            $table->string('no_kihir',150);
            $table->string('luas',150);
            $table->text('alamat');
            $table->string('sebelah_utara',150);
            $table->string('sebelah_timur',150);
            $table->string('sebelah_selatan',150);
            $table->string('sebelah_barat',150);
            $table->string('nama_saksi1',150);
            $table->string('nik_saksi1',16);
            $table->string('nama_saksi2',150);
            $table->string('nik_saksi2',16);
            $table->enum('verifikasi_kasi',[1,0])->default(0);
            $table->enum('verifikasi_sekdes',[1,0])->default(0);
            $table->enum('verifikasi_kades',[1,0])->default(0);
            $table->enum('status',['1','0'])->default('1');
            $table->string('no_hp');
            $table->string('file_surat_tanah');
            $table->string('file_surat_pajak_tanah');
            $table->string('file_kk');
            $table->string('file_ktp');
            $table->string('file_rtrw');
            $table->string('file_surat_pernyataan');
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
        Schema::dropIfExists('ds_sk_riwayat_tanah');
    }
}
