<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class PotensiList extends Model
{
  use HashId;

  protected $table = 'ds_potensi_list';
  protected $guarded = [];

  public function noImg()
  {
      return empty($this->img)?true:false;
  }

  public function kategori(){
      return $this->belongsTo(PotensiKategori::class,'kategori_id','id');
  }
  
}
