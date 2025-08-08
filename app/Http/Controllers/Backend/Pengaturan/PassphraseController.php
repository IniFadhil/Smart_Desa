<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passphrase;
use Auth;

class PassphraseController extends Controller
{
	public $kunci = 'sm4rT_d354';

    function __construct()
    {
        $this->middleware('permissions:passphrase');
    }

    public function index()
    {
        try{
            $data['passphrase'] = Passphrase::where('admin_id',Auth::user()->id)->get();
            return view('backend.pengaturan.passphrase.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            return view('backend.pengaturan.passphrase.create');
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
            $data['id'] = $this->generateAutoNumber('ds_passphrase');
            $passphrase = Passphrase::create($data);

            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.pengaturan.passphrase');
        }catch(QueryException $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['passphrase'] = Passphrase::find($id);
            return view('backend.pengaturan.passphrase.edit',$data);
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
            $passphrase = Passphrase::find($id);
            $passphrase->update($data);

            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.pengaturan.passphrase.detail',['id'=>$passphrase->encodeHash($passphrase->id)]);
        }catch(QueryException $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function detail($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['passphrase'] = Passphrase::find($id);
            return view('backend.pengaturan.passphrase.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    public function active(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $passphrase = Passphrase::find($id);
            $passphrase->update(['status' => 1]);
            toastr()->success('Data Berhasil diaktifkan','Sukses');
            return redirect()->route('backend.pengaturan.passphrase');
        }catch(QueryException $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function inactive(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $passphrase = Passphrase::find($id);
            $passphrase->update(['status' => 0]);
            toastr()->success('Data Berhasil dinonaktifkan','Sukses');
            return redirect()->route('backend.pengaturan.passphrase');
        }catch(QueryException $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {
        $rules = [
            'passphrase' => 'required|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{10,14}$^',
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'regex' => ':attribute harus mengandung minimal 1 Huruf Kapital dan 1 Angka dan tidak boleh mengandung simbol',
        ];

        $label = [
            'passphrase' => 'Passphrase',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        $data = [
            'passphrase' => hash_hmac('sha256',$this->kunci,$request->input('passphrase')),
            'admin_id' => Auth::user()->id,
        ];

        return $data;
    }
}
