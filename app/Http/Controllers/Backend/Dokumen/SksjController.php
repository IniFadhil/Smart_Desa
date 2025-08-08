<?php
namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKSJ;
use App\Models\Pekerjaan;
use App\Models\Admin;
use App\Models\User;
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

class SksjController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:sksj');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['sksj'] =SKSJ::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['sksj'] =SKSJ::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.sksj.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            $data['pekerjaan'] = Pekerjaan::get();
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sksj.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_sapu_jagat');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $sksj =SKSJ::create($data);
            $generateFile = (new GenerateFileAction)->run($sksj->id,'sksj');
            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat Berhasil dan Telah di verifikasi','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Sapu Jagat disetujui oleh operator desa');
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.sksj.detail',['id'=>$sksj->encodeHash($sksj->id)]);
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
            $data['sksj'] = SKSJ::find($id);
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['pekerjaan'] = Pekerjaan::get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sksj.edit',$data);
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
            $sksj = SKSJ::find($id);
            $generateFile = (new GenerateFileAction)->run($sksj->id,'sksj');
            $sksj->update($data);
            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat Telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.sksj.detail',['id'=>$sksj->encodeHash($sksj->id)]);
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
            $data['sksj'] =SKSJ::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sksj.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    private function validasiForm($request)
    {
        $sksj = SKSJ::find($request->id);
        if(!empty($sksj->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_pejabat' => 'required|max:150',
                'jabatan' => 'required|max:150',
                'alamat' => 'required',
                'nama_penduduk' => 'required|max:150',
                'umur' => 'required',
                'pekerjaan_id' => 'required',
                'no_nik' => 'required|max:16',
                'tgl_menetap' => 'required',
                'alamat_kantor' => 'required|min:6',
                'kasi_id' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
            ];
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama_pejabat' => 'required|max:150',
                'jabatan' => 'required|max:150',
                'alamat' => 'required',
                'nama_penduduk' => 'required|max:150',
                'umur' => 'required',
                'pekerjaan_id' => 'required',
                'no_nik' => 'required|max:16',
                'tgl_menetap' => 'required',
                'alamat_kantor' => 'required|min:6',
                'kasi_id' => 'required',
                'rtrw' => 'required|max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'required|max:1024|mimes:jpeg,jpg,png',
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
            'no_surat' => 'Nama Pengaju',
            'nama_pejabat' => 'Nama',
            'jabatan' => 'Jabatan',
            'alamat' => 'Alamat',
            'nama_penduduk' => 'Nama',
            'umur' => 'Umur',
            'pekerjaan_id' => 'Pekerjaan',
            'no_nik' => 'KTP/SIM',
            'tgl_menetap' => 'Mulai Menetap',
            'alamat_kantor' => 'Alamat',
            'kasi_id' => 'Kirim Ke Kasi',
            'rtrw' => 'File Surat Pengantar RTRW',
            'ktp' => 'File KTP',
            'surat_pernyataan' => 'File Surat Pernyataan',
        ];
        $this->validate($request,$rules,$messages,$label);
    }

    public function bindData($request)
    {
        if(!empty($request->id)){
            $sksj = SKSJ::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sksj/rtrw/'.$sksj->file_sp_rtrw)){
                    \File::delete('backend/images/dokumen/sksj/rtrw/'.$sksj->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('backend/images/dokumen/sksj/rtrw');
            $nama_rtrw = 'sksj_rtrw_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$sksj->file_sp_rtrw;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sksj/ktp/'.$sksj->file_ktp)){
                    \File::delete('backend/images/dokumen/sksj/ktp/'.$sksj->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/sksj/ktp');
            $nama_ktp = 'sksj_ktp_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$sksj->file_ktp;
            }
        }
        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sksj/surat_pernyataan/'.$sksj->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/sksj/surat_pernyataan/'.$sksj->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/sksj/surat_pernyataan');
            $nama_surat_pernyataan = 'sksj_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$sksj->file_surat_pernyataan;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'nama_pejabat' => $request->input('nama_pejabat'),
            'jabatan' => $request->input('jabatan'),
            'alamat' => $request->input('alamat'),
            'nama_penduduk' => $request->input('nama_penduduk'),
            'umur' => $request->input('umur'),
            'no_nik' => $request->input('no_nik'),
            'pekerjaan_id' => $request->input('pekerjaan_id'),
            'alamat_kantor' => $request->input('alamat_kantor'),
            'keperluan' => $request->input('keperluan'),
            'tgl_menetap' => $request->input('tgl_menetap'),
            'file_sp_rtrw' => $nama_rtrw,
            'file_ktp' => $nama_ktp,
            'file_surat_pernyataan' => $nama_surat_pernyataan,
        ];
        return $data;
    }

    public function print(Request $request)
    {
        try{
            // set_time_limit(500);
            $id = $this->decodeHash($request->id);
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','sksj')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }
            $namaFile = $dokumen->dokumen;
            return response()->download(public_path('storage/surat/sksj/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return redirect()->route('backend.dokumen.sksj');
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $sksj = SKSJ::find($id);
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

            $generateFile = (new GenerateFileAction)->run($sksj->id,'sksj');
            $signDokumen = (new SignDokumenAction)->run($id,'sksj',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $sksj->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat Telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Sapu Jagat disetujui oleh kepala desa');

                DB::commit();
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.sksj');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.sksj.detail',['id'=>$sksj->encodeHash($sksj->id)])->with('error',$signDokumen);
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
            $sksj = SKSJ::find($id);
            $sksj->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Sapu Jagat disetujui oleh sekretaris desa');

            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sksj');
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
            $sksj = SKSJ::find($id);
            $sksj->update(['verifikasi_kasi' => 1]);
            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sksj');
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
            $sksj = SKSJ::find($id);
            if(\File::exists('backend/images/dokumen/sksj/rtrw/'.$sksj->file_sp_rtrw)){
                \File::delete('backend/images/dokumen/sksj/rtrw/'.$sksj->file_sp_rtrw);
            }
            if(\File::exists('backend/images/dokumen/sksj/ktp/'.$sksj->file_ktp)){
                \File::delete('backend/images/dokumen/sksj/ktp/'.$sksj->file_ktp);
            }
            if(\File::exists('backend/images/dokumen/sksj/surat_pernyataan/'.$sksj->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/sksj/surat_pernyataan/'.$sksj->file_surat_pernyataan);

            }
            $sksj->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.sksj');
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
            $sksj = SKSJ::find($id);
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

            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Penolakan',$request->pesan,'operator','tolak');

            DB::commit();

            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.sksj');
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
            $sksj = SKSJ::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_sapu_jagat,no_surat,'.$sksj->id,
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

            $sksj->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);

            $log = (new NotifikasiSuketAction)->run($sksj,'sksj','Verifikasi','Pengajuan Surat Keterangan Sapu Jagat telah di verifikasi Oleh Operator Desa','operator','terima');

            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Sapu Jagat disetujui oleh operator desa');

            DB::commit();

            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sksj');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}

