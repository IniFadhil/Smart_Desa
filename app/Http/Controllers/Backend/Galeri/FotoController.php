<?php

namespace App\Http\Controllers\Backend\Galeri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foto;
use Str;
use Auth;
use Session;

class FotoController extends Controller{

  public function __construct(){
    $this->middleware('permissions:foto');
  }

  public function index(){
    try{
      $data['fotos'] = Foto::where('desa_id',Session::get('desa_id'))->get();
      return view('backend.galeri.foto.list', $data);
    }catch(\Exception $e){
      toastr()->error($e->getMessage(),'Gagal');
      return back();
    }
  }

  public function create()
  {
      try{
          return view('backend.galeri.foto.create');
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }
  public function createProccess(Request $request)
  {
      try{
          $this->validasiForm($request);
          $data = $this->bindData($request);
          $data['id'] = $this->generateAutoNumber('ds_foto');
          $data['created_by'] = Auth::user()->name;
          $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;
          $foto = Foto::create($data);
          toastr()->success('Data Berhasil Ditambahkan','Sukses');
          // return redirect()->route('backend.galeri.foto.detail',['id'=>$foto->encodeHash($foto->id)]);
          return redirect()->route('backend.galeri.foto');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function edit($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['foto'] = Foto::find($id);
          return view('backend.galeri.foto.edit',$data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }
  public function editProccess(Request $request,$id)
  {
      try{
          $id = $this->decodeHash($id);
          $request['id'] = $id;
          $this->validasiForm($request);
          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;
          $foto = Foto::find($id);
          $foto->update($data);
          toastr()->success('Data Berhasil Diubah','Sukses');
          return redirect()->route('backend.galeri.foto.detail',['id'=>$foto->encodeHash($foto->id)]);
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function detail($id){
    try{
      $id = $this->decodeHash($id);
      $data['foto'] = Foto::find($id);
      return view('backend.galeri.foto.detail',$data);
    }catch(\Exception $e){
      toastr()->error($e->getMessage(),'Gagal');
      return back();
    }
  }

  public function active(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $foto = Foto::find($id);
          $foto->update(['status' => 'show']);
          toastr()->success('Data Berhasil diaktifkan','Sukses');
          return redirect()->route('backend.galeri.foto');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function inactive(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $foto = Foto::find($id);
          $foto->update(['status' => 'hide']);
          toastr()->success('Data Berhasil dinonaktifkan','Sukses');
          return redirect()->route('backend.galeri.foto');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  private function validasiForm($request)
  {
      if(!empty($request->id)){
          $foto = Foto::find($request->id);
          if($foto->noImg()){
              $rules = ['img' => 'mimes:png,jpg,jpeg|max:2048'];
          }
      }

      $rules = [
          'title' => 'required|max:191|unique:ds_infografis,title,'.$request->id,
          'description' => 'required',
          'img' => 'mimes:png,jpeg,jpg',
          'status' => 'required',
      ];

      $messages = [
          'required' => ':attribute tidak boleh kosong',
          'mimes' => 'Format :attribute tidak sesuai',
          'max' => ':attribute maksimal :max karakter/kb',
          'unique' => ':attribute sudah digunakan'
      ];

      $label = [
          'title' => 'Judul',
          'description' => 'Deksripsi',
          'img' => 'Foto',
          'status' => 'Status',
      ];

      $this->validate($request,$rules,$messages,$label);
  }

  public function bindData($request)
  {
      if(!empty($request->id)){
          $foto = Foto::find($request->id);
      }

      if($request->file('img')){
          if(!empty($request->id)){
              $foto = Foto::find($request->id);
              if(\File::exists('backend/images/galeri/foto/'.$foto->img)){
                  \File::delete('backend/images/galeri/foto/'.$foto->img);
              }
          }
          $image = $request->file('img');
          $destinationPath = public_path('backend/images/galeri/foto');
          $name = strtolower(str_replace(' ','_',$request->title)).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath,$name);
      }else{
          if($request->id){
              $name=$foto->img;
          }else{
              $name = null;
          }
      }

      $data = [
          'title' => $request->input('title'),
          'slug' => Str::slug($request->input('title')),
          'description' => $request->input('description'),
          'status' => $request->input('status'),
          'img' => $name,
      ];

      return $data;
  }


}
