<?php

namespace App\Http\Controllers\Backend\Kontak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuTamu;
use Session;

class PesanController extends Controller
{
    public function index()
    {
      try{
          $data['pesan'] = BukuTamu::where('desa_id',Session::get('desa_id'))->get();
          return view('backend.kontak.pesan.list',$data);
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
    }
    public function detail($id)
    {
      try{
        $id = $this->decodeHash($id);
        $data['pesan'] = BukuTamu::find($id)->first();
        return view('backend.kontak.pesan.detail',$data);
      }catch(\QueryBuilder $e){
        toastr()->error($e->getMessage(),'Gagal');
        return back();
      }
    }
}
