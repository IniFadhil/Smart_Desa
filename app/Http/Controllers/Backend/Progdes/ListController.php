<?php

namespace App\Http\Controllers\Backend\Progdes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramList;
use App\Models\ProgramKategori;
use Str;
use Session;
use Auth;

class ListController extends Controller
{
  function __construct()
  {
      $this->middleware('permissions:kegiatan');
  }

  public function index()
  {
      try{
          $data['program'] = ProgramList::where('desa_id',Session::get('desa_id'))->get();
          return view('backend.program.kegiatan.list', $data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function create()
  {
      try{
          $data['kategori'] = ProgramKategori::where('desa_id',Session::get('desa_id'))->get();
          return view('backend.program.kegiatan.create', $data);
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
          $data['id'] = $this->generateAutoNumber('ds_program_list');
          $data['created_by'] = Auth::user()->name;
          $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;

          $program = ProgramList::create($data);
          toastr()->success('Data Berhasil Ditambahkan','Sukses');
          return redirect()->route('backend.program.kegiatan');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function edit($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['kategori'] = ProgramKategori::where('desa_id',Session::get('desa_id'))->get();
          $data['program'] = ProgramList::find($id);
          return view('backend.program.kegiatan.edit',$data);
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
          $program = ProgramList::find($id);
          $program->update($data);
          toastr()->success('Data Berhasil Diubah','Sukses');
          return redirect()->route('backend.program.kegiatan.detail',['id'=>$program->encodeHash($program->id)]);
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function detail($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['program'] = ProgramList::find($id);
          return view('backend.program.kegiatan.detail',$data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function active(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $program = ProgramList::find($id);
          $program->update(['status' => 'show']);
          toastr()->success('Data Berhasil diaktifkan','Sukses');
          return redirect()->route('backend.program.kegiatan');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function inactive(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $program = ProgramList::find($id);
          $program->update(['status' => 'hide']);
          toastr()->success('Data Berhasil dinonaktifkan','Sukses');
          return redirect()->route('backend.program.kegiatan');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  private function validasiForm($request)
  {
      if(!empty($request->id)){
          $program = ProgramList::find($request->id);
          if($program->noImg()){
              $rules = ['img' => 'mimes:png,jpg,jpeg|max:2048'];
          }
      }

      $rules = [
          'kategori_id' => 'required',
          'name' => 'required|max:191|unique:ds_program_list,name,'.$request->id,
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
          'kategori_id' => 'Kategori',
          'name' => 'Program Kegiatan',
          'short_description' => 'Deskripsi Singkat',
          'description' => 'Deskripsi',
          'img' => 'Foto',
          'status' => 'Status',
      ];

      $this->validate($request,$rules,$messages,$label);
  }

  public function bindData($request)
  {
      if(!empty($request->id)){
          $program = ProgramList::find($request->id);
      }

      if($request->file('img')){
          if(!empty($request->id)){
              $program = ProgramList::find($request->id);
              if(\File::exists('backend/images/program/'.$program->img)){
                  \File::delete('backend/images/program/'.$program->img);
              }
          }
          $image = $request->file('img');
          $destinationPath = public_path('backend/images/program');
          $namaImg = strtolower(str_replace(' ','_',$request->name)).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath,$namaImg);
      }else{
          if($request->id){
              $namaImg=$program->img;
          }else{
              $namaImg = null;
          }
      }

      $data = [
          'kategori_id' => $request->input('kategori_id'),
          'name' => $request->input('name'),
          'slug' => Str::slug($request->input('name')),
          'short_description' => $request->input('short_description'),
          'description' => $request->input('description'),
          'status' => $request->input('status'),
          'img' => $namaImg,
      ];

      return $data;
  }
}
