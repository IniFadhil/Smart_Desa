<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Agenda extends Model
{
    use HashId;

    protected $table = 'ds_agenda';
    public $incrementing = false;
    protected $guarded = [];

    public function noImg()
    {
        return empty($this->img) ? true : false;
    }
}
