<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKP extends Model
{
    use HashId;

    protected $table = 'ds_sk_penghasilan';
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

    public function pekerjaan(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id','id');
    }
}
