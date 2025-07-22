<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Modul extends Model
{
    use HashId;

    protected $table = 'ds_modules';
    protected $guarded = [];
    public $incrementing = false;

    public function menus()
    {
        return $this->hasMany(Menu::class, 'menu_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'id');
    }
}
