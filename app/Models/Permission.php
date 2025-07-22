<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Permission extends Model
{
    use HashId;

    protected $table = 'ds_permissions';
    protected $guarded = [];
    public $incrementing = false;

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
