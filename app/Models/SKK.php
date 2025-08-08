<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKK extends Model
{
    use HashId;

    protected $table = 'ds_sk_kelahiran';
    protected $guarded = [];
    public $incrementing = false;

    public function desa(){
        return $this->belongsTo(Desa::class,'desa_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function provinsiIbu(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_ibu','id');
    }

    public function kotaIbu(){
        return $this->belongsTo(Kota::class,'kota_id_ibu','id');
    }

    public function kecamatanIbu(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_ibu','id');
    }

    public function areaIbu(){
        return $this->belongsTo(Desa::class,'area_id_ibu','id');
    }

    public function pekerjaanIbu(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_ibu','id');
    }

    public function provinsiAyah(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_ayah','id');
    }
    public function KotaAyah(){
        return $this->belongsTo(Kota::class,'kota_id_ayah','id');
    }

    public function kecamatanAyah(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_ayah','id');
    }

    public function areaAyah(){
        return $this->belongsTo(Desa::class,'area_id_ayah','id');
    }

    public function pekerjaanAyah(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_ayah','id');
    }

    public function provinsiPelapor(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_pelapor','id');
    }
    public function KotaPelapor(){
        return $this->belongsTo(Kota::class,'kota_id_pelapor','id');
    }

    public function kecamatanPelapor(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_pelapor','id');
    }

    public function areaPelapor(){
        return $this->belongsTo(Desa::class,'area_id_pelapor','id');
    }

    public function pekerjaanPelapor(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_pelapor','id');
    }
    public function provinsiSaksi1(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_saksi1','id');
    }
    public function KotaSaksi1(){
        return $this->belongsTo(Kota::class,'kota_id_saksi1','id');
    }

    public function kecamatanSaksi1(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_saksi1','id');
    }

    public function areaSaksi1(){
        return $this->belongsTo(Desa::class,'area_id_saksi1','id');
    }

    public function pekerjaanSaksi1(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_saksi1','id');
    }
    public function provinsiSaksi2(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_saksi2','id');
    }
    public function KotaSaksi2(){
        return $this->belongsTo(Kota::class,'kota_id_saksi2','id');
    }

    public function kecamatanSaksi2(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_saksi2','id');
    }

    public function areaSaksi2(){
        return $this->belongsTo(Desa::class,'area_id_saksi2','id');
    }

    public function pekerjaanSaksi2(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_saksi2','id');
    }
}
