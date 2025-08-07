<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'ds_permissions';
    protected $guarded = [];

    /**
     * Satu permission terhubung ke satu modul.
     */
    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id', 'id');
    }

    /**
     * Satu permission terhubung ke satu menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
