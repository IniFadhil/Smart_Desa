<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class SKAWAnak extends Model
{
    use HashId;

    protected $table = 'ds_skaw_anak';
    protected $guarded = [];
    public $incrementing = false;

    public function children()
    {
        return $this->belongsTo(SKAW::class,'skaw_id','id');
    }
    
}
