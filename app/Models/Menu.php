<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;
use App\Models\Modul; // <--- 1. TAMBAHKAN BARIS INI

class Menu extends Model
{
    use HashId;

    protected $table = 'ds_menus';
    protected $guarded = [];
    public $incrementing = false;

    /**
     * Memberitahu Eloquent bahwa tipe data primary key adalah string.
     */
    protected $keyType = 'string';

    /**
     * Relasi ke tabel permissions (ini sudah benar).
     * Satu menu bisa memiliki banyak baris permission.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'id');
    }

    /**
     * 2. TAMBAHKAN METHOD RELASI INI
     * Mendefinisikan bahwa sebuah Menu 'milik' satu Modul.
     */
    public function modul()
    {
        // 'modul_id' adalah foreign key di tabel 'ds_menus' yang merujuk ke tabel 'moduls'
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}
