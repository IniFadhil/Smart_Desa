<?php

namespace App\Http\Controllers\Backend\Galeri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Str;
use Auth;
use Session;

class VideoController extends Controller{

  public function __construct(){
    $this->middleware('permissions:video');
  }

  public function index(){
    try{
      $data['videos'] = Video::where('desa_id',Session::get('desa_id'))->get();
      return view('backend.galeri.video.list', $data);
    }catch(\Exception $e){
      toastr()->error($e->getMessage(),'Gagal');
      return back();
    }
  }

  public function create()
  {
      try{
          return view('backend.galeri.video.create');
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
          $data['id'] = $this->generateAutoNumber('ds_video');
          $data['created_by'] = Auth::user()->name;
          $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;
          $video = Video::create($data);
          toastr()->success('Data Berhasil Ditambahkan','Sukses');
          // return redirect()->route('backend.galeri.video.detail',['id'=>$video->encodeHash($video->id)]);
          return redirect()->route('backend.galeri.video');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function edit($id)
  {
      try{
          $id = $this->decodeHash($id);
          $data['video'] = Video::find($id);
          return view('backend.galeri.video.edit',$data);
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
          $video = Video::find($id);
          $video->update($data);
          toastr()->success('Data Berhasil Diubah','Sukses');
          return redirect()->route('backend.galeri.video.detail',['id'=>$video->encodeHash($video->id)]);
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function detail($id){
    try{
      $id = $this->decodeHash($id);
      $data['video'] = Video::find($id);
      return view('backend.galeri.video.detail',$data);
    }catch(\Exception $e){
      toastr()->error($e->getMessage(),'Gagal');
      return back();
    }
  }

  public function active(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $video = Video::find($id);
          $video->update(['status' => 'show']);
          toastr()->success('Data Berhasil diaktifkan','Sukses');
          return redirect()->route('backend.galeri.video');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function inactive(Request $request)
  {
      try{
          $id = $this->decodeHash($request->id);
          $video = Video::find($id);
          $video->update(['status' => 'hide']);
          toastr()->success('Data Berhasil dinonaktifkan','Sukses');
          return redirect()->route('backend.galeri.video');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  private function validasiForm($request)
  {
      if(!empty($request->id)){
          $video = Video::find($request->id);
          if($video->noImg()){
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
          $video = Video::find($request->id);
      }

      if($request->file('img')){
          if(!empty($request->id)){
              $video = Video::find($request->id);
              if(\File::exists('backend/images/galeri/video/'.$video->img)){
                  \File::delete('backend/images/galeri/video/'.$video->img);
              }
          }
          $image = $request->file('img');
          $destinationPath = public_path('backend/images/galeri/video');
          $name = strtolower(str_replace(' ','_',$request->title)).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath,$name);
      }else{
          if($request->id){
              $name=$video->img;
          }else{
              $name = null;
          }
      }

      $data = [
          'url' => $request->input('url'),
          'title' => $request->input('title'),
          'slug' => Str::slug($request->input('title')),
          'description' => $request->input('description'),
          'status' => $request->input('status'),
          'img' => $name,
      ];

      return $data;
  }

}
