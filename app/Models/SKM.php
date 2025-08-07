<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKM extends Model
{
    use HashId;

    protected $table = 'ds_sk_kematian';
    protected $guarded = [];
    public $incrementing = false;

    public function desa(){
        return $this->belongsTo(Desa::class,'desa_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function provinsiJenazah(){
        return $this->belongsTo(Provinsi::class,'provinsi_id_jenazah','id');
    }

    public function kotaJenazah(){
        return $this->belongsTo(Kota::class,'kota_id_jenazah','id');
    }

    public function kecamatanJenazah(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_jenazah','id');
    }

    public function areaJenazah(){
        return $this->belongsTo(Desa::class,'area_id_jenazah','id');
    }

    public function pekerjaanJenazah(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_jenazah','id');
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

    public function pekerjaanPelapor(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id_pelapor','id');
    }

}
