<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Kota extends Model
{
    use HashId;

    protected $table = 'ds_kota';
    protected $guarded = [];
    public $incrementing = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
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
