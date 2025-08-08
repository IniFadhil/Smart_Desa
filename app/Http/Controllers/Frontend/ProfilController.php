<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Validator;
use Session;

class ProfilController extends Controller
{
    public function showChangePassword()
    {
        try{
            $data['profil'] = User::find(Auth::guard('masyarakat')->user()->id);
            return view('frontend.akun.password',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function updatePassword(Request $request)
    {
        try{
            $user = User::find(Auth::guard('masyarakat')->user()->id);

            $rules = [
                'old_password' => 'required',
                'new_password' => 'required|min:6|different:old_password',
                'repeat_new_password' => 'required|same:new_password|min:6'
            ];

           
            
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'min' => ':attribute minimal :min karakter',
                'different' => ':attribute tidak boleh sama dengan Kata Sandi lama',
                'same' => ':attribute tidak sama dengan yang baru',
                'unique' => ':attribute sudah digunakan',
            ];

            $label = [
                'old_password' => 'Kata Sandi Lama',
                'new_password' => 'Kata Sandi Baru',
                'repeat_new_password' => 'Konfirmasi Kata Sandi Baru',
            ];

            $validator = $this->validate($request, $rules, $messages, $label);

            if(!Hash::check($request->old_password,$user->password)){
                toastr()->error('Kata Sandi lama tidak sama','Gagal');
                return redirect()->back();
            }

            $data = [
                'password' => bcrypt($request->input('new_password')),
            ];

            $user->update($data);
            Auth::logout();
            toastr()->success('Kata Sandi berhasil diubah','Sukses');
            return redirect()->route('frontend.login');
        }catch(\QueryException $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
