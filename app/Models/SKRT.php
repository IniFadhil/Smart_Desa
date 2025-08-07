<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKRT extends Model
{
    use HashId;

    protected $table = 'ds_sk_riwayat_tanah';
    protected $guarded = [];
    public $incrementing = false;

    public function desa(){
        return $this->belongsTo(Desa::class,'desa_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
