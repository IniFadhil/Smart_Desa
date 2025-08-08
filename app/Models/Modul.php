<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;
use App\Models\Menu; // <-- Pastikan ini ada

class Modul extends Model
{
    use HashId;

    protected $table = 'ds_modules'; // Sesuaikan jika nama tabel Anda berbeda
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * INI ADALAH BAGIAN YANG DIPERBAIKI
     * Mendefinisikan bahwa satu Modul bisa memiliki banyak Menu.
     * Kunci asing di tabel 'ds_menus' adalah 'modul_id'.
     */
    public function menus()
    {
        return $this->hasMany(Menu::class, 'modul_id', 'id');
    }
}
