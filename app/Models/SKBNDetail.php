<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKBNDetail extends Model
{
    use HashId;

    protected $table = 'ds_skbn_detail';
    protected $guarded = [];
    public $incrementing = false;

    public function skbn(){
        return $this->belongsTo(SKBN::class,'skbn_id','id');
    }
}
