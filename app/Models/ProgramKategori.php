<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class ProgramKategori extends Model
{
  use HashId;

  protected $table = 'ds_program_kategori';
  protected $guarded = [];

  public function noImg()
  {
      return empty($this->img)?true:false;
  }

  public function desa(){
      return $this->belongsTo(Desa::class,'desa_id','id');
  }

  public function program(){
      return $this->hasMany(ProgramList::class,'kategori_id','id');
  }

  public function getRouteKeyName(){
      return 'slug';
  }
}
