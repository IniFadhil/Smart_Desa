<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Provinsi extends Model
{
    use HashId;

    protected $table = 'ds_provinsi';
    protected $guarded = [];
    public $incrementing = false;

    public function kota()
    {
        return $this->hasMany(Kota::class, 'kota_id', 'id');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function area()
    {
        return $this->hasMany(Desa::class, 'area_id', 'id');
    }
}
