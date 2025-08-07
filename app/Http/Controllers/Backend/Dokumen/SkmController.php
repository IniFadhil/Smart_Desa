<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKM;
use App\Models\LogSuket;
use App\Models\ProfilDesa;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pekerjaan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Mail\SuketMail;
use Str;
use Auth;
use PDF;
use Mail;
use Validator;
use Session;
use App\Actions\PassphraseLogAction;
use DB;

class SkmController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skm');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skm'] = SKM::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skm'] = SKM::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skm.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['pekerjaan'] = Pekerjaan::all();
            $data['provinsi'] = Provinsi::get();
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skm.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_kematian');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skm = SKM::create($data);
            $generateFile = (new GenerateFileAction)->run($skm->id,'skm');

            $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian Telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Kematian disetujui oleh operator desa ');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skm,'skm'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skm.detail',['id'=>$skm->encodeHash($skm->id)]);
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
            $data['provinsi'] = Provinsi::get();
            $data['kota'] = Kota::get();
            $data['kecamatan'] = Kecamatan::get();
            $data['area'] = Desa::get();
            $data['skm'] =  SKM::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skm.edit',$data);
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
            $data['status'] ='1';
            $skm = SKM::find($id);
            $skm->update($data);
            $generateFile = (new GenerateFileAction)->run($skm->id,'skm');

            $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian Telah di verifikasi Oleh Operator Desa','operator','terima','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skm,'skm'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skm.detail',['id'=>$skm->encodeHash($skm->id)]);
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
            $data['skm'] = SKM::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skm.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skm = SKM::find($id);
    //         $skm->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skm');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skm = SKM::find($id);
    //         $skm->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skm');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skm = SKM::find($request->id);
        if(!empty($skm->file_sk_rs)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_kepala_keluarga' => 'required|max:150',
                'no_kk' => 'required|min:16',
                'nik_jenazah' => 'required|min:16|max:16',
                'nama_jenazah' => 'required|max:150',
                'jk_jenazah' => 'required',
                'tgl_lahir_jenazah' => 'required',
                'tempat_lahir' => 'required',
                'agama' => 'required',
                'pekerjaan_id_jenazah' => 'required',
                'alamat_jenazah' => 'required',
                'provinsi_id_jenazah' => 'required',
                'kota_id_jenazah' => 'required',
                'kecamatan_id_jenazah' => 'required',
                'area_id_jenazah' => 'required',
                'kewarganegaraan' => 'required',
                'kebangsaan' => 'required',
                'anak_ke' => 'required',
                'tgl_kematian' => 'required',
                'pukul' => 'required',
                'sebab_kematian' => 'required',
                'tempat_kematian' => 'required',
                'yang_menerangkan' => 'required',
                'nik_ibu' => 'required|max:16|min:16',
                'nama_ibu' => 'required',
                'umur_ibu' => 'required',
                'pekerjaan_id_ibu' => 'required',
                'alamat_ibu' => 'required',
                'provinsi_id_ibu' => 'required',
                'kota_id_ibu' => 'required',
                'kecamatan_id_ibu' => 'required',
                'area_id_ibu' => 'required',
                'nik_ayah' => 'required|max:16|min:16',
                'nama_ayah' => 'required',
                'umur_ayah' => 'required',
                'pekerjaan_id_ayah' => 'required',
                'alamat_ayah' => 'required',
                'provinsi_id_ayah' => 'required',
                'kota_id_ayah' => 'required',
                'kecamatan_id_ayah' => 'required',
                'area_id_ayah' => 'required',
                'nik_pelapor' => 'required|max:16|min:16',
                'nama_pelapor' => 'required',
                'pekerjaan_id_pelapor' => 'required',
                'alamat_pelapor' => 'required',
                'umur_pelapor' => 'required',
                'hubungan' => 'required',
                'nik_saksi1' => 'required|max:16|min:16',
                'nama_saksi1' => 'required',
                'nik_saksi2' => 'required|max:16|min:16',
                'nama_saksi2' => 'required',
                'file_sk_rs' => 'max:1024|mimes:jpeg,jpg,png',
                'file_ktp_pelapor' => 'max:1024|mimes:jpeg,jpg,png',
                'file_ktp_alm' => 'max:1024|mimes:jpeg,jpg,png',
                'file_ktp_saksi' => 'max:1024|mimes:jpeg,jpg,png',
                'kasi_id' => 'required',
            ];
    
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_kepala_keluarga' => 'required|max:150',
                'no_kk' => 'required|min:16',
                'nik_jenazah' => 'required|min:16|max:16',
                'nama_jenazah' => 'required|max:150',
                'jk_jenazah' => 'required',
                'tgl_lahir_jenazah' => 'required',
                'tempat_lahir' => 'required',
                'agama' => 'required',
                'pekerjaan_id_jenazah' => 'required',
                'alamat_jenazah' => 'required',
                'provinsi_id_jenazah' => 'required',
                'kota_id_jenazah' => 'required',
                'kecamatan_id_jenazah' => 'required',
                'area_id_jenazah' => 'required',
                'kewarganegaraan' => 'required',
                'kebangsaan' => 'required',
                'anak_ke' => 'required',
                'tgl_kematian' => 'required',
                'pukul' => 'required',
                'sebab_kematian' => 'required',
                'tempat_kematian' => 'required',
                'yang_menerangkan' => 'required',
                'nik_ibu' => 'required|max:16|min:16',
                'nama_ibu' => 'required',
                'umur_ibu' => 'required',
                'pekerjaan_id_ibu' => 'required',
                'alamat_ibu' => 'required',
                'provinsi_id_ibu' => 'required',
                'kota_id_ibu' => 'required',
                'kecamatan_id_ibu' => 'required',
                'area_id_ibu' => 'required',
                'nik_ayah' => 'required|max:16|min:16',
                'nama_ayah' => 'required',
                'umur_ayah' => 'required',
                'pekerjaan_id_ayah' => 'required',
                'alamat_ayah' => 'required',
                'provinsi_id_ayah' => 'required',
                'kota_id_ayah' => 'required',
                'kecamatan_id_ayah' => 'required',
                'area_id_ayah' => 'required',
                'nik_pelapor' => 'required|max:16|min:16',
                'nama_pelapor' => 'required',
                'pekerjaan_id_pelapor' => 'required',
                'alamat_pelapor' => 'required',
                'umur_pelapor' => 'required',
                'hubungan' => 'required',
                'nik_saksi1' => 'required|max:16|min:16',
                'nama_saksi1' => 'required',
                'nik_saksi2' => 'required|max:16|min:16',
                'nama_saksi2' => 'required',
                
                'file_sk_rs' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_ktp_pelapor' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_ktp_alm' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_ktp_saksi' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kasi_id' => 'required',
            ];
    
        }
        
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter/digit',
            'min' => ':attribute maksimal :min karakter',
        ];

        $label = [
            'no_surat' => 'No Surat',
            'user_id' => 'Nama Pengaju',
            'nama_kepala_keluarga' => 'Nama Kepala Keluarga',
            'no_kk' => 'No Kartu Keluarga',
            'nik_jenazah' => 'NIK Jenazah',
            'nama_jenazah' => 'Nama Jenazah',
            'jk_jenazah' => 'Jenis Kelamin Jenazah',
            'tgl_lahir_jenazah' => 'Tanggal Lahir Jenazah',
            'tempat_lahir' => 'Tempat Lahir Jenazah',
            'agama' => 'Agama Jenazah',
            'pekerjaan_id_jenazah' => 'Pekerjaan Jenazah',
            'alamat_jenazah' => 'Alamat Jenazah',
            'provinsi_id_jenazah' => 'Provinsi Jenazah',
            'kota_id_jenazah' => 'Kota Jenazah',
            'kecamatan_id_jenazah' => 'Kecamatan Jenazah',
            'area_id_jenazah' => 'Desa Jenazah',
            'kewarganegaraan' => 'Kewarganegaraan Jenazah',
            'kebangsaan' => 'Kebangsaan Jenazah',
            'anak_ke' => 'Anak Ke',
            'tgl_kematian' => 'Tanggal Kematian',
            'pukul' => 'Pukul',
            'sebab_kematian' => 'Sebab Kematian',
            'tempat_kematian' => 'Tempat Kematian',
            'yang_menerangkan' => 'Yang Menerangkan',
            'nik_ibu' => 'NIK Ibu',
            'nama_ibu' => 'Nama Ibu',
            'umur_ibu' => 'Umur Ibu',
            'pekerjaan_id_ibu' => 'Pekerjaan Ibu',
            'alamat_ibu' => 'Alamat Ibu',
            'provinsi_id_ibu' => 'Provinsi Ibu',
            'kota_id_ibu' => 'Kota Ibu',
            'kecamatan_id_ibu' => 'Kecamatan Ibu',
            'area_id_ibu' => 'Desa Ibu',
            'nik_ayah' => 'NIK Ayah',
            'nama_ayah' => 'Nama Ayah',
            'umur_ayah' => 'Umur Ayah',
            'pekerjaan_id_ayah' => 'Pekerjaan Ayah',
            'alamat_ayah' => 'Alamat Ayah',
            'provinsi_id_ayah' => 'Provinsi Ayah',
            'kota_id_ayah' => 'Kota Ayah',
            'kecamatan_id_ayah' => 'Kecamatan Ayah',
            'area_id_ayah' => 'Desa Ayah',
            'nik_pelapor' => 'NIK Pelapor',
            'nama_pelapor' => 'Nama Pelapor',
            'pekerjaan_id_pelapor' => 'Pekerjaan Pelapor',
            'alamat_pelapor' => 'Alamat',
            'umur_pelapor' => 'Umur',
            'hubungan' => 'Hubungan',
            'nik_saksi1' => 'NIK Saksi 1',
            'nama_saksi1' => 'Nama Saksi 1',
            'nik_saksi2' => 'NIK Saksi 2',
            'nama_saksi2' => 'Nama Saksi 2',
            
            'file_sk_rs' => 'File SK Rumah Sakit',
            'file_ktp_pelapor' => 'File KTP Pelapor',
            'file_ktp_alm' => 'File KTP Alm',
            'file_ktp_saksi' => 'File KTP Saksi',
            'kasi_id' => 'Kasi',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skm = SKM::find($request->id);
        }

        if($request->file('file_sk_rs')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs)){
                    \File::delete('backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs);
                }
            }
            $sk_rs = $request->file('file_sk_rs');
            $destinationPath = public_path('backend/images/dokumen/skm/sk_rs');
            $nama_sk_rs = 'skm_'.strtolower(str_replace(' ','_',$request->nama_jenazah)).'_'.date('YmdHis').'.'.$sk_rs->getClientOriginalExtension();
            $sk_rs->move($destinationPath,$nama_sk_rs);
        }else{
            if($request->id){
                $nama_sk_rs=$skm->file_sk_rs;
            }
        }

        if($request->file('file_ktp_pelapor')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor)){
                    \File::delete('backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor);
                }
            }
            $ktp_pelapor = $request->file('file_ktp_pelapor');
            $destinationPath = public_path('backend/images/dokumen/skm/ktp_pelapor');
            $nama_ktp_pelapor = 'skm_pelapor_'.strtolower(str_replace(' ','_',$request->nama_jenazah)).'_'.date('YmdHis').$ktp_pelapor->getClientOriginalExtension();
            $ktp_pelapor->move($destinationPath,$nama_ktp_pelapor);
        }else{
            if($request->id){
                $nama_ktp_pelapor=$skm->file_ktp_pelapor;
            }
        }

        if($request->file('file_ktp_alm')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm)){
                    \File::delete('backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm);
                }
            }
            $ktp_alm = $request->file('file_ktp_alm');
            $destinationPath = public_path('backend/images/dokumen/skm/ktp_alm');
            $nama_ktp_alm = 'skm_ktp'.strtolower(str_replace(' ','_',$request->nama_jenazah)).'_'.date('YmdHis').$ktp_alm->getClientOriginalExtension();
            $ktp_alm->move($destinationPath,$nama_ktp_alm);
        }else{
            if($request->id){
                $nama_ktp_alm=$skm->file_ktp_alm;
            }
        }

        if($request->file('file_ktp_saksi')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi)){
                    \File::delete('backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi);
                }
            }
            $ktp_saksi = $request->file('file_ktp_saksi');
            $destinationPath = public_path('backend/images/dokumen/skm/ktp_saksi');
            $nama_ktp_saksi = 'skm_saksi_'.strtolower(str_replace(' ','_',$request->nama_jenazah)).'_'.date('YmdHis').'.'.$ktp_saksi->getClientOriginalExtension();
            $ktp_saksi->move($destinationPath,$nama_ktp_saksi);
        }else{
            if($request->id){
                $nama_ktp_saksi=$skm->file_ktp_saksi;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama_kepala_keluarga' => $request->input('nama_kepala_keluarga'),
            'no_kk' => $request->input('no_kk'),
            'nama_jenazah' => $request->input('nama_jenazah'),
            'nik_jenazah' => $request->input('nik_jenazah'),
            'jk_jenazah' => $request->input('jk_jenazah'),
            'tgl_lahir_jenazah' => $request->input('tgl_lahir_jenazah'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'agama' => $request->input('agama'),
            'pekerjaan_id_jenazah' => $request->input('pekerjaan_id_jenazah'),
            'alamat_jenazah' => $request->input('alamat_jenazah'),
            'provinsi_id_jenazah' => $request->input('provinsi_id_jenazah'),'kota_id_jenazah' => $request->input('kota_id_jenazah'),
            'kecamatan_id_jenazah' => $request->input('kecamatan_id_jenazah'),
            'area_id_jenazah' => $request->input('area_id_jenazah'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'keturunan' => $request->input('keturunan'),
            'kebangsaan' => $request->input('kebangsaan'),
            'anak_ke' => $request->input('anak_ke'),
            'tgl_kematian' => $request->input('tgl_kematian'),
            'pukul' => $request->input('pukul'),
            'sebab_kematian' => $request->input('sebab_kematian'),
            'tempat_kematian' => $request->input('tempat_kematian'),
            'yang_menerangkan' => $request->input('yang_menerangkan'),
            'nik_ibu' => $request->input('nik_ibu'),
            'nama_ibu' => $request->input('nama_ibu'),
            'umur_ibu' => $request->input('umur_ibu'),
            'pekerjaan_id_ibu' => $request->input('pekerjaan_id_ibu'),
            'alamat_ibu' => $request->input('alamat_ibu'),
            'provinsi_id_ibu' => $request->input('provinsi_id_ibu'),
            'kota_id_ibu' => $request->input('kota_id_ibu'),'kecamatan_id_ibu' => $request->input('kecamatan_id_ibu'),
            'area_id_ibu' => $request->input('area_id_ibu'),
            'nik_ayah' => $request->input('nik_ayah'),
            'nama_ayah' => $request->input('nama_ayah'),
            'umur_ayah' => $request->input('umur_ayah'),
            'pekerjaan_id_ayah' => $request->input('pekerjaan_id_ayah'),
            'alamat_ayah' => $request->input('alamat_ayah'),'provinsi_id_ayah' => $request->input('provinsi_id_ayah'),
            'kota_id_ayah' => $request->input('kota_id_ayah'),
            'kecamatan_id_ayah' => $request->input('kecamatan_id_ayah'),
            'area_id_ayah' => $request->input('area_id_ayah'),
            'nik_pelapor' => $request->input('nik_pelapor'),
            'nama_pelapor' => $request->input('nama_pelapor'),
            'pekerjaan_id_pelapor' => $request->input('pekerjaan_id_pelapor'),
            'umur_pelapor' => $request->input('umur_pelapor'),
            'alamat_pelapor' => $request->input('alamat_pelapor'),
            'hubungan' => $request->input('hubungan'),
            'nik_saksi1' => $request->input('nik_saksi1'),
            'nama_saksi1' => $request->input('nama_saksi1'),
            'nik_saksi2' => $request->input('nik_saksi2'),
            'nama_saksi2' => $request->input('nama_saksi2'),
            
            'file_sk_rs' => $nama_sk_rs,
            'file_ktp_pelapor' => $nama_ktp_pelapor,
            'file_ktp_alm' => $nama_ktp_alm,
            'file_ktp_saksi' => $nama_ktp_saksi,
        ];

        return $data;
    }

    public function print(Request $request)
    {
        
        try{
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skm')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skm/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skm = SKM::find($id);
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

            $generateFile = (new GenerateFileAction)->run($skm->id,'skm');
            $signDokumen = (new SignDokumenAction)->run($id,'skm',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){

                $skm->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian Telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kematian disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','operator')->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skm,'skm'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skm');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skm.detail',['id'=>$skm->encodeHash($skm->id)])->with('error',$signDokumen);
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
            $skm = SKM::find($id);
            $skm->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kematian disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','kepala_desa')->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skm,'skm'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skm');
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
            $skm = SKM::find($id);
            $skm->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kematian disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','sekretaris_desa')->first();
            DB::commit();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skm,'skm'));
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skm');
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
            $skm = SKM::find($id);

            if(\File::exists('backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs)){
                \File::delete('backend/images/dokumen/skm/sk_rs/'.$skm->file_sk_rs);
            }

            if(\File::exists('backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor)){
                \File::delete('backend/images/dokumen/skm/ktp_pelapor/'.$skm->file_ktp_pelapor);
            }

            if(\File::exists('backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm)){
                \File::delete('backend/images/dokumen/skm/ktp_alm/'.$skm->file_ktp_alm);
            }
            if(\File::exists('backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi)){
                \File::delete('backend/images/dokumen/skm/ktp_saksi/'.$skm->file_ktp_saksi);
            }

            $skm->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skm');
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
            $skm = SKM::find($id);
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
            $log = (new NotifikasiSuketAction)->run($skm,'skm','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skm');
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
            $skm = SKM::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_kematian,no_surat,'.$skm->id,
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

            $skm->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skm,'skm','Verifikasi','Pengajuan Surat Keterangan Kematian telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Kematian disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skm');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}