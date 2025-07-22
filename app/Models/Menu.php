<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Menu extends Model
{
    use HashId;

    protected $table = 'ds_menus';
    protected $guarded = [];
    public $incrementing = false;

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'id');
    }
}
