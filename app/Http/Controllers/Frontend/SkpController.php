<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SKP;
use App\Models\Pekerjaan;
use App\Models\Admin;
use Auth;
use Mail;
use Session;

class SkpController extends Controller
{
    public function index()
    {
        try{
            return view('frontend.formSurat.skp');
        }catch(\Exception $e){
            toastr()->error('Gagal Memuat Halaman','error');
            return back();
        }
    }

    public function indexWebView(Request $request)
    {
        try{
            $user = User::where('api_token',$request->token)->first();
            if(!empty($user)){
            	$data['user']=$user;
                $data['pekerjaan'] = Pekerjaan::get();
                return view('webview.skp',$data);
            }else{
                toastr()->error('Gagal Memuat Halaman','error');
                return back();
            }
        }catch(\Exception $e){
            toastr()->error('Gagal Memuat Halaman','error');
            return back();
        }
    }

    public function detailWebView(Request $request)
    {
        try{
            $user = Admin::where('api_token',$request->token)->first();
            if(!empty($user)){
                $data['pekerjaan'] = Pekerjaan::all();
                $data['skp'] = SKP::where('id',$request->id)->where('desa_id',Session::get('desa_id'))->first();
                return view('webview.skpDetail',$data);
            }else{
                toastr()->error('Gagal Memuat Halaman','error');
                return back();
            }
        }catch(\Exception $e){
            toastr()->error('Gagal Memuat Halaman','error');
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = base64_decode($id);
            $data['skp'] = SKP::where('id',$id)->where('user_id',Auth::guard('masyarakat')->user()->id)->where('desa_id',Session::get('desa_id'))->first();
            return view('frontend.formSurat.skpEdit',$data);
        }catch(\Exception $e){
            toastr()->error('Gagal Memuat Halaman','error');
            return back();
        }
    }

    public function editWebView(Request $request)
    {
        try{
            $user = User::where('api_token',$request->token)->first();
            if(!empty($user)){
                $data['skp'] = SKP::where('id',$request->suket_id)->where('user_id',$user->id)->where('desa_id',Session::get('desa_id'))->first();
                return view('webview.skpEdit',$data);
            }else{
                toastr()->error('Gagal Memuat Halaman','error');
                return back();
            }
        }catch(\Exception $e){
            toastr()->error('Gagal Memuat Halaman','error');
            return back();
        }
    }
}
