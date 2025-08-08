<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Download;
use Str;
use Auth;
use Session;

class DownloadController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:download');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['download'] = Download::all();
            }else{
                $data['download'] = Download::where('desa_id',current_user('admin')->desa_id)->get();
            }
            return view('backend.dokumen.download.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            return view('backend.dokumen.download.create');
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
            $data['id'] = $this->generateAutoNumber('ds_download');
            $data['created_by'] = current_user('admin')->name;
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $download = Download::create($data);
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.download.detail',['id'=>$download->encodeHash($download->id)]);
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['download'] = Download::find($id);
            return view('backend.dokumen.download.edit',$data);
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
            $data['updated_by'] = current_user('admin')->name;
            $download = Download::find($id);
            $download->update($data);
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.download.detail',['id'=>$download->encodeHash($download->id)]);
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function detail($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['download'] = Download::find($id);
            return view('backend.dokumen.download.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    public function active(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $download = Download::find($id);
            $download->update(['status' => 'show']);
            toastr()->success('Data Berhasil diaktifkan','Sukses');
            return redirect()->route('backend.dokumen.download');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function inactive(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $download = Download::find($id);
            $download->update(['status' => 'hide']);
            toastr()->success('Data Berhasil dinonaktifkan','Sukses');
            return redirect()->route('backend.dokumen.download');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {

        if(!empty($request->id)){
            $download = Download::find($request->id);
            if($download->noFile()){
                $rules = ['file' => 'required|mimes:xlsx,xls,docx,doc,pdf,pptx,ppt'];
            }
        }
        
        if(empty($request->id)){
            $rules = [
                'title' => 'required|max:191|unique:ds_download,title,'.$request->id,
                'description' => 'required',
                'status' => 'required',
                'file' => 'required|mimes:xlsx,xls,docx,doc,pdf,pptx,ppt'
            ];
        }else{
            $rules = [
                'title' => 'required|max:191|unique:ds_download,title,'.$request->id,
                'description' => 'required',
                'status' => 'required'
            ];
        }

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'mimes' => 'Format :attribute tidak sesuai',
            'max' => ':attribute maksimal :max karakter/kb',
            'unique' => ':attribute sudah digunakan'
        ];

        $label = [
            'title' => 'Judul',
            'description' => 'Deskripsi',
            'file' => 'File',
            'status' => 'Status',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $download = Download::find($request->id);
        }

        if($request->file('file')){
            if(!empty($request->id)){
                $download = Download::find($request->id);
                if(\File::exists('backend/files/dokumen/download/'.$download->file)){
                    \File::delete('backend/files/dokumen/download/'.$download->file);
                }
            }
            $file = $request->file('file');
            $destinationPath = public_path('backend/files/dokumen/download');
            $namaFile = strtolower(str_replace(' ','_',$request->title)).'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$namaFile);
        }else{
            if($request->id){
                $namaFile=$download->file;
            }else{
                $namaFile = null;
            }
        }

        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'file' => $namaFile,
        ];

        return $data;
    }
}
