<?php

namespace App\Http\Controllers\Backend\Dokumen;

use App\Http\Controllers\Controller;
use App\Actions\SignDokumenAction;
use App\Actions\GenerateFileAction;
use Illuminate\Http\Request;
use App\Models\SKU;
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

class SkuController extends Controller
{
    function __construct()
    {
        $this->middleware('permissions:sku');
    }

    public function index()
    {
        try{
            if(empty(Auth::user()->desa_id)){
                $data['sku'] = SKU::orderBy('created_at','asc')->orderBy('status','asc')->get();
            }else{
                $data['sku'] = SKU::where('desa_id',Auth::user()->desa_id)->orderBy('status','asc')->orderBy('status','asc')->get();
            }
            return view('backend.dokumen.sku.list',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function create()
    {
        try{
            $data['users'] = User::where('desa_id',Session::get('desa_id'))->get();
            $data['pekerjaan'] = Pekerjaan::all();
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sku.create',$data);
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
            $data['id'] = $this->generateAutoNumber('ds_sk_usaha');
            $data['status'] = '1';
            $data['desa_id'] = empty(Auth::user()->desa_id)?Session::get('desa_id'):Auth::user()->desa_id;
            $sku = SKU::create($data);
            $generateFile = (new GenerateFileAction)->run($sku->id,'sku');
            $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = $this->logNotifikasiAdmin($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Usaha disetujui oleh operator desa');

            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$sku,'sku'));
            toastr()->success('Data Berhasil Ditambahkan','Sukses');
            return redirect()->route('backend.dokumen.sku.detail',['id'=>$sku->encodeHash($sku->id)]);
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
            $data['sku'] =  SKU::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sku.edit',$data);
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
            $sku = SKU::find($id);
            $sku->update($data);
            $generateFile = (new GenerateFileAction)->run($sku->id,'sku');
            $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Operator Desa','operator','terima');
            DB::commit();
            // $admin = Admin::where('email',$request->email)->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$sku,'sku'));
            toastr()->success('Data Berhasil Diubah','Sukses');
            return redirect()->route('backend.dokumen.sku.detail',['id'=>$sku->encodeHash($sku->id)]);
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
            $data['sku'] = SKU::find($id);
            $data['kasi'] = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('ds_admin_roles.role_id','kasi')->where('desa_id',Session::get('desa_id'))->get();
            return view('backend.dokumen.sku.detail',$data);
        }catch(\Exception $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
    
    // public function active(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $sku = SKU::find($id);
    //         $sku->update(['status' => 'show']);
    //         toastr()->success('Data Berhasil diaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.sku');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    // public function inactive(Request $request)
    // {
    //     try{
    //         $id = $this->decodeHash($request->id);
    //         $sku = SKU::find($id);
    //         $sku->update(['status' => 'hide']);
    //         toastr()->success('Data Berhasil dinonaktifkan','Sukses');
    //         return redirect()->route('backend.dokumen.sku');
    //     }catch(\QueryBuilder $e){
    //         toastr()->error($e->getMessage(),'Gagal');
    //         return back();
    //     }
    // }

    private function validasiForm($request)
    {
        $sku = SKU::find($request->id);
        if(!empty($sku->file_sp_rtrw)){
            $rules = [
                'no_surat' => 'required|max:150',
                'user_id' => 'required',
                'nama' => 'required|max:150',
                'nik' => 'required|max:16|min:16',
                'tempat_lahir' => 'required|max:150',
                'tgl_lahir' => 'required|max:150',
                'jk' => 'required|max:150',
                'pekerjaan_id' => 'required|max:150',
                'jenis_usaha' => 'required|max:190',
                'alamat' => 'required',
                'kasi_id' => 'required',
                'rtrw' => 'max:1024|mimes:jpeg,jpg,png',
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
                'jk' => 'required|max:150',
                'pekerjaan_id' => 'required|max:150',
                'jenis_usaha' => 'required|max:190',
                'alamat' => 'required',
                'kasi_id' => 'required',
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
            'nama' => 'Nama',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'pekerjaan_id' => 'Pekerjaan',
            'jenis_usaha' => 'Jenis Usaha',
            'alamat' => 'Alamat',
            'kasi_id' => 'Kirim Ke',
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
            $sku = SKU::find($request->id);
        }

        if($request->file('rtrw')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sku/rtrw/'.$sku->file_sp_rtrw)){
                    \File::delete('backend/images/dokumen/sku/rtrw/'.$sku->file_sp_rtrw);
                }
            }
            $rtrw = $request->file('rtrw');
            $destinationPath = public_path('backend/images/dokumen/sku/rtrw');
            $nama_rtrw = 'sku_rtrw_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$rtrw->getClientOriginalExtension();
            $rtrw->move($destinationPath,$nama_rtrw);
        }else{
            if($request->id){
                $nama_rtrw=$sku->file_sp_rtrw;
            }
        }

        if($request->file('ktp')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sku/ktp/'.$sku->file_ktp)){
                    \File::delete('backend/images/dokumen/sku/ktp/'.$sku->file_ktp);
                }
            }
            $ktp = $request->file('ktp');
            $destinationPath = public_path('backend/images/dokumen/sku/ktp');
            $nama_ktp = 'sku_ktp_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$ktp->getClientOriginalExtension();
            $ktp->move($destinationPath,$nama_ktp);
        }else{
            if($request->id){
                $nama_ktp=$sku->file_ktp;
            }
        }

        if($request->file('kk')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sku/kk/'.$sku->file_kk)){
                    \File::delete('backend/images/dokumen/sku/kk/'.$sku->file_kk);
                }
            }
            $kk = $request->file('kk');
            $destinationPath = public_path('backend/images/dokumen/sku/kk');
            $nama_kk = 'sku_kk_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$kk->getClientOriginalExtension();
            $kk->move($destinationPath,$nama_kk);
        }else{
            if($request->id){
                $nama_kk=$sku->file_kk;
            }
        }

        if($request->file('surat_pernyataan')){
            if(!empty($request->id)){
                if(\File::exists('backend/images/dokumen/sku/surat_pernyataan/'.$sku->file_surat_pernyataan)){
                    \File::delete('backend/images/dokumen/sku/surat_pernyataan/'.$sku->file_surat_pernyataan);
                }
            }
            $surat_pernyataan = $request->file('surat_pernyataan');
            $destinationPath = public_path('backend/images/dokumen/sku/surat_pernyataan');
            $nama_surat_pernyataan = 'sku_surat_pernyataan_'.strtolower(str_replace(' ','_',$request->nama)).'_'.date('YmdHis').'.'.$surat_pernyataan->getClientOriginalExtension();
            $surat_pernyataan->move($destinationPath,$nama_surat_pernyataan);
        }else{
            if($request->id){
                $nama_surat_pernyataan=$sku->file_surat_pernyataan;
            }
        }

        $data = [
            'no_surat' => $request->input('no_surat'),
            'user_id' => $request->input('user_id'),
            'kasi_id' => $request->input('kasi_id'),
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'alamat' => $request->input('alamat'),
            'jk' => $request->input('jk'),
            'pekerjaan_id' => $request->input('pekerjaan_id'),
            'kota_id' => Session::get('kota_id'),
            'kecamatan_id' => Session::get('kecamatan_id'),
            'area_id' => Session::get('desa_id'),
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
            $dokumen = \App\Models\Dokumen::where('suket_id',$id)->where('jenis','sku')->first();
            if(!$dokumen){
                toastr()->error('Surat tidak ditemukan','error');
                return redirect()->back();
            }

            $namaFile = $dokumen->dokumen;

            return response()->download(public_path('storage/surat/sku/'.$namaFile));

        }catch(\QueryBuilder $e){
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiKades(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);    
            $sku = SKU::find($id);

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

            $generateFile = (new GenerateFileAction)->run($sku->id,'sku');
            $signDokumen = (new SignDokumenAction)->run($id,'sku',Auth::guard('admin')->user()->nik,$request->passphrase);

            if($signDokumen == 'berhasil'){
                $sku->update(['verifikasi_kades' => '1','status' => '0','finished_date' => \Carbon\Carbon::now()]);

                $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Kepala Desa','kades','terima');
                $admin = $this->getAdmin('operator',Session::get('desa_id'));
                $logAdmin = $this->logNotifikasiAdmin($admin,'Verifikasi','Verifikasi Surat Keterangan Usaha disetujui oleh kepala desa');
                DB::commit();
                toastr()->success('Data Berhasil diverifikasi','Sukses');
                return redirect()->route('backend.dokumen.sku');
            }else{
                (new PassphraseLogAction)->run(Auth::guard('admin')->user()->id,$signDokumen);
                DB::commit();
                return redirect()->route('backend.dokumen.sku.detail',['id'=>$sku->encodeHash($sku->id)])->with('error',$signDokumen);
            }
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }

    public function verifikasiSekdes(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $this->decodeHash($request->id);
            $sku = SKU::find($id);
            $sku->update(['verifikasi_sekdes' => 1]);

            $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Sekretaris Desa','sekdes','terima');
            $admin = $this->getAdmin('kepala_desa',Session::get('desa_id'));
            $logAdmin = $this->logNotifikasiAdmin($admin,'Verifikasi','Verifikasi Surat Keterangan Usaha disetujui oleh sekretaris desa');
            DB::commit();
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','kepala_desa')->first();
            // Mail::to($admin->email)->send(new SuketMail($admin,$sku,'sku'));

            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sku');
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
            $sku = SKU::find($id);
            $sku->update(['verifikasi_kasi' => 1]);

            $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Kasi Desa','kasi','terima');
            $admin = $this->getAdmin('sekretaris_desa',Session::get('desa_id'));
            $logAdmin = $this->logNotifikasiAdmin($admin,'Verifikasi','Verifikasi Surat Keterangan Usaha disetujui oleh kasi desa');

            DB::commit();
            // $admin = Admin::join('ds_admin_roles','ds_admins.id','=','ds_admin_roles.admin_id')->where('desa_id',Session::get('desa_id'))->where('ds_admin_roles.role_id','sekretaris_desa')->first();
            
            // Mail::to($admin->email)->send(new SuketMail($admin,$sku,'sku'));
            toastr()->success('Data Berhasil diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sku');
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
            $sku = SKU::find($id);

            if(\File::exists('backend/images/dokumen/sku/rtrw/'.$sku->file_sp_rtrw)){
                \File::delete('backend/images/dokumen/sku/rtrw/'.$sku->file_sp_rtrw);
            }

            if(\File::exists('backend/images/dokumen/sku/ktp/'.$sku->file_ktp)){
                \File::delete('backend/images/dokumen/sku/ktp/'.$sku->file_ktp);
            }

            if(\File::exists('backend/images/dokumen/sku/kk/'.$sku->file_kk)){
                \File::delete('backend/images/dokumen/sku/kk/'.$sku->file_kk);
            }
            if(\File::exists('backend/images/dokumen/sku/surat_pernyataan/'.$sku->file_surat_pernyataan)){
                \File::delete('backend/images/dokumen/sku/surat_pernyataan/'.$sku->file_surat_pernyataan);
            }

            $sku->delete();
            DB::commit();
            toastr()->success('Data Berhasil Dihapus','Sukses');
            return redirect()->route('backend.dokumen.sku');
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
            $sku = SKU::find($id);

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

            $log = $this->suketLogNotifikasi($sku,'sku','Penolakan',$request->pesan,'operator','tolak');

            DB::commit();
            toastr()->success('Data Berhasil Ditolak','Sukses');
            return redirect()->route('backend.dokumen.sku');
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
            $sku = SKU::find($id);
            $rules = [
                'no_surat' => 'required|unique:ds_sk_usaha,no_surat,'.$sku->id,
                'kasi_id' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'unique' => ':attribute sudah digunakan',
                'max' => ':attribute maksimal :max karakter/digit',
                'min' => ':attribute maksimal :min karakter',
            ];

            $label = [
                'no_surat' => 'Nomor Surat',
                'kasi_id' => 'Nama Kasi',
            ];

            $this->validate($request,$rules,$messages,$label);
            // $validator = Validator::make($request->all(),$rules,$messages,$label);

            // if ($validator->fails()) {    
            //      toastr()->error('No Surat Sudah Digunakan','Error');
            //      return back();
            // }

            $sku->update(['no_surat'=>$request->no_surat,'kasi_id' => $request->kasi_id]);
            $log = $this->suketLogNotifikasi($sku,'sku','Verifikasi','Pengajuan Surat Keterangan Usaha telah di verifikasi Oleh Operator Desa','operator','terima');
            $logAdmin = $this->logNotifikasiAdmin($request->kasi_id,'Verifikasi','Verifikasi Surat Keterangan Usaha disetujui oleh operator desa');

            DB::commit();
            toastr()->success('Data Berhasil Diverifikasi','Sukses');
            return redirect()->route('backend.dokumen.sku');
        }catch(\QueryBuilder $e){
            DB::rollback();
            toastr()->error($e->getMessage(),'Gagal');
            return back();
        }
    }
}
