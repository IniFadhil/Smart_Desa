<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Role extends Model
{
    use HashId;

    protected $table = 'ds_roles';
    protected $guarded = [];
    public $incrementing = false;

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id', 'id');
    }
}
