<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class BumdesProfil extends Model
{
  use HashId;

  protected $table = 'ds_bumdes_profil';
  protected $guarded = [];

  public function noImg()
  {
      return empty($this->img)?true:false;
  }

  public function desa(){
      return $this->belongsTo(Desa::class,'desa_id','id');
  }
}
