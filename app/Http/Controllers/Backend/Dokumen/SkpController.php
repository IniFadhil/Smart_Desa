<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKP;
use App\Models\LogSuket;
use App\Models\ProfilDesa;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pekerjaan;
use App\Mail\SuketMail;
use Str;
use Auth;
use PDF;
use Mail;
use Validator;
use Session;
use App\Actions\PassphraseLogAction;
use DB;

class SkpController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skp');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skp'] = SKP::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skp'] = SKP::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skp.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['pekerjaan'] = Pekerjaan::all();
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skp.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_penghasilan');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skp = SKP::create($data);
            $generateFile = (new GenerateFileAction)->run($skp->id,'skp');

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan Telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Penghasilan disetujui oleh operator desa ');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skp,'skp'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skp.detail',['id'=>$skp->encodeHash($skp->id)]);
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
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['pekerjaan'] = Pekerjaan::all();
            $data['skp'] =  SKP::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skp.edit',$data);
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
            $skp = SKP::find($id);
            $skp->update($data);
            $generateFile = (new GenerateFileAction)->run($skp->id,'skp');

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan Telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skp,'skp'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skp.detail',['id'=>$skp->encodeHash($skp->id)]);
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
            $data['skp'] = SKP::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skp.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skp = SKP::find($id);
    //         $skp->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skp');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skp = SKP::find($id);
    //         $skp->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skp');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skp = SKP::find($request->id);
        if(!empty($skp->slip_gaji)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16|min:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required|max:150',
                'gaji' => 'required|max:150',
                'jumlah_tanggungan' => 'required|max:150',
                'jk' => 'required|max:150',
                'pekerjaan_id' => 'required|max:150',
                'alamat' => 'required',
                'kasi_id' => 'required',
                'slip_gaji' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'kk' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
            ];
    
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16|min:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required|max:150',
                'gaji' => 'required|max:150',
                'jumlah_tanggungan' => 'required|max:150',
                'jk' => 'required|max:150',
                'pekerjaan_id' => 'required|max:150',
                'alamat' => 'required',
                'kasi_id' => 'required',
                'slip_gaji' => 'required|max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kk' => 'required|max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'required|max:1024|mimes:jpeg,jpg,png',
            ];
    
        }
        
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter/digit',
            'min' => ':attribute maksimal :min karakter',
        ];

        $label = [
            'no_surat' => 'Nomor Surat',
            'user_id' => 'Nama Pengaju',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'pekerjaan_id' => 'Pekerjaan',
            'gaji' => 'Jumlah Gaji',
            'jumlah_tanggungan' => 'Jumlah Orang yang di tanggung',
            'alamat' => 'Alamat',
            'kasi_id' => 'Kirim Ke',
            'slip_gaji' => 'File Slip Gaji',
            'ktp' => 'File KTP',
            'kk' => 'File Kartu Keluarga',
            'surat_pernyataan' => 'File Surat Pernyataan',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skp = SKP::find($request->id);
        }

        if($request->file('slip_gaji')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skp/slip_gaji/'.$skp->slip_gaji)){
                    \File::delete('backend/images/dokumen/skp/slip_gaji/'.$skp->slip_gaji);
                }
            }
            $slip_gaji = $request->file('slip_gaji');
            $destinationPath = public_path('backend/images/dokumen/skp/slip_gaji');
            $nama_slip_gaji = 'skp_slip_gaji_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$slip_gaji->getClientOriginalExtension();
            $slip_gaji->move($destinationPath,$nama_slip_gaji);
        }else{
            if($request->id){
                $nama_slip_gaji=$skp->slip_gaji;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skp/ktp/'.$skp->file_ktp)){
                    \File::delete('backend/images/dokumen/skp/ktp/'.$skp->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/skp/ktp');
            $nama_ktp = 'skp_ktp_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$skp->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skp/kk/'.$skp->file_kk)){
                    \File::delete('backend/images/dokumen/skp/kk/'.$skp->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/skp/kk');
            $nama_kk = 'skp_kk_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skp->file_kk;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skp/surat_pernyataan/'.$skp->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/skp/surat_pernyataan/'.$skp->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/skp/surat_pernyataan');
            $nama_surat_pernyataan = 'skp_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$skp->file_surat_pernyataan;
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
            'gaji' => $request->input('gaji'),
            'jumlah_tanggungan' => $request->input('jumlah_tanggungan'),
            'alamat' => $request->input('alamat'),
            'jk' => $request->input('jk'),
            'pekerjaan_id' => $request->input('pekerjaan_id'),
            'kota_id' => Session::get('kota_id'),
            'kecamatan_id' => Session::get('kecamatan_id'),
            'area_id' => Session::get('desa_id'),
            'slip_gaji' => $nama_slip_gaji,
            'file_ktp' => $nama_ktp,
            'file_kk' => $nama_kk,
            'file_surat_pernyataan' => $nama_surat_pernyataan,
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skp')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skp/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skp = SKP::find($id);
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

            $generateFile = (new GenerateFileAction)->run($skp->id,'skp');
            $signDokumen = (new SignDokumenAction)->run($id,'skp',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skp->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan Telah di verifikasi Oleh Kepala Desa','kades','terima');
            $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Penghasilan disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','operator')->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skp,'skp'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skp');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skp.detail',['id'=>$skp->encodeHash($skp->id)])->with('error',$signDokumen);
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
            $skp = SKP::find($id);
            $skp->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Penghasilan disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','kepala_desa')->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skp,'skp'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skp');
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
            $skp = SKP::find($id);
            $skp->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Penghasilan disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','sekretaris_desa')->first();
            DB::commit();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skp,'skp'));
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skp');
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
            $skp = SKP::find($id);

            if(\File::exists('backend/images/dokumen/skp/slip_gaji/'.$skp->slip_gaji)){
                \File::delete('backend/images/dokumen/skp/slip_gaji/'.$skp->slip_gaji);
            }

            if(\File::exists('backend/images/dokumen/skp/ktp/'.$skp->file_ktp)){
                \File::delete('backend/images/dokumen/skp/ktp/'.$skp->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/skp/kk/'.$skp->file_kk)){
                \File::delete('backend/images/dokumen/skp/kk/'.$skp->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skp/surat_pernyataan/'.$skp->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/skp/surat_pernyataan/'.$skp->file_surat_pernyataan);
            }

            $skp->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skp');
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
            $skp =SKP::find($id);
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

            $log = (new NotifikasiSuketAction)->run($skp,'skp','Penolakan',$request->pesan,'operator','tolak');
            toastr()->success('Data Berhasil Ditolak','Sukses');
            DB::commit();
            return redirect()->route('backend.dokumen.skp');
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
            $skp =SKP::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_penghasilan,no_surat,'.$skp->id,
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

            $skp->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skp,'skp','Verifikasi','Pengajuan Surat Keterangan Penghasilan telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Penghasilan disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skp');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
