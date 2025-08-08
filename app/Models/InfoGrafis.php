<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class InfoGrafis extends Model
{
    use HashId;

    protected $table = 'ds_infografis';
    public $incrementing = false;
    protected $guarded = [];

    public function noImg()
    {
        return empty($this->img)?true:false;
    }
}
