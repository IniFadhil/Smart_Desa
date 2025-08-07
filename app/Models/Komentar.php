<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Komentar extends Model
{
    use HashId;
    
    protected $table = 'ds_komentar';
    protected $guarded = [];

}
