<?php

namespace App\Http\Controllers\Backend\Pemdes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;

use Str;
use Auth;
use Session;

class StrukturController extends Controller
{
  function __construct()
  {
      $this->middleware('permissions:struktur_organisasi');
  }

  public function index()
  {
      try{
          $data['data'] = StrukturOrganisasi::where('desa_id',Session::get('desa_id'))->first();
          return view('backend.pemerintah.struktur.index',$data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function update(Request $request)
  {
      try{

          $var = StrukturOrganisasi::where('desa_id',Session::get('desa_id'))->first();

          $rules = [
              'title' => 'required',
              'description' => 'required',
              //'img' => 'mimes:jpg,jpeg,png',
          ];

          $messages = [
              'required' => ':attribute tidak boleh kosong',
              'mimes' => 'Format :attribute tidak sesuai',
              'max' => ':attribute maksimal :max kb',
              'unique' => ':attribute sudah digunakan'
          ];

          $label = [
            'title' => 'Judul',
            'description' => 'Deskripsi',
            'img' => 'Gambar Struktur Organisasi',
          ];

          if($request->file('img')){
              if(!empty($var)){
                  if(\File::exists('backend/images/struktur-organisasi/'.$var->img)){
                      \File::delete('backend/images/struktur-organisasi/'.$var->img);
                  }
              }
              $img = $request->file('img');
              $destinationPath = public_path('backend/images/struktur-organisasi');
              $gambar = 'desa_'.date('YmdHis').'.' .$img->getClientOriginalExtension();
              $img->move($destinationPath,$gambar);
          }else{
              if(!empty($var->img))
              {
                  $gambar = $var->img;
              }else{
                  $gambar = null;
              }
          }

          $this->validate($request,$rules,$messages,$label);

          $data = [
              'id' => $this->generateAutoNumber('ds_struktur_organisasi'),
              'desa_id' => Session::get('desa_id'),
              'title' => $request->title,
              'description' => $request->description,
              'slug' => Str::slug($request->input('title')),
              'updated_by' => Auth::user()->name,
              'img' => $gambar,
          ];

          if(!empty($var))
          {
              //update
              $update = StrukturOrganisasi::where('desa_id',Session::get('desa_id'))->update($data);
          }else{
              //insert
              $create = StrukturOrganisasi::create($data);
          }

          toastr()->success('Data Berhasil diubah','Sukses');
          return redirect()->route('backend.pemdes.struktur');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

}
