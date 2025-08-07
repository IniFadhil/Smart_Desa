<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKAWPasangan extends Model
{
    use HashId;

    protected $table = 'ds_skaw_pasangan';
    protected $guarded = [];
    public $incrementing = false;

    public function partner()
    {
        return $this->belongsTo(SKAW::class,'skaw_id','id');
    }

    public function pekerjaan(){
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id','id');
    }
}
