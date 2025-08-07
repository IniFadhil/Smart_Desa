<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class ProfilDesa extends Model
{
    use HashId;

    protected $table = 'ds_profil_desa';
    protected $guarded = [];
    public $incrementing = false;

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id', 'id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}