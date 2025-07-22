<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class AdminRole extends Model
{
    use HashId;

    protected $table = 'ds_admin_roles';
    protected $guarded = [];
}
