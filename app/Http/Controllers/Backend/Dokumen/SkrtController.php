<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\GenerateFileAction;
use App\Actions\SignDokumenAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKRT;
use App\Models\User;
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

class SkrtController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skrt');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skrt'] = SKRT::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skrt'] = SKRT::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skrt.list',$data);
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
            return view('backend.dokumen.skrt.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_riwayat_tanah');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skrt = SKRT::create($data);
            $generateFile = (new GenerateFileAction)->run($skrt->id,'skrt');

            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Riwayat Tanah disetujui oleh operator desa');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skrt,'skrt'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skrt.detail',['id'=>$skrt->encodeHash($skrt->id)]);
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
            $data['skrt'] =  SKRT::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skrt.edit',$data);
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
            $data['status'] = '1';
            $skrt =  SKRT::find($id);
            $skrt->update($data);
            $generateFile = (new GenerateFileAction)->run($skrt->id,'skrt');
            
            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skrt,'skrt'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skrt.detail',['id'=>$skrt->encodeHash($skrt->id)]);
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
            $data['skrt'] = SKRT::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skrt.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skrt = SKRT::find($id);
    //         $skrt->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skrt');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skrt = SKRT::find($id);
    //         $skrt->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skrt');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skrt =  SKRT::find($request->id);
        if(!empty($skrt->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'no_sertifikat' => 'required|max:150',
                'nama_pemilik' => 'required|max:150',
                'nik_pemilik' => 'required|max:16',
                'tgl_riwayat1' => 'required',
                'atas_nama1' => 'required|max:150',
                'tgl_riwayat2' => 'required',
                'atas_nama2' => 'required|max:150',
                'berdasarkan2' => 'required',
                'tgl_riwayat3' => 'required',
                'atas_nama3' => 'required|max:150',
                'berdasarkan3' => 'required',
                'tgl_riwayat4' => 'required',
                'atas_nama4' => 'required|max:150',
                'berdasarkan4' => 'required',
                'no_sppt' => 'required',
                'blok' => 'required',
                'persil' => 'required',
                'no_kihir' => 'required',
                'luas' => 'required',
                'alamat' => 'required',
                'sebelah_utara' => 'required',
                'sebelah_timur' => 'required',
                'sebelah_selatan' => 'required',
                'sebelah_barat' => 'required',
                'nama_saksi1' => 'required',
                'nik_saksi1' => 'required',
                'nama_saksi2' => 'required',
                'nik_saksi2' => 'required',
                'kasi_id' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'kk' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_tanah' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pajak_tanah' => 'max:1024|mimes:jpeg,jpg,png',
            ];
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'no_sertifikat' => 'required|max:150',
                'nama_pemilik' => 'required|max:150',
                'nik_pemilik' => 'required|max:16',
                'tgl_riwayat1' => 'required',
                'atas_nama1' => 'required|max:150',
                'tgl_riwayat2' => 'required',
                'atas_nama2' => 'required|max:150',
                'berdasarkan2' => 'required',
                'tgl_riwayat3' => 'required',
                'atas_nama3' => 'required|max:150',
                'berdasarkan3' => 'required',
                'tgl_riwayat4' => 'required',
                'atas_nama4' => 'required|max:150',
                'berdasarkan4' => 'required',
                'no_sppt' => 'required',
                'blok' => 'required',
                'persil' => 'required',
                'no_kihir' => 'required',
                'luas' => 'required',
                'alamat' => 'required',
                'sebelah_utara' => 'required',
                'sebelah_timur' => 'required',
                'sebelah_selatan' => 'required',
                'sebelah_barat' => 'required',
                'nama_saksi1' => 'required',
                'nik_saksi1' => 'required',
                'nama_saksi2' => 'required',
                'nik_saksi2' => 'required',
                'kasi_id' => 'required',
                'rtrw' => 'required|max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kk' => 'required|max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'required|max:1024|mimes:jpeg,jpg,png',
                'surat_tanah' => 'required|max:1024|mimes:jpeg,jpg,png',
                'surat_pajak_tanah' => 'required|max:1024|mimes:jpeg,jpg,png',
            ];
        }

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter/digit',
            'mimes' => 'format :attribute salah',
            'min' => ':attribute maksimal :min karakter/digit',
        ];

        $label = [
            'no_surat' => 'Nomor Surat',
            'user_id' => 'Nama Pengaju',
            'no_sertifikat' => 'Nomor Sertifikat',
            'nama_pemilik' => 'Nama',
            'nik_pemilik' => 'NIK',
            'tgl_riwayat1' => 'Tanggal Riwayat',
            'atas_nama1' => 'Atas Nama',
            'tgl_riwayat2' => 'Tanggal Riwayat',
            'atas_nama2' => 'Atas Nama',
            'berdasarkan2' => 'Berdasarkan',
            'tgl_riwayat3' => 'Tanggal Riwayat',
            'atas_nama3' => 'Atas Nama',
            'berdasarkan3' => 'Berdasarkan',
            'tgl_riwayat4' => 'Tanggal Riwayat',
            'atas_nama4' => 'Atas Nama',
            'berdasarkan4' => 'Berdasarkan',
            'no_sppt' => 'Nomor SPPT',
            'blok' => 'Blok',
            'persil' => 'Persil',
            'no_kihir' => 'Nomor Kihir/Kikitir/Girik',
            'luas' => 'Luas',
            'alamat' => 'Alamat',
            'sebelah_utara' => 'Sebelah Utara',
            'sebelah_timur' => 'Sebelah Timur',
            'sebelah_selatan' => 'Sebelah Selatan',
            'sebelah_barat' => 'Sebelah Barat',
            'nama_saksi1' => 'Nama',
            'nik_saksi1' => 'NIK ',
            'nama_saksi2' => 'Nama',
            'nik_saksi2' => 'NIK',
            'email' => 'Kirim Ke Kasi',
            'rtrw' => 'File Surat Pengantar RTRW',
            'ktp' => 'File KTP',
            'kk' => 'File Kartu Keluarga',
            'surat_pernyataan' => 'File Surat Pernyataan',
            'surat_tanah' => 'File Surat Tanah',
            'surat_pajak_tanah' => 'File Surat Pajak Tanah',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skrt =  SKRT::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw)){
                    \File::delete('backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('backend/images/dokumen/skrt/rtrw');
            $nama_rtrw = 'skrt_rtrw_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$skrt->file_sp_rtrw;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/ktp/'.$skrt->file_ktp)){
                    \File::delete('backend/images/dokumen/skrt/ktp/'.$skrt->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/skrt/ktp');
            $nama_ktp = 'skrt_ktp_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$skrt->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/kk/'.$skrt->file_kk)){
                    \File::delete('backend/images/dokumen/skrt/kk/'.$skrt->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/skrt/kk');
            $nama_kk = 'skrt_kk_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skrt->file_kk;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/skrt/surat_pernyataan');
            $nama_surat_pernyataan = 'skrt_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$skrt->file_surat_pernyataan;
            }
        }

        if($request->file('surat_pajak_tanah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah)){
                    \File::delete('backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah);
                }
            }
            $surat_pajak_tanah = $request->file('surat_pajak_tanah');
            $destinationPath = public_path('backend/images/dokumen/skrt/surat_pajak_tanah');
            $nama_surat_pajak_tanah = 'skrt_surat_pajak_tanah_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').'.'.$surat_pajak_tanah->getClientOriginalExtension();
            $surat_pajak_tanah->move($destinationPath,$nama_surat_pajak_tanah);
        }else{
            if($request->id){
                $nama_surat_pajak_tanah=$skrt->file_surat_pajak_tanah;
            }
        }

        if($request->file('surat_tanah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah)){
                    \File::delete('backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah);
                }
            }
            $surat_tanah = $request->file('surat_tanah');
            $destinationPath = public_path('backend/images/dokumen/skrt/surat_tanah');
            $nama_surat_tanah = 'skrt_surat_tanah_'.strtolower(str_replace(' ','_',$request->nama_pemilik)).'_'.date('YmdHis').'.'.$surat_tanah->getClientOriginalExtension();
            $surat_tanah->move($destinationPath,$nama_surat_tanah);
        }else{
            if($request->id){
                $nama_surat_tanah=$skrt->file_surat_tanah;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama_pemilik' => $request->input('nama_pemilik'),
            'nik_pemilik' => $request->input('nik_pemilik'),
            'no_sertifikat' => $request->input('no_sertifikat'),
            'tgl_riwayat1' => $request->input('tgl_riwayat1'),
            'atas_nama1' => $request->input('atas_nama1'),
            'atas_nama2' => $request->input('atas_nama2'),
            'atas_nama3' => $request->input('atas_nama3'),
            'atas_nama4' => $request->input('atas_nama4'),
            'tgl_riwayat2' => $request->input('tgl_riwayat2'),
            'tgl_riwayat3' => $request->input('tgl_riwayat3'),
            'tgl_riwayat4' => $request->input('tgl_riwayat4'),
            'berdasarkan2' => $request->input('berdasarkan2'),
            'berdasarkan3' => $request->input('berdasarkan3'),
            'berdasarkan4' => $request->input('berdasarkan4'),
            'no_sppt' => $request->input('no_sppt'),
            'blok' => $request->input('blok'),
            'no_kihir' => $request->input('no_kihir'),
            'persil' => $request->input('persil'),
            'luas' => $request->input('luas'),
            'alamat' => $request->input('alamat'),
            'sebelah_utara' => $request->input('sebelah_utara'),
            'sebelah_timur' => $request->input('sebelah_timur'),
            'sebelah_selatan' => $request->input('sebelah_selatan'),
            'sebelah_barat' => $request->input('sebelah_barat'),
            'nama_saksi1' => $request->input('nama_saksi1'),
            'nik_saksi1' => $request->input('nik_saksi1'),
            'nama_saksi2' => $request->input('nama_saksi2'),
            'nik_saksi2' => $request->input('nik_saksi2'),
            'file_sp_rtrw' => $nama_rtrw,
            'file_ktp' => $nama_ktp,
            'file_kk' => $nama_kk,
            'file_surat_pernyataan' => $nama_surat_pernyataan,
            'file_surat_tanah' => $nama_surat_tanah,
            'file_surat_pajak_tanah' => $nama_surat_pajak_tanah,
            
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            // set_time_limit(500);
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skrt')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skrt/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return redirect()->route('backend.dokumen.skrt');
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skrt =  SKRT::find($id);
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

            $generateFile = (new GenerateFileAction)->run($skrt->id,'skrt');
            $signDokumen = (new SignDokumenAction)->run($id,'skrt',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skrt->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Riwayat Tanah disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','operator')->where('desa_id',Session::get('desa_id'))->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skrt,'skrt'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skrt');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skrt.detail',['id'=>$skrt->encodeHash($skrt->id)])->with('error',$signDokumen);
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
            $skrt =  SKRT::find($id);
            $skrt->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Riwayat Tanah disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','sekretaris_desa')->where('desa_id',Session::get('desa_id'))->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skrt,'skrt'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skrt');
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
            $skrt =  SKRT::find($id);
            $skrt->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Riwayat Tanah disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','sekretaris_desa')->where('desa_id',Session::get('desa_id'))->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skrt,'skrt'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skrt');
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
            $skrt =  SKRT::find($id);

            if(\File::exists('backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw)){
                \File::delete('backend/images/dokumen/skrt/rtrw/'.$skrt->file_sp_rtrw);
            }

            if(\File::exists('backend/images/dokumen/skrt/ktp/'.$skrt->file_ktp)){
                \File::delete('backend/images/dokumen/skrt/ktp/'.$skrt->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/skrt/kk/'.$skrt->file_kk)){
                \File::delete('backend/images/dokumen/skrt/kk/'.$skrt->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/skrt/surat_pernyataan/'.$skrt->file_surat_pernyataan);
            }

            if(\File::exists('backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah)){
                \File::delete('backend/images/dokumen/skrt/surat_tanah/'.$skrt->file_surat_tanah);
            }

            if(\File::exists('backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah)){
                \File::delete('backend/images/dokumen/skrt/surat_pajak_tanah/'.$skrt->file_surat_pajak_tanah);
            }

            $skrt->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skrt');
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
            $skrt = SKRT::find($id);
            
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

            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skrt');
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
            $skrt = SKRT::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_riwayat_tanah,no_surat,'.$skrt->id,
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

            $skrt->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skrt,'skrt','Verifikasi','Pengajuan Surat Keterangan Riwayat Tanah telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Riwayat Tanah disetujui oleh operator desa');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skrt');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
