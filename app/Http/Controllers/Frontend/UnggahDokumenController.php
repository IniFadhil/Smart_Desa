<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnggahDokumen;
use App\Models\User;
use App\Actions\UnggahDokumenCreateAction;
use App\Actions\UnggahDokumenUpdateAction;

class UnggahDokumenController extends Controller
{
    public function index()
    {
        $unggah = UnggahDokumen::where('user_id',current_user('masyarakat')->id)->first();
        
        return view('frontend.unggah',\compact('unggah'));
    }

    public function indexWebView()
    {
        $user = User::where('api_token',request()->token)->first();
        if(!$user){
            toastr()->error('User tidak ditemukan','Gagal');
            return back();
        }
        $unggah = UnggahDokumen::where('user_id',$user->id)->first();
        return view('webview.unggah',\compact('unggah','user'));
    }

    public function upload(Request $request)
    {
        $user = User::where('api_token',request()->token)->first();
        if($user){
            $unggah = UnggahDokumen::where('user_id',$user->id)->first();
        }else{
            $unggah = UnggahDokumen::where('user_id',current_user('masyarakat')->id)->first();
        }
        

        $validate = $this->validationForm($request,$unggah);
        
        if($request->file('file_ktp')){
            if(!empty($unggah->file_ktp)){
                if(\File::exists('storage/backend/images/uploads/'.$unggah->file_ktp)){
                    \File::delete('storage/backend/images/uploads/'.$unggah->file_ktp);
                }
            }
            $nama_ktp = \Str::uuid().'.'.$request->file_ktp->getClientOriginalExtension();
        }else{
            $nama_ktp = $unggah->file_ktp;
        }

        if($request->file('file_kk')){
            if(!empty($unggah->file_kk)){
                if(\File::exists('storage/backend/images/uploads/'.$unggah->file_kk)){
                    \File::delete('storage/backend/images/uploads/'.$unggah->file_kk);
                }
            }
            $nama_kk = \Str::uuid().'.'.$request->file_kk->getClientOriginalExtension();
        }else{
            $nama_kk = $unggah->file_kk;
        }

        $data = [
            'id' => ($unggah)?$unggah->id:$this->generateAutoNumber('ds_unggah_dokumens'),
            'user_id' => current_user('masyarakat')->id,
            'file_ktp' => $nama_ktp,
            'file_kk' => $nama_kk,
        ];

        if($unggah){
            $result = (new UnggahDokumenUpdateAction)->run($data,$unggah->id);
        }else{
            $result = (new UnggahDokumenCreateAction)->run($data);
        }

        if(!$result){
            toastr()->error('upload dokumen gagal','Gagal');
            return back();
        }

        if($request->file_ktp){
            $request->file_ktp->storeAs('backend/images/uploads/',$nama_ktp);
        }

        if($request->file_kk){
            $request->file_kk->storeAs('backend/images/uploads/',$nama_kk);
        }
        
        toastr()->success('upload dokumen berhasil','Berhasil');
        return back();

    }

    public function validationForm($request,$unggah)
    {
        $rules = [
            'file_ktp' => ($unggah)?'mimes:png,jpg,jpeg|max:1024':'required|mimes:png,jpg,jpeg|max:1024',
            'file_kk' => ($unggah)?'mimes:png,jpg,jpeg|max:1024':'required|mimes:png,jpg,jpeg|max:1024',
        ];
        $messages = [
            'required' => 'Silahkan untuk mengisi :attribute',
            'max' => 'Maksimal ukuran :attribute 1MB',
            'mimes' => 'tipe :attribute salah, untuk tipe hanya png,jpe,jpeg',
        ];
        $label=[
            'file_ktp' => 'File Ktp',
            'file_kk' => 'File KK',
        ];

        $this->validate($request,$rules,$messages,$label);
    }
}
