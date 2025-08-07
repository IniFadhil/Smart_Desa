<?php

namespace App\Http\Controllers\Backend\Potensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PotensiKategori;
use Str;
use Auth;
use Session;

class KategoriController extends Controller
{
  function __construct()
  {
      $this->middleware('permissions:kategori-potensi');
  }

  public function index()
  {
      try{
          $data['kategori'] = PotensiKategori::where('desa_id',Session::get('desa_id'))->get();
          return view('backend.potensi.kategori.list', $data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function create()
  {
      try{
          return view('backend.potensi.kategori.create');
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
          $data['id'] = $this->generateAutoNumber('ds_potensi_kategori');
          $data['created_by'] = Auth::user()->name;
          $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;

          $potensi = PotensiKategori::create($data);
          toastr()->success('Data Berhasil Ditambahkan','Sukses');
          return redirect()->route('backend.potensi.kategori');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function edit($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['kategori'] = PotensiKategori::find($id);
          return view('backend.potensi.kategori.edit',$data);
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
          $kategori = PotensiKategori::find($id);
          $kategori->update($data);
          toastr()->success('Data Berhasil Diubah','Sukses');
          return redirect()->route('backend.potensi.kategori.detail',['id'=>$kategori->encodeHash($kategori->id)]);
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function detail($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['kategori'] = PotensiKategori::find($id);
          return view('backend.potensi.kategori.detail',$data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function active(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $kategori = PotensiKategori::find($id);
          $kategori->update(['status' => 'show']);
          toastr()->success('Data Berhasil diaktifkan','Sukses');
          return redirect()->route('backend.potensi.kategori');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function inactive(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $kategori = PotensiKategori::find($id);
          $kategori->update(['status' => 'hide']);
          toastr()->success('Data Berhasil dinonaktifkan','Sukses');
          return redirect()->route('backend.potensi.kategori');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  private function validasiForm($request)
  {
      $rules = [
          'name' => 'required|max:191|unique:ds_potensi_kategori,name,'.$request->id,
          'short_description' => 'required|max:150',
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
          'name' => 'Nama Kategori',
          'short_description' => 'Deskripsi Singkat',
          'description' => 'Deskripsi',
          'status' => 'Status',
      ];

      $this->validate($request,$rules,$messages,$label);
  }

  public function bindData($request)
  {
      if(!empty($request->id)){
          $kategori = PotensiKategori::find($request->id);
      }

      $data = [
          'name' => $request->input('name'),
          'slug' => Str::slug($request->input('name')),
          'short_description' => $request->input('short_description'),
          'description' => $request->input('description'),
          'status' => $request->input('status'),
      ];

      return $data;
  }
}
