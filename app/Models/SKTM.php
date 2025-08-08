<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKTM extends Model
{
    use HashId;

    protected $table = 'ds_sktm';
    protected $guarded = [];
    public $incrementing = false;

    public function desa(){
        return $this->belongsTo(Desa::class,'desa_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function kota(){
        return $this->belongsTo(Kota::class,'kota_id','id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id','id');
    }

    public function area(){
        return $this->belongsTo(Desa::class,'area_id','id');
    }

    public function kotaOrtu(){
        return $this->belongsTo(Kota::class,'kota_id_orangtua','id');
    }

    public function kecOrtu(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id_orangtua','id');
    }

    public function areaOrtu(){
        return $this->belongsTo(Desa::class,'area_id_orangtua','id');
    }
}
