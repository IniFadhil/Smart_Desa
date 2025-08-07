<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\GenerateFileAction;
use App\Actions\SignDokumenAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKTM;
use App\Models\User;
use App\Models\Admin;
use App\Models\ProfilDesa;
use App\Models\LogSuket;
use App\Models\Dokumen;
use App\Mail\SuketMail;
use Str;
use Auth;
use PDF;
use Mail;
use Validator;
use Session;
use App\Actions\PassphraseLogAction;
use DB;

class SktmController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:sktm');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['sktm'] =SKTM::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['sktm'] =SKTM::where('desa_id',current_user('admin')->desa_id)->orderBy('status','asc')->orderBy('created_at','asc')->get();
            }
            return view('backend.dokumen.sktm.list',$data);
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
            return view('backend.dokumen.sktm.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sktm');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $sktm =SKTM::create($data);
            $generateFile = (new GenerateFileAction)->run($sktm->id,'sktm');
            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Tidak Mampu disetujui oleh operator desa');
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.sktm.detail',['id'=>$sktm->encodeHash($sktm->id)]);
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
            $data['sktm'] = SKTM::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sktm.edit',$data);
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
            $sktm = SKTM::find($id);
            $sktm->update($data);
            $generateFile = (new GenerateFileAction)->run($sktm->id,'sktm');
            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.sktm.detail',['id'=>$sktm->encodeHash($sktm->id)]);
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
            $data['sktm'] =SKTM::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sktm.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {
        $sktm = SKTM::find($request->id);
        if(!empty($sktm->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'warga_negara' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'nama_ayah' => 'required|max:150',
                'nama_ibu' => 'required|max:150',
                'alamat_orangtua' => 'required|min:6',
                'kasi_id' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
            ];
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'warga_negara' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'nama_ayah' => 'required|max:150',
                'nama_ibu' => 'required|max:150',
                'alamat_orangtua' => 'required|min:6',
                'kasi_id' => 'required',
                'rtrw' => 'required|max:1024|mimes:jpeg,jpg,png',
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
            'no_surat' => 'Nomor Surat',
            'user_id' => 'Nama Pengaju',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'warga_negara' => 'Warga Negara',
            'agama' => 'Agama',
            'alamat' => 'Alamat',
            'kota_id' => 'Kota',
            'kecamatan_id' => 'Kecamatan',
            'area_id' => 'Desa',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'alamat_orangtua' => 'Alamat Orangtua',
            'kota_id_orangtua' => 'Kota',
            'kecamatan_id_orangtua' => 'Kecamatan',
            'area_id_orangtua' => 'Desa',
            'kasi_id' => 'Kirim Ke Kasi',
            'rtrw' => 'File Surat Pengantar RTRW',
            'ktp' => 'File KTP',
            'kk' => 'File Kartu Keluarga',
            'surat_pernyataan' => 'File Surat Pernyataan',
        ];

        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $sktm = SKTM::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('storage/backend/images/dokumen/sktm/rtrw/'.$sktm->file_sp_rtrw)){
                    \File::delete('storage/backend/images/dokumen/sktm/rtrw/'.$sktm->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('storage/backend/images/dokumen/sktm/rtrw');
            $nama_rtrw = \Str::uuid().'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$sktm->file_sp_rtrw;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('storage/backend/images/dokumen/sktm/surat_pernyataan/'.$sktm->file_surat_pernyataan)){
                    \File::delete('storage/backend/images/dokumen/sktm/surat_pernyataan/'.$sktm->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('storage/backend/images/dokumen/sktm/surat_pernyataan');
            $nama_surat_pernyataan = \Str::uuid().'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$sktm->file_surat_pernyataan;
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
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'alamat_orangtua' => $request->input('alamat_orangtua'),
            'kota_id_orangtua' => Session::get('kota_id'),
            'kecamatan_id_orangtua' => Session::get('kecamatan_id'),
            'area_id_orangtua' => Session::get('desa_id'),
            'file_sp_rtrw' => $nama_rtrw,
            'file_ktp' => User::find($request->user_id)->unggahDokumen->file_ktp,
            'file_kk' => User::find($request->user_id)->unggahDokumen->file_kk,
            'file_surat_pernyataan' => $nama_surat_pernyataan,
        ];

        return $data;
    }

    public function print(Request $request)
    {
        try{
            // set_time_limit(500);
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','sktm')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/sktm/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return redirect()->route('backend.dokumen.sktm');
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $sktm = SKTM::find($id);

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

            $generateFile = (new GenerateFileAction)->run($sktm->id,'sktm');
            $signDokumen = (new SignDokumenAction)->run($id,'sktm',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $sktm->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Tidak Mampu disetujui oleh kepala desa');
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.sktm');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.sktm.detail',['id'=>$sktm->encodeHash($sktm->id)])->with('error',$signDokumen);
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
            $sktm = SKTM::find($id);
            $sktm->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Tidak Mampu disetujui oleh sekretaris desa');
            
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sktm');
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
            $sktm = SKTM::find($id);
            $sktm->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Tidak Mampu disetujui oleh kasi desa');
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sktm');
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
            $sktm = SKTM::find($id);

            if(\File::exists('storage/backend/images/dokumen/sktm/rtrw/'.$sktm->file_sp_rtrw)){
                \File::delete('storage/backend/images/dokumen/sktm/rtrw/'.$sktm->file_sp_rtrw);
            }

            if(\File::exists('storage/backend/images/dokumen/sktm/surat_pernyataan/'.$sktm->file_surat_pernyataan)){
                \File::delete('storage/backend/images/dokumen/sktm/surat_pernyataan/'.$sktm->file_surat_pernyataan);
            }

            $log = LogSuket::where(['suket_id' => $sktm->id,'jenis_suket'=>'sktm'])->delete();
            $file = Dokumen::where(['suket_id' => $sktm->id,'jenis'=>'sktm'])->first();

            if(\File::exists('storage/surat/sktm/'.$file->dokumen)){
                \File::delete('storage/surat/sktm/'.$file->dokumen);
            }

            $file->delete();
            $sktm->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.sktm');
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
            $sktm = SKTM::find($id);

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

            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.sktm');
        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function accepted(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $sktm = SKTM::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sktm,no_surat,'.$sktm->id,
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

            $sktm->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($sktm,'sktm','Verifikasi','Pengajuan Surat Keterangan Tidak Mampu telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Tidak Mampu disetujui oleh operator desa');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sktm');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
