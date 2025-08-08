<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class BumdesProduk extends Model
{
  use HashId;

  protected $table = 'ds_bumdes_produk';
  protected $guarded = [];

  public function noImg()
  {
      return empty($this->img)?true:false;
  }

  public function bumdes(){
      return $this->belongsTo(BumdesProfil::class,'bumdes_id','id');
  }
}
