<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Website extends Model
{
    use HashId;

    protected $table = 'ds_website';
    protected $guarded = [];

    public function NoFavicon()
    {
        return empty($this->favicon) ? true : false;
    }
}