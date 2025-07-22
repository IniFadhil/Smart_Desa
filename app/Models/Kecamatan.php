<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class Kecamatan extends Model
{
    use HashId;

    protected $table = 'ds_kecamatan';
    protected $guarded = [];
    public $incrementing = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function area()
    {
        return $this->hasMany(Desa::class, 'area_id', 'id');
    }
}
