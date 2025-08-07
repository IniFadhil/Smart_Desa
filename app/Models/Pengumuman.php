<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Pengumuman extends Model
{
    use HashId;

    protected $table = 'ds_pengumuman';
    public $incrementing = false;
    protected $guarded = [];

    public function noImg()
    {
        return empty($this->img)?true:false;
    }

    public function noFile()
    {
        return empty($this->file)?true:false;
    }
}
