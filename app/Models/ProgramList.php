<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashId;

class ProgramList extends Model
{
  use HashId;

  protected $table = 'ds_program_list';
  protected $guarded = [];

  public function noImg()
  {
      return empty($this->img)?true:false;
  }

  public function kategori(){
      return $this->belongsTo(ProgramKategori::class,'kategori_id','id');
  }
}
