<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKN;
use App\Models\User;
use App\Models\Admin;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\LogSuket;
use App\Models\ProfilDesa;
use App\Mail\SuketMail;
use Str;
use Auth;
use PDF;
use Mail;
use Validator;
use Session;
use App\Actions\PassphraseLogAction;
use DB;

class SknController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skn');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skn'] = SKN::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skn'] = SKN::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skn.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skn.create',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function createProccess(Request $request)
    {
        DB::beginTransaction();
        try{
            $this->validasiForm($request);
            $data = $this->bindData($request);
            $data['id'] = $this->generateAutoNumber('ds_sk_nikah');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skn = SKN::create($data);
            $generateFile = (new GenerateFileAction)->run($skn->id,'skn');
            
            $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan Telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Status Pernikahan disetujui oleh operator desa ');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skn,'skn'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skn.detail',['id'=>$skn->encodeHash($skn->id)]);
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['skn'] =  SKN::find($id);
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            $data['kota'] = Kota::where('id',$data['skn']->kota_id)->get();
            $data['kecamatan'] = Kecamatan::where('id',$data['skn']->kecamatan_id)->get();
            $data['area'] = Desa::where('id',$data['skn']->area_id)->get();

            return view('backend.dokumen.skn.edit',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function editProccess(Request $request,$id)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($id);
            $request['id'] = $id;
            $this->validasiForm($request);
            $data = $this->bindData($request);
            $skn = SKN::find($id);
            $skn->update($data);
            $generateFile = (new GenerateFileAction)->run($skn->id,'skn');

            $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan Telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skn,'skn'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skn.detail',['id'=>$skn->encodeHash($skn->id)]);
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function detail($id)
    {
        try{
            $id = $this->decodeHash($id);
            $data['skn'] = SKN::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skn.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skn = SKN::find($id);
    //         $skn->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skn');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skn = SKN::find($id);
    //         $skn->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skn');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skn =SKN::find($request->id);
        if(!empty($skn->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'kasi_id' => 'required|max:150',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'warga_negara' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'status_perkawinan' => 'required',
                'keperluan' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'kk' => 'max:1024|mimes:jpeg,jpg,png',
                'akta_cerai' => 'max:1024|mimes:jpeg,jpg,png',
            ];
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'kasi_id' => 'required|max:150',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'warga_negara' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'status_perkawinan' => 'required',
                'keperluan' => 'required',
                'rtrw' => 'required|max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kk' => 'required|max:1024|mimes:jpeg,jpg,png',
                'akta_cerai' => 'required|max:1024|mimes:jpeg,jpg,png',
            ];
        }
        

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter/digit',
            'min' => ':attribute maksimal :min karakter',
            'mimes' => 'format :attribute salah',
        ];

        $label = [
            'no_surat' => 'Nomor Surat',
            'user_id' => 'Nama Pengaju',
            'kasi_id' => 'Kirim Ke',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'warga_negara' => 'Warga Negara',
            'alamat' => 'Alamat',
            'agama' => 'Agama',
            'rtrw' => 'File Surat Pengantar RTRW',
            'ktp' => 'File KTP',
            'kk' => 'File Kartu Keluarga',
            'akta_cerai' => 'File Akta Cerai',
            'status_perkawinan' => 'Status',
            'keperluan' => 'Keperluan',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skn = SKN::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw)){
                    \File::delete('backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('backend/images/dokumen/skn/rtrw');
            $nama_rtrw = 'skn_rtrw_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$skn->file_sp_rtrw;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skn/ktp/'.$skn->file_ktp)){
                    \File::delete('backend/images/dokumen/skn/ktp/'.$skn->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/skn/ktp');
            $nama_ktp = 'skn_ktp_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$skn->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skn/kk/'.$skn->file_kk)){
                    \File::delete('backend/images/dokumen/skn/kk/'.$skn->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/skn/kk');
            $nama_kk = 'skn_kk_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skn->file_kk;
            }
        }

        if($request->file('akta_cerai')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai)){
                    \File::delete('backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai);
                }
            }
            $akta_cerai = $request->file('akta_cerai');
            $destinationPath = public_path('backend/images/dokumen/skn/akta_cerai');
            $nama_akta_cerai = 'skn_akta_cerai_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$akta_cerai->getClientOriginalExtension();
            $akta_cerai->move($destinationPath,$nama_akta_cerai);
        }else{
            if($request->id){
                $nama_akta_cerai=$skn->file_akta_cerai;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'jk' => $request->input('jk'),
            'warga_negara' => $request->input('warga_negara'),
            'agama' => $request->input('agama'),
            'alamat' => $request->input('alamat'),
            'kota_id' => Session::get('kota_id'),
            'kecamatan_id' => Session::get('kecamatan_id'),
            'area_id' => Session::get('desa_id'),
            'file_sp_rtrw' => $nama_rtrw,
            'file_ktp' => $nama_ktp,
            'file_kk' => $nama_kk,
            'file_akta_cerai' => $nama_akta_cerai,
            'status_perkawinan' => $request->input('status_perkawinan'),
            'keperluan' => $request->input('keperluan'),
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skn')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skn/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);
            $rules = [
                'passphrase' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'max' => ':attribute maksimal :max karakter',
                'min' => ':attribute minimal :min karakter',
            ];

            $label = [
                'passphrase' => 'Passphrase',
            ];

            $this->validate($request,$rules,$messages,$label);

            $generateFile = (new GenerateFileAction)->run($skn->id,'skn');
            $signDokumen = (new SignDokumenAction)->run($id,'skn',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skn->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan Telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Status Pernikahan disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','operator')->where('desa_id',Session::get('desa_id'))->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skn,'skn'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skn');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skn.detail',['id'=>$skn->encodeHash($skn->id)])->with('error',$signDokumen);
            }
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiSekdes(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);
            $skn->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Status Pernikahan disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kepala_desa')->where('desa_id',Session::get('desa_id'))->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skn,'skn'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKasi(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);
            $skn->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Status Pernikahan disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','sekretaris_desa')->where('desa_id',Session::get('desa_id'))->first();
            DB::commit();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skn,'skn'));
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);

            if(\File::exists('backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw)){
                \File::delete('backend/images/dokumen/skn/rtrw/'.$skn->file_sp_rtrw);
            }

            if(\File::exists('backend/images/dokumen/skn/ktp/'.$skn->file_ktp)){
                \File::delete('backend/images/dokumen/skn/ktp/'.$skn->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/skn/kk/'.$skn->file_kk)){
                \File::delete('backend/images/dokumen/skn/kk/'.$skn->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai)){
                \File::delete('backend/images/dokumen/skn/akta_cerai/'.$skn->file_akta_cerai);
            }

            $skn->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function rejected(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);
            $rules = [
                'pesan' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong',
            ];

            $label = [
                'pesan' => 'Pesan',
            ];

            $this->validate($request,$rules,$messages,$label);

            $log = (new NotifikasiSuketAction)->run($skn,'skn','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function accepted(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skn = SKN::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_nikah,no_surat,'.$skn->id,
                'kasi_id' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'max' => ':attribute maksimal :max karakter/digit',
                'min' => ':attribute maksimal :min karakter',
                'unique' => ':attribute sudah digunakan',
            ];

            $label = [
                'no_surat' => 'Nomor Surat',
                'kasi_id' => 'Nama Kasi',
            ];

            $this->validate($request,$rules,$messages,$label);

            $skn->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skn,'skn','Verifikasi','Pengajuan Surat Keterangan Status Pernikahan telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Status Pernikahan disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
