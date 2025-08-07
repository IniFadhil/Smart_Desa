<?php

namespace App\Http\Controllers\Backend\BUMDES;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BumdesProduk;
use App\Models\BumdesProfil;
use Str;
use Auth;
use Session;

class ProdukController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:produk');
    }

    public function index()
    {
        try{
            $data['produk'] = BumdesProduk::where('desa_id',Session::get('desa_id'))->get();
            return view('backend.bumdes.produk.list', $data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['bumdes'] = BumdesProfil::where('desa_id',Session::get('desa_id'))->get();
            return view('backend.bumdes.produk.create', $data);
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
            $data['id'] = $this->generateAutoNumber('ds_bumdes_produk');
            $data['created_by'] = Auth::user()->name;
            $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;

            $produk = BumdesProduk::create($data);
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.bumdes.produk');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['bumdes'] = BumdesProfil::where('desa_id',Session::get('desa_id'))->get();
            $data['produk'] = BumdesProduk::find($id);
            return view('backend.bumdes.produk.edit',$data);
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
            $produk = BumdesProduk::find($id);
            $produk->update($data);
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.bumdes.produk.detail',['id'=>$produk->encodeHash($produk->id)]);
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function detail($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['produk'] = BumdesProduk::find($id);
            return view('backend.bumdes.produk.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function active(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $produk = BumdesProduk::find($id);
            $produk->update(['status' => 'show']);
            toastr()->success('Data Berhasil diaktifkan','Sukses');
            return redirect()->route('backend.bumdes.produk');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function inactive(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $produk = BumdesProduk::find($id);
            $produk->update(['status' => 'hide']);
            toastr()->success('Data Berhasil dinonaktifkan','Sukses');
            return redirect()->route('backend.bumdes.produk');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {
        if(!empty($request->id)){
            $produk = BumdesProduk::find($request->id);
            if($produk->noImg()){
                $rules = ['img' => 'mimes:png,jpg,jpeg|max:2048'];
            }
        }

        $rules = [
            'bumdes_id' => 'required',
            'name' => 'required|max:191|unique:ds_bumdes_produk,name,'.$request->id,
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
            'bumdes_id' => 'BUMDES',
            'name' => 'Produk BUMDES',
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
            $produk = BumdesProduk::find($request->id);
        }

        if($request->file('img')){
            if(!empty($request->id)){
                $produk = BumdesProduk::find($request->id);
                if(\File::exists('backend/images/bumdes/produk/'.$produk->img)){
                    \File::delete('backend/images/bumdes/produk/'.$produk->img);
                }
            }
            $image = $request->file('img');
            $destinationPath = public_path('backend/images/bumdes/produk');
            $namaImg = strtolower(str_replace(' ','_',$request->name)).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath,$namaImg);
        }else{
            if($request->id){
                $namaImg=$produk->img;
            }else{
                $namaImg = null;
            }
        }

        $data = [
            'bumdes_id' => $request->input('bumdes_id'),
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
