<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use App\Actions\NotifikasiSuketAction;
use App\Actions\NotifikasiAdminAction;
use App\Actions\GetAdminAction;
use Illuminate\Http\Request;
use App\Models\SKBN;
use App\Models\SKBNDetail;
use App\Models\ProfilDesa;
use App\Models\User;
use App\Models\Admin;
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

class SkbnController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:skbn');
    }

    public function index()
    {
        try{
            if(empty(current_user('admin')->desa_id)){
                $data['skbn'] = SKBN::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['skbn'] = SKBN::where('desa_id',current_user('admin')->desa_id)->orderBy('created_at','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.skbn.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skbn.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_beda_nama');
            $data['status'] = '1';
            $data['desa_id'] = empty(current_user('admin')->desa_id)?Session::get('desa_id'):current_user('admin')->desa_id;
            $skbn = SKBN::create($data);

            for($i = 0;$i<count($request->jenis_dok);$i++){
                $detail = [
                    'id' => $this->generateAutoNumber('ds_skbn_detail'),
                    'skbn_id' => $skbn->id,
                    'jenis_dok' => $request->jenis_dok[$i],
                    'nomor_dok' => $request->nomor_dok[$i],
                    'nama_dok' => $request->nama_dok[$i],
                ];

                $skbnDetail = SKBNDetail::create($detail);
            }

            $generateFile = (new GenerateFileAction)->run($skbn->id,'skbn');

            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama Telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Beda Nama disetujui oleh operator desa ');
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skbn,'skbn'));
            DB::commit();
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.skbn.detail',['id'=>$skbn->encodeHash($skbn->id)]);
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
            $data['skbn'] =  SKBN::find($id);
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skbn.edit',$data);
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
            $skbn = SKBN::find($id);
            $skbn->update($data);
            
            for($i = 0;$i<count($request->jenis_dok);$i++){
                $detail = [
                    'skbn_id' => $skbn->id,
                    'jenis_dok' => $request->jenis_dok[$i],
                    'nomor_dok' => $request->nomor_dok[$i],
                    'nama_dok' => $request->nama_dok[$i],
                ];

                $skbnDetail = SKBNDetail::where('id',$request->skbn_id[$i])->update($detail);
            }
            $generateFile = (new GenerateFileAction)->run($skbn->id,'skbn');

            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama Telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skbn,'skbn'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.skbn.detail',['id'=>$skbn->encodeHash($skbn->id)]);
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
            $data['skbn'] = SKBN::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.skbn.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skbn = SKBN::find($id);
    //         $skbn->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skbn');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $skbn = SKBN::find($id);
    //         $skbn->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.skbn');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $skbn = SKBN::find($request->id);
        if(!empty($skbn->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'data_dok_benar' => 'required|max:150',
                'jenis_dok.*' => 'required|max:150',
                'nomor_dok.*' => 'required|max:150',
                'nama_dok.*' => 'required|max:150',
                'kasi_id' => 'required',
                'user_id' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
                'ktp' => 'max:1024|mimes:jpeg,jpg,png',
                'kk' => 'max:1024|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'max:1024|mimes:jpeg,jpg,png',
            ];
    
        }else{
            $rules = [
                'no_surat' => 'required|max:150',
                'data_dok_benar' => 'required|max:150',
                'jenis_dok.*' => 'required|max:150',
                'nomor_dok.*' => 'required|max:150',
                'nama_dok.*' => 'required|max:150',
                'kasi_id' => 'required',
                'user_id' => 'required',
                'rtrw' => 'required|max:1024|mimes:jpeg,jpg,png',
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
            'data_dok_benar' => 'Data Dokumen Benar',
            'jenis_dok.*' => 'Jenis Dokumen',
            'nomor_dok.*' => 'Nomor Dokumen',
            'nama_dok.*' => 'Nama Dokumen',
            'kasi_id' => 'required',
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
            $skbn = SKBN::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skbn/rtrw/'.$skbn->file_sp_rtrw)){
                    \File::delete('backend/images/dokumen/skbn/rtrw/'.$skbn->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('backend/images/dokumen/skbn/rtrw');
            $nama_rtrw = 'skbn_rtrw_'.strtolower(str_replace(' ','_',$request->data_dok_benar)).'_'.date('YmdHis').'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$skbn->file_sp_rtrw;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skbn/ktp/'.$skbn->file_ktp)){
                    \File::delete('backend/images/dokumen/skbn/ktp/'.$skbn->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/skbn/ktp');
            $nama_ktp = 'skbn_ktp_'.strtolower(str_replace(' ','_',$request->data_dok_benar)).'_'.date('YmdHis').$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$skbn->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skbn/kk/'.$skbn->file_kk)){
                    \File::delete('backend/images/dokumen/skbn/kk/'.$skbn->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/skbn/kk');
            $nama_kk = 'skbn_kk_'.strtolower(str_replace(' ','_',$request->data_dok_benar)).'_'.date('YmdHis').$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$skbn->file_kk;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/skbn/surat_pernyataan/'.$skbn->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/skbn/surat_pernyataan/'.$skbn->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/skbn/surat_pernyataan');
            $nama_surat_pernyataan = 'skbn_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->data_dok_benar)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$skbn->file_surat_pernyataan;
            }
        }

        $data = [
            'kasi_id' => $request->input('kasi_id'),
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'data_dok_benar' => $request->input('data_dok_benar'),
            'file_sp_rtrw' => $nama_rtrw,
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
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','skbn')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/skbn/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        try{
            $id = $this->decodeHash($request->id);
            $skbn = SKBN::find($id);

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

            $generateFile = (new GenerateFileAction)->run($skbn->id,'skbn');
            $signDokumen = (new SignDokumenAction)->run($id,'skbn',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $skbn->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama Telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = (new GetAdminAction)->run('operator',Session::get('desa_id'));
                $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Beda Nama disetujui oleh kepala desa');
                // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','operator')->first();
                // Mail::to($admin->email)->send(new SuketMail($admin,$skbn,'skbn'));
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.skbn');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                return redirect()->route('backend.dokumen.skbn.detail',['id'=>$skbn->encodeHash($skbn->id)])->with('error',$signDokumen);
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
            $skbn = SKBN::find($id);
            $skbn->update(['verifikasi_sekdes' => 1]);

            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama Telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = (new GetAdminAction)->run('kepala_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Beda Nama disetujui oleh sekretaris desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','kepala_desa')->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skbn,'skbn'));
            DB::commit();
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skbn');
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
            $skbn = SKBN::find($id);
            $skbn->update(['verifikasi_kasi' => 1]);

            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama Telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = (new GetAdminAction)->run('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = (new NotifikasiAdminAction)->run($admin,'Verifikasi','Verifikasi Surat Keterangan Beda Nama disetujui oleh kasi desa');
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','sekretaris_desa')->first();
            DB::commit();
            // Mail::to($admin->email)->send(new SuketMail($admin,$skbn,'skbn'));
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skbn');
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
            $skbn = SKBN::find($id);

            if(\File::exists('backend/images/dokumen/skbn/rtrw/'.$skbn->file_sp_rtrw)){
                \File::delete('backend/images/dokumen/skbn/rtrw/'.$skbn->file_sp_rtrw);
            }

            if(\File::exists('backend/images/dokumen/skbn/ktp/'.$skbn->file_ktp)){
                \File::delete('backend/images/dokumen/skbn/ktp/'.$skbn->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/skbn/kk/'.$skbn->file_kk)){
                \File::delete('backend/images/dokumen/skbn/kk/'.$skbn->file_kk);
            }
            if(\File::exists('backend/images/dokumen/skbn/surat_pernyataan/'.$skbn->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/skbn/surat_pernyataan/'.$skbn->file_surat_pernyataan);
            }

            $skbn->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.skbn');
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
            $skbn = SKBN::find($id);
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

            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Penolakan',$request->pesan,'operator','tolak');
            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.skbn');
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
            $skbn = SKBN::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_beda_nama,no_surat,'.$skbn->id,
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

            $skbn->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = (new NotifikasiSuketAction)->run($skbn,'skbn','Verifikasi','Pengajuan Surat Keterangan Beda Nama telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = (new NotifikasiAdminAction)->run($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Beda Nama disetujui oleh operator desa ');
            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.skbn');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
