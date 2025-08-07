<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKK;
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

class SkkController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skk');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skk'] = SKK::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skk'] = SKK::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skk.list',$data);
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
            $data['provinsi'] = Provinsi::get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skk.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_kelahiran');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skk = SKK::create($data);
            $generateFile = (new GenerateFileAction)->run($skk->id,'skk');

            $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran Telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Kelahiran disetujui oleh operator desa ');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skk,'skk'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skk.detail',['id'=>$skk->encodeHash($skk->id)]);
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
            $data['pekerjaan'] = Pekerjaan::get();
            $data['provinsi'] = Provinsi::get();
            $data['kota'] = Kota::get();
            $data['kecamatan'] = Kecamatan::get();
            $data['area'] = Desa::get();
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['skk'] =  SKK::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skk.edit',$data);
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
            $skk = SKK::find($id);
            $skk->update($data);
            $generateFile = (new GenerateFileAction)->run($skk->id,'skk');

            $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran Telah di verifikasi Oleh Operator Desa','operator','terima');

            DB::commit();
        // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skk,'skk'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skk.detail',['id'=>$skk->encodeHash($skk->id)]);
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
            $data['skk'] = SKK::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skk.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skk = SKK::find($id);
    //         $skk->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skk');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skk = SKK::find($id);
    //         $skk->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skk');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skk = SKK::find($request->id);
        if(!empty($skk->file_sk_kelahiran)){
            $rules = [
                'no_surat' => 'required|max:150',
                // 'nama_kepala_keluarga' => 'required|max:150',
                // 'no_kk' => 'required|min:16',
                // 'nama_bayi' => 'required|max:150',
                // 'tempat_dilahirkan' => 'required|max:150',
                // 'tempat_lahir' => 'required|max:150',
                // 'jk_bayi' => 'required|max:150',
                // 'hari' => 'required|max:150',
                // 'tgl_lahir_bayi' => 'required|max:190',
                // 'pukul' => 'required',
                // 'jenis_kelahiran' => 'required',
                // 'kelahiran_ke' => 'required',
                // 'penolong_kelahiran' => 'required',
                // 'panjang_bayi' => 'required',
                // 'berat_bayi' => 'required',
                // 'nik_ibu' => 'required|max:16|min:16',
                // 'nama_ibu' => 'required',
                // 'tgl_lahir_ibu' => 'required',
                // 'pekerjaan_id_ibu' => 'required',
                // 'alamat_ibu' => 'required',
                // 'provinsi_id_ibu' => 'required',
                // 'kota_id_ibu' => 'required',
                // 'kecamatan_id_ibu' => 'required',
                // 'area_id_ibu' => 'required',
                // 'kewarganegaraan_ibu' => 'required',
                // 'kebangsaan_ibu' => 'required',
                // 'tgl_pencatatan_perkawinan' => 'required',
                // 'nik_ayah' => 'required|max:16|min:16',
                // 'nama_ayah' => 'required',
                // 'tgl_lahir_ayah' => 'required',
                // 'pekerjaan_id_ayah' => 'required',
                // 'alamat_ayah' => 'required',
                // 'provinsi_id_ayah' => 'required',
                // 'kota_id_ayah' => 'required',
                // 'kecamatan_id_ayah' => 'required',
                // 'area_id_ayah' => 'required',
                // 'kewarganegaraan_ayah' => 'required',
                // 'kebangsaan_ayah' => 'required',
                // 'nik_pelapor' => 'required|max:16|min:16',
                // 'nama_pelapor' => 'required',
                // 'umur_pelapor' => 'required',
                // 'jk_pelapor' => 'required',
                // 'pekerjaan_id_pelapor' => 'required',
                // 'alamat_pelapor' => 'required',
                // 'provinsi_id_pelapor' => 'required',
                // 'kota_id_pelapor' => 'required',
                // 'kecamatan_id_pelapor' => 'required',
                // 'area_id_pelapor' => 'required',
                // 'nik_saksi1' => 'required|max:16|min:16',
                // 'nama_saksi1' => 'required',
                // 'umur_saksi1' => 'required',
                // 'pekerjaan_id_saksi1' => 'required',
                // 'alamat_saksi1' => 'required',
                // 'provinsi_id_saksi1' => 'required',
                // 'kota_id_saksi1' => 'required',
                // 'kecamatan_id_saksi1' => 'required',
                // 'area_id_saksi1' => 'required',
                // 'nik_saksi2' => 'required|max:16|min:16',
                // 'nama_saksi2' => 'required',
                // 'umur_saksi2' => 'required',
                // 'pekerjaan_id_saksi2' => 'required',
                // 'alamat_saksi2' => 'required',
                // 'provinsi_id_saksi2' => 'required',
                // 'kota_id_saksi2' => 'required',
                // 'kecamatan_id_saksi2' => 'required',
                // 'area_id_saksi2' => 'required',
                // 'file_sk_kelahiran' => 'max:1024|mimes:jpeg,jpg,png',
                // 'file_surat_nikah' => 'max:1024|mimes:jpeg,jpg,png',
                // 'file_kk' => 'max:1024|mimes:jpeg,jpg,png',
                // 'file_ayah' => 'max:1024|mimes:jpeg,jpg,png',
                // 'file_ibu' => 'max:1024|mimes:jpeg,jpg,png',
                'kasi_id' => 'required',
            ];
    
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_kepala_keluarga' => 'required|max:150',
                'no_kk' => 'required|min:16',
                'nama_bayi' => 'required|max:150',
                'tempat_dilahirkan' => 'required|max:150',
                'tempat_lahir' => 'required|max:150',
                'jk_bayi' => 'required|max:150',
                'hari' => 'required|max:150',
                'tgl_lahir_bayi' => 'required|max:190',
                'pukul' => 'required',
                'jenis_kelahiran' => 'required',
                'kelahiran_ke' => 'required',
                'penolong_kelahiran' => 'required',
                'panjang_bayi' => 'required',
                'berat_bayi' => 'required',
                'nik_ibu' => 'required|max:16|min:16',
                'nama_ibu' => 'required',
                'tgl_lahir_ibu' => 'required',
                'pekerjaan_id_ibu' => 'required',
                'alamat_ibu' => 'required',
                'provinsi_id_ibu' => 'required',
                'kota_id_ibu' => 'required',
                'kecamatan_id_ibu' => 'required',
                'area_id_ibu' => 'required',
                'kewarganegaraan_ibu' => 'required',
                'kebangsaan_ibu' => 'required',
                'tgl_pencatatan_perkawinan' => 'required',
                'nik_ayah' => 'required|max:16|min:16',
                'nama_ayah' => 'required',
                'tgl_lahir_ayah' => 'required',
                'pekerjaan_id_ayah' => 'required',
                'alamat_ayah' => 'required',
                'provinsi_id_ayah' => 'required',
                'kota_id_ayah' => 'required',
                'kecamatan_id_ayah' => 'required',
                'area_id_ayah' => 'required',
                'kewarganegaraan_ayah' => 'required',
                'kebangsaan_ayah' => 'required',
                'nik_pelapor' => 'required|max:16|min:16',
                'nama_pelapor' => 'required',
                'umur_pelapor' => 'required',
                'jk_pelapor' => 'required',
                'pekerjaan_id_pelapor' => 'required',
                'alamat_pelapor' => 'required',
                'provinsi_id_pelapor' => 'required',
                'kota_id_pelapor' => 'required',
                'kecamatan_id_pelapor' => 'required',
                'area_id_pelapor' => 'required',
                'nik_saksi1' => 'required|max:16|min:16',
                'nama_saksi1' => 'required',
                'umur_saksi1' => 'required',
                'jk_saksi1' => 'required',
                'pekerjaan_id_saksi1' => 'required',
                'alamat_saksi1' => 'required',
                'provinsi_id_saksi1' => 'required',
                'kota_id_saksi1' => 'required',
                'kecamatan_id_saksi1' => 'required',
                'area_id_saksi1' => 'required',
                'nik_saksi2' => 'required|max:16|min:16',
                'nama_saksi2' => 'required',
                'umur_saksi2' => 'required',
                'jk_saksi2' => 'required',
                'pekerjaan_id_saksi2' => 'required',
                'alamat_saksi2' => 'required',
                'provinsi_id_saksi2' => 'required',
                'kota_id_saksi2' => 'required',
                'kecamatan_id_saksi2' => 'required',
                'area_id_saksi2' => 'required',
                'file_sk_kelahiran' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_surat_nikah' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_kk' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_ayah' => 'required|max:1024|mimes:jpeg,jpg,png',
                'file_ibu' => 'required|max:1024|mimes:jpeg,jpg,png',
                'kasi_id' => 'required',
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
            'nama_kepala_keluarga' => 'Nama Kepala Keluarga',
            'no_kk' => 'No Kartu Keluarga',
            'nama_bayi' => 'Nama Bayi',
            'tempat_dilahirkan' => 'Tempat Dilahirkan',
            'tempat_lahir' => 'Tempat Lahir',
            'jk_bayi' => 'Jenis Kelamin Bayi',
            'hari' => 'Hari',
            'tgl_lahir_bayi' => 'Tanggal Lahir Bayi',
            'pukul' => 'Pukul',
            'jenis_kelahiran' => 'Jenis Kelamin',
            'kelahiran_ke' => 'Kelahiran Ke',
            'penolong_kelahiran' => 'Panjang Bayi',
            'panjang_bayi' => 'Panjang Bayi',
            'berat_bayi' => 'Berat Bayi',
            'nik_ibu' => 'NIK Ibu',
            'nama_ibu' => 'Nama Ibu',
            'tgl_lahir_ibu' => 'Tanggal Lahir Ibu',
            'pekerjaan_id_ibu' => 'Pekerjaan Ibu',
            'alamat_ibu' => 'Alamat Ibu',
            'provinsi_id_ibu' => 'Provinsi',
            'kota_id_ibu' => 'Kota',
            'kecamatan_id_ibu' => 'Kecamatan',
            'area_id_ibu' => 'Desa',
            'kewarganegaraan_ibu' => 'Kewarganegaraan',
            'kebangsaan_ibu' => 'Kebangsaan',
            'tgl_pencatatan_perkawinan' => 'Tanggal Pencatatan Perkawinan',
            'nik_ayah' => 'NIK Ayah',
            'nama_ayah' => 'Nama Ayah',
            'tgl_lahir_ayah' => 'Tanggal Lahir Ayah',
            'pekerjaan_id_ayah' => 'Pekerjaan Ayah',
            'alamat_ayah' => 'Alamat Ayah',
            'provinsi_id_ayah' => 'Provinsi',
            'kota_id_ayah' => 'Kota',
            'kecamatan_id_ayah' => 'Kecamatan',
            'area_id_ayah' => 'Desa',
            'kewarganegaraan_ayah' => 'Kewarganegaraan',
            'kebangsaan_ayah' => 'Kebangsaan',
            'nik_pelapor' => 'NIK Pelapor',
            'nama_pelapor' => 'Nama Pelapor',
            'umur_pelapor' => 'Umur Pelapor',
            'jk_pelapor' => 'Jenis Kelamin Pelapor',
            'pekerjaan_id_pelapor' => 'Pekerjaan Pelapor',
            'alamat_pelapor' => 'Alamat Pelapor',
            'provinsi_id_pelapor' => 'Provinsi Pelapor',
            'kota_id_pelapor' => 'Kota',
            'kecamatan_id_pelapor' => ' Kecamatan',
            'area_id_pelapor' => 'Desa',
            'nik_saksi1' => 'NIK Saksi 1',
            'nama_saksi1' => 'Nama Saksi 1',
            'umur_saksi1' => 'Umur Saksi 1',
            'jk_saksi1' => 'Jenis Kelamin Saksi 1',
            'pekerjaan_id_saksi1' => 'Pekerjaan Saksi 1',
            'alamat_saksi1' => 'Alamat Saksi 1',
            'provinsi_id_saksi1' => 'Provinsi',
            'kota_id_saksi1' => 'Kota',
            'kecamatan_id_saksi1' => 'Kecamatan',
            'area_id_saksi1' => 'Desa',
            'nik_saksi2' => 'NIK Saksi 2',
            'nama_saksi2' => 'Nama Saksi 2',
            'jk_saksi2' => 'Jenis Kelamin Saksi 2',
            'umur_saksi2' => 'Umur Saksi 2',
            'pekerjaan_id_saksi2' => 'Pekerjaan Saksi 2',
            'alamat_saksi2' => 'Alamat Saksi 2',
            'provinsi_id_saksi2' => 'Provinsi',
            'kota_id_saksi2' => 'Kota',
            'kecamatan_id_saksi2' => 'Kecamatan',
            'area_id_saksi2' => 'Desa',
            'file_sk_kelahiran' => 'File SK Kelahiran',
            'file_surat_nikah' => 'File Surat Nikah',
            'file_kk' => 'File KK',
            'file_ayah' => 'File KTP Ayah',
            'file_ibu' => 'File KTP Ibu',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $skk = SKK::find($request->id);
        }

        if($request->file('file_sk_kelahiran')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran)){
                    \File::delete('backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran);
                }
            }
            $sk_kelahiran = $request->file('file_sk_kelahiran');
            $destinationPath = public_path('backend/images/dokumen/skk/sk_kelahiran');
            $nama_sk_kelahiran = 'skk_'.strtolower(str_replace(' ','_',$request->nama_bayi)).'_'.date('YmdHis').'.'.$sk_kelahiran->getClientOriginalExtension();
            $sk_kelahiran->move($destinationPath,$nama_sk_kelahiran);
        }else{
            if($request->id){
                $nama_sk_kelahiran=$skk->file_sk_kelahiran;
            }
        }

        if($request->file('file_surat_nikah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah)){
                    \File::delete('backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah);
                }
            }
            $surat_nikah = $request->file('file_surat_nikah');
            $destinationPath = public_path('backend/images/dokumen/skk/surat_nikah');
            $nama_surat_nikah = 'skk_nikah_'.strtolower(str_replace(' ','_',$request->nama_bayi)).'_'.date('YmdHis').$surat_nikah->getClientOriginalExtension();
            $surat_nikah->move($destinationPath,$nama_surat_nikah);
        }else{
            if($request->id){
                $nama_surat_nikah=$skk->file_surat_nikah;
            }
        }

        if($request->file('file_kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skk/kk/'.$skk->file_kk)){
                    \File::delete('backend/images/dokumen/skk/kk/'.$skk->file_kk);
                }
            }
            $kk = $request->file('file_kk');
            $destinationPath = public_path('backend/images/dokumen/skk/kk');
            $nama_kk = 'skk_kk'.strtolower(str_replace(' ','_',$request->nama_bayi)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skk->file_kk;
            }
        }

        if($request->file('file_ayah')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah)){
                    \File::delete('backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah);
                }
            }
            $file_ayah = $request->file('file_ayah');
            $destinationPath = public_path('backend/images/dokumen/skk/file_ayah');
            $nama_file_ayah = 'skk_file_ayah_'.strtolower(str_replace(' ','_',$request->nama_bayi)).'_'.date('YmdHis').'.'.$file_ayah->getClientOriginalExtension();
            $file_ayah->move($destinationPath,$nama_file_ayah);
        }else{
            if($request->id){
                $nama_file_ayah=$skk->file_ayah;
            }
        }

        if($request->file('file_ibu')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu)){
                    \File::delete('backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu);
                }
            }
            $file_ibu = $request->file('file_ibu');
            $destinationPath = public_path('backend/images/dokumen/skk/file_ibu');
            $nama_file_ibu = 'skk_file_ibu_'.strtolower(str_replace(' ','_',$request->nama_bayi)).'_'.date('YmdHis').'.'.$file_ibu->getClientOriginalExtension();
            $file_ibu->move($destinationPath,$nama_file_ibu);
        }else{
            if($request->id){
                $nama_file_ibu=$skk->file_ibu;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama_kepala_keluarga' => $request->input('nama_kepala_keluarga'),
            'no_kk' => $request->input('no_kk'),
            'nama_bayi' => $request->input('nama_bayi'),
            'jk_bayi' => $request->input('jk_bayi'),
            'tempat_dilahirkan' => $request->input('tempat_dilahirkan'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'hari' => $request->input('hari'),
            'tgl_lahir_bayi' => $request->input('tgl_lahir_bayi'),
            'pukul' => $request->input('pukul'),
            'jenis_kelahiran' => $request->input('jenis_kelahiran'),
            'kelahiran_ke' => $request->input('kelahiran_ke'),'penolong_kelahiran' => $request->input('penolong_kelahiran'),
            'berat_bayi' => $request->input('berat_bayi'),
            'panjang_bayi' => $request->input('panjang_bayi'),
            'nik_ibu' => $request->input('nik_ibu'),
            'nama_ibu' => $request->input('nama_ibu'),
            'tgl_lahir_ibu' => $request->input('tgl_lahir_ibu'),
            'pekerjaan_id_ibu' => $request->input('pekerjaan_id_ibu'),
            'alamat_ibu' => $request->input('alamat_ibu'),
            'provinsi_id_ibu' => $request->input('provinsi_id_ibu'),
            'kota_id_ibu' => $request->input('kota_id_ibu'),'kecamatan_id_ibu' => $request->input('kecamatan_id_ibu'),
            'area_id_ibu' => $request->input('area_id_ibu'),
            'kewarganegaraan_ibu' => $request->input('kewarganegaraan_ibu'),
            'kebangsaan_ibu' => $request->input('kebangsaan_ibu'),
            'tgl_pencatatan_perkawinan' => $request->input('tgl_pencatatan_perkawinan'),
            'nik_ayah' => $request->input('nik_ayah'),
            'nama_ayah' => $request->input('nama_ayah'),
            'tgl_lahir_ayah' => $request->input('tgl_lahir_ayah'),
            'pekerjaan_id_ayah' => $request->input('pekerjaan_id_ayah'),
            'alamat_ayah' => $request->input('alamat_ayah'),
            'provinsi_id_ayah' => $request->input('provinsi_id_ayah'),
            'kota_id_ayah' => $request->input('kota_id_ayah'),
            'kecamatan_id_ayah' => $request->input('kecamatan_id_ayah'),
            'area_id_ayah' => $request->input('area_id_ayah'),
            'kewarganegaraan_ayah' => $request->input('kewarganegaraan_ayah'),
            'kebangsaan_ayah' => $request->input('kebangsaan_ayah'),
            'nik_pelapor' => $request->input('nik_pelapor'),
            'nama_pelapor' => $request->input('nama_pelapor'),
            'umur_pelapor' => $request->input('umur_pelapor'),
            'jk_pelapor' => $request->input('jk_pelapor'),
            'pekerjaan_id_pelapor' => $request->input('pekerjaan_id_pelapor'),
            'alamat_pelapor' => $request->input('alamat_pelapor'),
            'provinsi_id_pelapor' => $request->input('provinsi_id_pelapor'),
            'kota_id_pelapor' => $request->input('kota_id_pelapor'),
            'kecamatan_id_pelapor' => $request->input('kecamatan_id_pelapor'),
            'area_id_pelapor' => $request->input('area_id_pelapor'),
            'nik_saksi1' => $request->input('nik_saksi1'),
            'nama_saksi1' => $request->input('nama_saksi1'),
            'umur_saksi1' => $request->input('umur_saksi1'),
            'jk_saksi1' => $request->input('jk_saksi1'),
            'pekerjaan_id_saksi1' => $request->input('pekerjaan_id_saksi1'),
            'alamat_saksi1' => $request->input('alamat_saksi1'),
            'provinsi_id_saksi1' => $request->input('provinsi_id_saksi1'),
            'kota_id_saksi1' => $request->input('kota_id_saksi1'),
            'kecamatan_id_saksi1' => $request->input('kecamatan_id_saksi1'),
            'area_id_saksi1' => $request->input('area_id_saksi1'),
            'nik_saksi2' => $request->input('nik_saksi2'),
            'nama_saksi2' => $request->input('nama_saksi2'),
            'umur_saksi2' => $request->input('umur_saksi2'),
            'jk_saksi2' => $request->input('jk_saksi2'),
            'pekerjaan_id_saksi2' => $request->input('pekerjaan_id_saksi2'),
            'alamat_saksi2' => $request->input('alamat_saksi2'),
            'provinsi_id_saksi2' => $request->input('provinsi_id_saksi2'),
            'kota_id_saksi2' => $request->input('kota_id_saksi2'),
            'kecamatan_id_saksi2' => $request->input('kecamatan_id_saksi2'),
            'area_id_saksi2' => $request->input('area_id_saksi2'),
            'file_sk_kelahiran' => $nama_sk_kelahiran,
            'file_surat_nikah' => $nama_surat_nikah,
            'file_kk' => $nama_kk,
            'file_ibu' => $nama_file_ibu,
            'file_ayah' => $nama_file_ayah,
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skk')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skk/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skk = SKK::find($id);
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

            $generateFile = (new GenerateFileAction)->run($skk->id,'skk');
            $signDokumen = (new SignDokumenAction)->run($id,'skk',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skk->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran Telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kelahiran disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','operator')->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skk,'skk'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skk');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skk.detail',['id'=>$skk->encodeHash($skk->id)])->with('error',$signDokumen);
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
            $skk = SKK::find($id);
            $skk->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kelahiran disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','kepala_desa')->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skk,'skk'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skk');
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
            $skk = SKK::find($id);
            $skk->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Kelahiran disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','sekretaris_desa')->first();
            
            // Mail::to($admin->email)->send(new SuketMail($admin,$skk,'skk'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skk');
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
            $skk = SKK::find($id);

            if(\File::exists('backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran)){
                \File::delete('backend/images/dokumen/skk/sk_kelahiran/'.$skk->file_sk_kelahiran);
            }

            if(\File::exists('backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah)){
                \File::delete('backend/images/dokumen/skk/surat_nikah/'.$skk->file_surat_nikah);
            }

            if(\File::exists('backend/images/dokumen/skk/kk/'.$skk->file_kk)){
                \File::delete('backend/images/dokumen/skk/kk/'.$skk->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu)){
                \File::delete('backend/images/dokumen/skk/file_ibu/'.$skk->file_ibu);
            }
            if(\File::exists('backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah)){
                \File::delete('backend/images/dokumen/skk/file_ayah/'.$skk->file_ayah);
            }

            $skk->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skk');
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
            $skk = SKK::find($id);
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

            $log = (new NotifikasiSuketAction)->run($skk,'skk','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skk');
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
            $skk = SKK::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_kelahiran,no_surat,'.$skk->id,
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

            $skk->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skk,'skk','Verifikasi','Pengajuan Surat Keterangan Kelahiran telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Kelahiran disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skk');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
