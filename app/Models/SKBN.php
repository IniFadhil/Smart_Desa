<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKBN extends Model
{
    use HashId;

    protected $table = 'ds_sk_beda_nama';
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

    public function skbnDetail(){
        return $this->hasMany(SKBNDetail::class,'skbn_id','id');
    }
}
