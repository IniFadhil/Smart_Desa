<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Slider extends Model
{
    use HashId;
    protected $table = 'ds_slider';
    public $incrementing = false;
    protected $guarded = [];
}
