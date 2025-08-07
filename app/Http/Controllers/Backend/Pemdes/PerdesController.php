<?php

namespace App\Http\Controllers\Backend\Pemdes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;

use Str;
use Auth;
use Session;

class PerdesController extends Controller
{
  function __construct()
  {
      $this->middleware('permissions:perangkat_desa');
  }
  private function validasiForm($request)
  {
      if(!empty($request->id)){
          $pegawai = PerangkatDesa::find($request->id);
          if($pegawai->noImg()){
              $rules = ['img' => 'mimes:png,jpg,jpeg|max:2048'];
          }
      }
      $rules = [
          'name' => 'required',
          'nip' => 'required|max:150',
          'birth_place' => 'required',
          'birth_date' => 'required',
          'phone' => 'required',
          'address' => 'required',
          'position' => 'required',
          'golongan' => 'required',
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
          'name' => 'Nama Pegawai',
          'nip' => 'NIP Pegawai',
          'birth_place' => 'Tempat Lahir',
          'birth_date' => 'Tanggal Lahir',
          'phone' => 'Telepon',
          'address' => 'Alamat',
          'position' => 'Jabatan',
          'golongan' => 'Golongan',
          'img' => 'Foto',
          'status' => 'Status',
      ];
      $this->validate($request,$rules,$messages,$label);
  }

  public function bindData($request)
  {
      if(!empty($request->id)){
          $pegawai = PerangkatDesa::find($request->id);
      }
      if($request->file('img')){
          if(!empty($request->id)){
              $pegawai = PerangkatDesa::find($request->id);
              if(\File::exists('backend/images/pegawai/'.$pegawai->img)){
                  \File::delete('backend/images/pegawai/'.$pegawai->img);
              }
          }
          $image = $request->file('img');
          $destinationPath = public_path('backend/images/pegawai/');
          $namaImg = strtolower(str_replace(' ','_',$request->name)).'.'.$image->getClientOriginalExtension();
          $image->move($destinationPath,$namaImg);
      }else{
          if($request->id){
              $namaImg=$pegawai->img;
          }else{
              $namaImg = null;
          }
      }
      $data = [
        'name' => $request->input('name'),
        'nip' => $request->input('nip'),
        'birth_place' => $request->input('birth_place'),
        'birth_date' => $request->input('birth_date'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'position' => $request->input('position'),
        'golongan' => $request->input('golongan'),
        'img' => $namaImg,
        'status' => $request->input('status'),
      ];
      return $data;
  }

  public function index(){
    try{
      $data['perangkat'] = PerangkatDesa::where('desa_id',Session::get('desa_id'))->get();
      return view('backend.pemerintah.perangkat.list', $data);
    }catch(\Exception $e){
      toastr()->error($e->getMessage(),'Gagal');
      return back();
    }
  }

  public function create(){
    try{
        return view('backend.pemerintah.perangkat.create');
    }catch(\Exception $e){
        toastr()->error($e->getMessage(),'Gagal');
        return back();
    }
  }

  public function createProccess(Request $request){
    try{
        $this->validasiForm($request);
        $data = $this->bindData($request);
        $data['id'] = $this->generateAutoNumber('ds_perangkat_desa');
        $data['created_by'] = Auth::user()->name;
        $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;

        $pegawai = PerangkatDesa::create($data);
        toastr()->success('Data Berhasil Ditambahkan','Sukses');
        return redirect()->route('backend.pemdes.perdes');
    }catch(\QueryBuilder $e){
        toastr()->error($e->getMessage(),'Gagal');
        return back();
    }
  }

  public function edit($id){
    try{
        $id = $this->decodeHash($id);
        $data['pegawai'] = PerangkatDesa::find($id);
        return view('backend.pemerintah.perangkat.edit',$data);
    }catch(\Exception $e){
        toastr()->error($e->getMessage(),'Gagal');
        return back();
    }
  }

  public function editProccess(Request $request,$id){
    try{
        $id = $this->decodeHash($id);
        $request['id'] = $id;
        $this->validasiForm($request);
        $data = $this->bindData($request);
        $data['updated_by'] = Auth::user()->name;
        $pegawai = PerangkatDesa::find($id);
        $pegawai->update($data);
        toastr()->success('Data Berhasil Diubah','Sukses');
        return redirect()->route('backend.pemdes.perdes.detail',['id'=>$pegawai->encodeHash($pegawai->id)]);
    }catch(\QueryBuilder $e){
        toastr()->error($e->getMessage(),'Gagal');
        return back();
    }
  }

  public function detail($id){
      try{
          $id = $this->decodeHash($id);
          $data['pegawai'] = PerangkatDesa::find($id);
          return view('backend.pemerintah.perangkat.detail',$data);
      }catch(\Exception $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function active(Request $request){
      try{
          $id = $this->decodeHash($request->id);
          $pegawai = PerangkatDesa::find($id);
          $pegawai->update(['status' => 'show']);
          toastr()->success('Data Berhasil diaktifkan','Sukses');
          return redirect()->route('backend.pemdes.perdes');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

  public function inactive(Request $request){
      try{
          $id = $this->decodeHash($request->id);
          $pegawai = PerangkatDesa::find($id);
          $pegawai->update(['status' => 'hide']);
          toastr()->success('Data Berhasil dinonaktifkan','Sukses');
          return redirect()->route('backend.pemdes.perdes');
      }catch(\QueryBuilder $e){
          toastr()->error($e->getMessage(),'Gagal');
          return back();
      }
  }

}
