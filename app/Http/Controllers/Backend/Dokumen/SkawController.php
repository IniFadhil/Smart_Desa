<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKAW;
use App\Models\SKAWPasangan;
use App\Models\SKAWAnak;
use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Admin;
use App\Models\ProfilDesa;
use App\Models\LogSuket;
use App\Mail\SuketMail;
use Str;
use Auth;
use PDF;
use Mail;
use Validator;
use Session;
use App\Actions\PassphraseLogAction;
use DB;

class SkawController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skaw');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skaw'] =SKAW::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skaw'] =SKAW::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skaw.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['pekerjaan'] = Pekerjaan::get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skaw.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_ahli_waris');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skaw =SKAW::create($data);
            $generateFile = (new GenerateFileAction)->run($skaw->id,'skaw');

            $anak = $this->insertMultipleAnak($skaw,$request);
            $pasangan = $this->insertMultiplePasangan($skaw,$request);

            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Operator Desa','operator','terima');

            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Ahli Waris disetujui oleh operator desa ');
            DB::commit();

            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skaw,'skaw'));

            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skaw.detail',['id'=>$skaw->encodeHash($skaw->id)]);
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
            $data['pekerjaan'] = Pekerjaan::get();
            $data['skaw'] = SKAW::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skaw.edit',$data);
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
            $skaw = SKAW::find($id);
            $skaw->update($data);
            $generateFile = (new GenerateFileAction)->run($skaw->id,'skaw');
           
            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skaw,'skaw'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skaw.detail',['id'=>$skaw->encodeHash($skaw->id)]);
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
            $data['skaw'] =SKAW::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skaw.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skaw =SKAW::find($id);
    //         $skaw->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skaw');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skaw =SKAW::find($id);
    //         $skaw->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skaw');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skaw = SKAW::find($request->id);
        if(!empty($skaw->file_surat_permohonan)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_alm' => 'required|max:150',
                'jk_alm' => 'required',
                'tgl_kematian' => 'required|max:150',
                'alamat' => 'required',
                'nama_saksi1' => 'required',
                'nama_saksi2' => 'required',
                'nik_saksi1' => 'required',
                'nik_saksi2' => 'required',
                'kasi_id' => 'required',
                'nama_anak' => 'required',
                'tempat_lahir_anak' => 'required',
                'kewarganegaraan' => 'required',
                'alamat_anak' => 'required',
                'tgl_lahir_anak' => 'required',
                'nama_pasangan' => 'required',
                'jk_pasangan' => 'required',
                'tgl_lahir_pasangan' => 'required',
                'tempat_lahir_pasangan' => 'required',
                'pekerjaan_id' => 'required',
                'surat_permohonan' => 'max:1024|mimes:jpeg,jpg,png',
                'silsilah' => 'max:1024|mimes:jpeg,jpg,png',
                'akta_lahir' => 'max:1024|mimes:jpeg,jpg,png',
                'sk_kematian' => 'max:1024|mimes:jpeg,jpg,png',
                'buku_bikah' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'kk' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
            ];
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_alm' => 'required|max:150',
                'jk_alm' => 'required',
                'tgl_kematian' => 'required|max:150',
                'alamat' => 'required',
                'nama_saksi1' => 'required',
                'nama_saksi2' => 'required',
                'nik_saksi1' => 'required',
                'nik_saksi2' => 'required',
                'kasi_id' => 'required',
                'nama_anak' => 'required',
                'tempat_lahir_anak' => 'required',
                'kewarganegaraan' => 'required',
                'alamat_anak' => 'required',
                'tgl_lahir_anak' => 'required',
                'nama_pasangan' => 'required',
                'jk_pasangan' => 'required',
                'tgl_lahir_pasangan' => 'required',
                'tempat_lahir_pasangan' => 'required',
                'pekerjaan_id' => 'required',
                'surat_permohonan' => 'required|max:1024|mimes:jpeg,jpg,png',
                'silsilah' => 'required|max:1024|mimes:jpeg,jpg,png',
                'akta_lahir' => 'required|max:1024|mimes:jpeg,jpg,png',
                'sk_kematian' => 'required|max:1024|mimes:jpeg,jpg,png',
                'buku_nikah' => 'required|max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kk' => 'required|max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'required|max:1024|mimes:jpeg,jpg,png',
            ];
        }

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter/digit',
            'mimes' => 'format :attribute salah',
            'min' => ':attribute maksimal :min karakter/digit',
        ];

        $label = [
            'no_surat' => 'No Surat',
                'user_id' => 'Nama Pengaju',
                'nama_alm' => 'Nama',
                'jk_alm' => 'Jenis Kelamin',
                'tgl_kematian' => 'Tanggal Kematian',
                'alamat' => 'Alamat',
                'kasi_id' => 'Kirim Ke Kasi',
                'nama_saksi1' => 'Nama',
                'nama_saksi2' => 'NIK',
                'nik_saksi1' => 'Nama',
                'nik_saksi2' => 'NIK',
                'nama_anak' => 'Nama',
                'tempat_lahir_anak' => 'Tempat Lahir',
                'kewarganegaraan' => 'Kewarganegaraan',
                'alamat_anak' => 'Alamat',
                'tgl_lahir_anak' => 'Tanggal Lahir',
                'nama_pasangan' => 'Nama',
                'jk_pasangan' => 'Jenis Kelamin',
                'tgl_lahir_pasangan' => 'Tanggal Lahir',
                'tempat_lahir_pasangan' => 'Tempat Lahir',
                'pekerjaan_id' => 'Pekerjaan',
                'surat_permohonan' => 'File Surat Permohonan',
                'silsilah' => 'File Silsilah',
                'akta_lahir' => 'File Akta Lahir',
                'sk_kematian' => 'File SK Kematian',
                'buku_nikah' => 'File Buku Nikah',
                'ktp' => 'File KTP',
                'kk' => 'File KK',
                'surat_pernyataan' => 'File Surat Pernyataan',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skaw = SKAW::find($request->id);
        }

        if($request->file('surat_permohonan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan)){
                    \File::delete('backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan);
                }
            }
            $surat_permohonan = $request->file('surat_permohonan');
            $destinationPath = public_path('backend/images/dokumen/skaw/surat_permohonan');
            $nama_surat_permohonan = 'skaw_surat_permohonan_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$surat_permohonan->getClientOriginalExtension();
            $surat_permohonan->move($destinationPath,$nama_surat_permohonan);
        }else{
            if($request->id){
                $nama_surat_permohonan=$skaw->file_surat_permohonan;
            }
        }

        if($request->file('buku_nikah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah)){
                    \File::delete('backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah);
                }
            }
            $buku_nikah = $request->file('buku_nikah');
            $destinationPath = public_path('backend/images/dokumen/skaw/buku_nikah');
            $nama_buku_nikah = 'skaw_buku_nikah_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$buku_nikah->getClientOriginalExtension();
            $buku_nikah->move($destinationPath,$nama_buku_nikah);
        }else{
            if($request->id){
                $nama_buku_nikah=$skaw->file_buku_nikah;
            }
        }

        if($request->file('sk_kematian')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian)){
                    \File::delete('backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian);
                }
            }
            $sk_kematian = $request->file('sk_kematian');
            $destinationPath = public_path('backend/images/dokumen/skaw/sk_kematian');
            $nama_sk_kematian = 'skaw_sk_kematian_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$sk_kematian->getClientOriginalExtension();
            $sk_kematian->move($destinationPath,$nama_sk_kematian);
        }else{
            if($request->id){
                $nama_sk_kematian=$skaw->file_sk_kematian;
            }
        }

        if($request->file('akta_lahir')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/akta_lahir/'.$skaw->file_akta_lahir)){
                    \File::delete('backend/images/dokumen/skaw/akta_lahir/'.$skaw->file_akta_lahir);
                }
            }
            $akta_lahir = $request->file('akta_lahir');
            $destinationPath = public_path('backend/images/dokumen/skaw/akta_lahir');
            $nama_akta_lahir = 'skaw_akta_lahir_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$akta_lahir->getClientOriginalExtension();
            $akta_lahir->move($destinationPath,$nama_akta_lahir);
        }else{
            if($request->id){
                $nama_akta_lahir=$skaw->file_akta_lahir;
            }
        }

        if($request->file('silsilah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah)){
                    \File::delete('backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah);
                }
            }
            $silsilah = $request->file('silsilah');
            $destinationPath = public_path('backend/images/dokumen/skaw/silsilah');
            $nama_silsilah = 'skaw_silsilah_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$silsilah->getClientOriginalExtension();
            $silsilah->move($destinationPath,$nama_silsilah);
        }else{
            if($request->id){
                $nama_silsilah=$skaw->file_silsilah;
            }
        }
        
        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/ktp/'.$skaw->file_ktp)){
                    \File::delete('backend/images/dokumen/skaw/ktp/'.$skaw->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/skaw/ktp');
            $nama_ktp = 'skaw_ktp_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$skaw->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/kk/'.$skaw->file_kk)){
                    \File::delete('backend/images/dokumen/skaw/kk/'.$skaw->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/skaw/kk');
            $nama_kk = 'skaw_kk_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skaw->file_kk;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/skaw/surat_pernyataan');
            $nama_surat_pernyataan = 'skaw_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->nama_alm)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$skaw->file_surat_pernyataan;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama_alm' => $request->input('nama_alm'),
            'jk_alm' => $request->input('jk_alm'),
            'tgl_kematian' => $request->input('tgl_kematian'),
            'alamat' => $request->input('alamat'),
            'nama_saksi1' => $request->input('nama_saksi1'),
            'nama_saksi2' => $request->input('nama_saksi2'),
            'nik_saksi1' => $request->input('nik_saksi1'),
            'nik_saksi2' => $request->input('nik_saksi2'),
            'kota_id' => Session::get('kota_id'),
            'kecamatan_id' => Session::get('kecamatan_id'),
            'area_id' => Session::get('desa_id'),
            'file_surat_permohonan' => $nama_surat_permohonan,
            'file_akta_lahir' => $nama_akta_lahir,
            'file_silsilah' => $nama_silsilah,
            'file_sk_kematian' => $nama_sk_kematian,
            'file_buku_nikah' => $nama_buku_nikah,
            'file_ktp' => $nama_ktp,
            'file_kk' => $nama_kk,
            'file_surat_pernyataan' => $nama_surat_pernyataan,
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            // set_time_limit(500);
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skaw')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skaw/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return redirect()->route('backend.dokumen.skaw');
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skaw = SKAW::find($id);
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
            $generateFile = (new GenerateFileAction)->run($skaw->id,'skaw');
            $signDokumen = (new SignDokumenAction)->run($id,'skaw',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skaw->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Ahli Waris disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','operator')->where('desa_id',Session::get('desa_id'))->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skaw,'skaw'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skaw');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skaw.detail',['id'=>$skaw->encodeHash($skaw->id)])->with('error',$signDokumen);
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
            $skaw = SKAW::find($id);
            $skaw->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Ahli Waris disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','sekretaris_desa')->where('desa_id',Session::get('desa_id'))->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skaw,'skaw'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skaw');
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
            $skaw = SKAW::find($id);
            $skaw->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Ahli Waris disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','sekretaris_desa')->where('desa_id',Session::get('desa_id'))->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skaw,'skaw'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skaw');
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
            $skaw = SKAW::find($id);

            if(\File::exists('backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan)){
                \File::delete('backend/images/dokumen/skaw/surat_permohonan/'.$skaw->file_surat_permohonan);
            }

            if(\File::exists('backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah)){
                \File::delete('backend/images/dokumen/skaw/buku_nikah/'.$skaw->file_buku_nikah);
            }

            if(\File::exists('backend/images/dokumen/skaw/akta_lahir/'.$skaw->file_akta_lahir)){
                \File::delete('backend/images/dokumen/skaw/akta_lahir/'.$skaw->file_akta_lahir);
            }

            if(\File::exists('backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian)){
                \File::delete('backend/images/dokumen/skaw/sk_kematian/'.$skaw->file_sk_kematian);
            }

            if(\File::exists('backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah)){
                \File::delete('backend/images/dokumen/skaw/silsilah/'.$skaw->file_silsilah);
            }

            if(\File::exists('backend/images/dokumen/skaw/ktp/'.$skaw->file_ktp)){
                \File::delete('backend/images/dokumen/skaw/ktp/'.$skaw->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/skaw/kk/'.$skaw->file_kk)){
                \File::delete('backend/images/dokumen/skaw/kk/'.$skaw->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/skaw/surat_pernyataan/'.$skaw->file_surat_pernyataan);
            }

            $skaw->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skaw');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function insertMultipleAnak($skaw,$anak)
    {
        try{
            $id = $anak->anak_id;
            $deleteExits = SKAWAnak::where('skaw_id',$skaw->id)->delete();
            for($i=0;$i<count($id);$i++){
                if($anak->nama_anak[$i] != null){
                    $data = [
                        'id' => $this->generateAutoNumber('ds_skaw_anak'),
                        'skaw_id' => $skaw->id,
                        'nama' => $anak->nama_anak[$i], 
                        'tempat_lahir' => $anak->tempat_lahir_anak[$i], 
                        'tgl_lahir' => $anak->tgl_lahir_anak[$i], 
                        'kewarganegaraan' => $anak->kewarganegaraan[$i], 
                        'alamat' => $anak->alamat_anak[$i], 
                    ];
    
                    $result = SKAWAnak::create($data);
                }
            }

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function insertMultiplePasangan($skaw,$pasangan)
    {
        try{
            $id = $pasangan->pasangan_id;
            $deleteExits = SKAWPasangan::where('skaw_id',$skaw->id)->delete();
            for($i=0;$i<count($id);$i++){
                if($pasangan->nama_pasangan[$i] != null){
                $data = [
                    'id' => $this->generateAutoNumber('ds_skaw_pasangan'),
                    'skaw_id' => $skaw->id,
                    'nama' => $pasangan->nama_pasangan[$i], 
                    'tempat_lahir' => $pasangan->tempat_lahir_pasangan[$i], 
                    'tgl_lahir' => $pasangan->tgl_lahir_pasangan[$i], 
                    'pekerjaan_id' => $pasangan->pekerjaan_id[$i], 
                    'jk' => $pasangan->jk_pasangan[$i], 
                ];

                $result = SKAWPasangan::create($data);
                }
            }

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function rejected(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $skaw = SKAW::find($id);
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
            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skaw');
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
            $skaw = SKAW::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_ahli_waris,no_surat,'.$skaw->id,
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

            $skaw->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skaw,'skaw','Verifikasi','Pengajuan Surat Keterangan Ahli Waris telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Ahli Waris disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skaw');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

}
