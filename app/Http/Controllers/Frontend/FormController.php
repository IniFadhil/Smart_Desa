<?php



namespace App\Http\Controllers\Frontend;



use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

use App\Models\SKU;

use App\Models\SKBN;

use App\Models\Pekerjaan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use File;
use Session;


class FormController extends Controller

{

  public function searching(Request $request)
    {


    }


  public function kelahiran(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-kelahiran', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function kelahiranSubmit(Request $request){

      try{

        dd($request->all());

        // if ($request->file('file_kk') && $request->file('file_ibu') && $request->file('file_ayah') && $request->file('file_surat_nikah')) {
        //     $filekk = $request->file('file_kk');
        //     $fileibu = $request->file('file_ibu');
        //     $fileayah = $request->file('file_ayah');
        //     $filesurat = $request->file('file_surat_nikah');
        //     $destionationPath = public_path('upload/forms/kelahiran/');
        //     $namekk = date('YmdHis') . "." . $filekk->getClientOriginalExtension();
        //     $nameibu = date('YmdHis') . "." . $fileibu->getClientOriginalExtension();
        //     $nameayah = date('YmdHis') . "." . $fileayah->getClientOriginalExtension();
        //     $namesurat = date('YmdHis') . "." . $filesurat->getClientOriginalExtension();
        //     $filekk->move($destionationPath, $namekk);
        //     $fileibu->move($destionationPath, $nameibu);
        //     $fileayah->move($destionationPath, $nameayah);
        //     $filesurat->move($destionationPath, $namesurat);
        // }else{
        //     $namekk = null;
        //     $nameibu = null;
        //     $nameayah = null;
        //     $namesurat = null;
        // }
        //
        // if ($request->file('file')) {
        //     $file = $request->file('file');
        //     $destionationPath = public_path('storage/backend/files/dokumen/dokumenPerencanaan');
        //     $nameFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
        //     $file->move($destionationPath, $nameFile);
        // }else{
        //     $nameFile = null;
        // }
        //
        // $data = [
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'slug' => Str::slug($request->input('title')),
        //     'date' => \Carbon\Carbon::now(),
        //     'status' => $request->input('status'),
        //     'created_by' => Auth::user()->name,
        //     'img' => $name,
        //     'file' => $nameFile
        // ];
        //
        // $formKelahiran =  DokumenPerencanaan::create($data);
        // return redirect()->route('frontend.suket.kelahiran');
      }

      catch(QueryException $e){

        return redirect()->back();

      }

  }

  public function kematian(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-kematian', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function kematianSubmit(Request $request){
      try{
        dd($request->all());
      }
      catch(QueryException $e){
        return redirect()->back();
      }
      return view('frontend.formSurat.suket-kelahiran');
  }

  public function sku(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-usaha', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function skuSubmit(Request $request){
    try{
      //dd($request->all());
      if ($request->file('file_sp_rtrw')) {
          $filertrw = $request->file('file_sp_rtrw');
          $destionationPath = public_path('upload/formsurat/sku/');
          $namertrw = date('YmdHis') . "." . $filertrw->getClientOriginalExtension();
          $filertrw->move($destionationPath, $namertrw);
      }else{
          $namertrw = null;
      }
      if ($request->file('file_ktp')) {
          $filektp = $request->file('file_ktp');
          $destionationPath = public_path('upload/formsurat/sku/');
          $namektp = date('YmdHis') . "." . $filektp->getClientOriginalExtension();
          $filektp->move($destionationPath, $namektp);
      }else{
          $namektp = null;
      }
      if ($request->file('file_kk')) {
          $filekk = $request->file('file_kk');
          $destionationPath = public_path('upload/formsurat/sku/');
          $namekk = date('YmdHis') . "." . $filekk->getClientOriginalExtension();
          $filekk->move($destionationPath, $namekk);
      }else{
          $namekk = null;
      }
      if ($request->file('file_surat_pernyataan')) {
          $filesp = $request->file('file_surat_pernyataan');
          $destionationPath = public_path('upload/formsurat/sku/');
          $namesp = date('YmdHis') . "." . $filesp->getClientOriginalExtension();
          $filesp->move($destionationPath, $namesp);
      }else{
          $namesp = null;
      }
      $data = [
          'id'            => Str::random(32),
          'desa_id'       => Session::get('desa_id'),
          'nik'           => $request->input('nik'),
          'nama'          => $request->input('nama'),
          'tempat_lahir'  => $request->input('tempat_lahir'),
          'tgl_lahir'     => $request->input('tgl_lahir'),
          'jk'            => $request->input('jk'),
          'pekerjaan_id'  => $request->input('pekerjaan_id'),
          'alamat'        => $request->input('alamat'),
          // 'kota_id'       => $request->input('kota_id'),
          // 'kecamatan_id'  => $request->input('kecamatan_id'),
          // 'area_id'       => $request->input('area_id'),
          'no_hp'         => $request->input('no_hp'),
          'file_sp_rtrw'  => $namertrw,
          'file_kk'       => $namekk,
          'file_ktp'      => $namektp,
          'file_surat_pernyataan' => $namesp
      ];
      $formUsaha =  SKU::create($data);

      // $sku = new SKU;
      //     $sku->id            = Str::random(32);
      //     $sku->desa_id       = Session::get('desa_id');
      //     $sku->nik           = $request->input('nik');
      //     $sku->nama          = $request->input('nama');
      //     $sku->tempat_lahir  = $request->input('tempat_lahir');
      //     $sku->tgl_lahir     = $request->input('tgl_lahir');
      //     $sku->jk            = $request->input('jk');
      //     $sku->pekerjaan_id  = $request->input('pekerjaan_id');
      //     $sku->alamat        = $request->input('alamat');
      //     // 'kota_id'       = $request->input('kota_id'),
      //     // 'kecamatan_id'  = $request->input('kecamatan_id'),
      //     // 'area_id'       = $request->input('area_id'),
      //     $sku->no_hp         = $request->input('no_hp');
      //     $sku->file_sp_rtrw  = $namertrw;
      //     $sku->file_kk       = $namekk;
      //     $sku->file_ktp      = $namektp;
      //     $sku->file_surat_pernyataan = $namesp;
      // $sku->save();


      return redirect()->route('frontend.suket.usaha');
    }
    catch(QueryException $e){
      return redirect()->back();
    }
  }

  public function bedanama(){
      return view('frontend.formSurat.suket-bedanama');
  }
  public function bedanamaSubmit(Request $request){
      try{
        //dd($request->all());
        if ($request->file('file_sp_rtrw')) {
            $filertrw = $request->file('file_sp_rtrw');
            $destionationPath = public_path('upload/formsurat/sku/');
            $namertrw = date('YmdHis') . "." . $filertrw->getClientOriginalExtension();
            $filertrw->move($destionationPath, $namertrw);
        }else{
            $namertrw = null;
        }
        if ($request->file('file_ktp')) {
            $filektp = $request->file('file_ktp');
            $destionationPath = public_path('upload/formsurat/sku/');
            $namektp = date('YmdHis') . "." . $filektp->getClientOriginalExtension();
            $filektp->move($destionationPath, $namektp);
        }else{
            $namektp = null;
        }
        if ($request->file('file_kk')) {
            $filekk = $request->file('file_kk');
            $destionationPath = public_path('upload/formsurat/sku/');
            $namekk = date('YmdHis') . "." . $filekk->getClientOriginalExtension();
            $filekk->move($destionationPath, $namekk);
        }else{
            $namekk = null;
        }
        if ($request->file('file_surat_pernyataan')) {
            $filesp = $request->file('file_surat_pernyataan');
            $destionationPath = public_path('upload/formsurat/sku/');
            $namesp = date('YmdHis') . "." . $filesp->getClientOriginalExtension();
            $filesp->move($destionationPath, $namesp);
        }else{
            $namesp = null;
        }
        $data = [
            'id'            => Str::random(32),
            'desa_id'       => Session::get('desa_id'),
            'nik'           => $request->input('nik'),
            'nama_salah'    => $request->input('nama_salah'),
            'nama_benar'    => $request->input('nama_benar'),
            'no_hp'         => $request->input('no_hp'),
            'file_sp_rtrw'  => $namertrw,
            'file_kk'       => $namekk,
            'file_ktp'      => $namektp,
            'file_surat_pernyataan' => $namesp
        ];
        $formUsaha =  SKBN::create($data);
        return redirect()->route('frontend.suket.bedanama');
      }catch(QueryException $e){
        return redirect()->back();
      }
  }

  public function sktm(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-tidakMampu', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function sktmSubmit(Request $request){
    try{
      dd($request->all());
    }catch(QueryException $e){
      return redirect()->back();
    }
  }

  public function penghasilan(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-penghasilan', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function penghasilanSubmit(Request $request){
    try{
      dd($request->all());
    }catch(QueryException $e){
      return redirect()->back();
    }
  }

  public function status(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-status', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function statusSubmit(Request $request){
    try{
      if ($request->file('file_sp_rtrw')) {
          $filertrw = $request->file('file_sp_rtrw');
          $destionationPath = public_path('storage/backend/files/dokumen/status/');
          $namertrw = date('YmdHis') . "rtrw." . $filertrw->getClientOriginalExtension();
          $filertrw->move($destionationPath, $namertrw);
      }else{
          $namertrw = null;
      }
      if ($request->file('file_ktp')) {
          $filektp = $request->file('file_ktp');
          $destionationPath = public_path('storage/backend/files/dokumen/status/');
          $namektp = date('YmdHis') . "ktp." . $filektp->getClientOriginalExtension();
          $filektp->move($destionationPath, $namektp);
      }else{
          $namektp = null;
      }
      if ($request->file('file_kk')) {
          $filekk = $request->file('file_kk');
          $destionationPath = public_path('storage/backend/files/dokumen/status/');
          $namekk = date('YmdHis') . "kk." . $filekk->getClientOriginalExtension();
          $filekk->move($destionationPath, $namekk);
      }else{
          $namekk = null;
      }
      if ($request->file('file_akta_cerai')) {
          $fileac = $request->file('file_akta_cerai');
          $destionationPath = public_path('storage/backend/files/dokumen/status/');
          $nameac = date('YmdHis') . "cerai." . $fileac->getClientOriginalExtension();
          $fileac->move($destionationPath, $nameac);
      }else{
          $nameac = null;
      }
      $id = Str::random(32);
      $data = [
          'id'            => $id,
          'desa_id'       => Session::get('desa_id'),
          'nik'           => $request->input('nik'),
          'nama'          => $request->input('nama'),
          'tempat_lahir'  => $request->input('tempat_lahir'),
          'tgl_lahir'     => $request->input('tgl_lahir'),
          'jk'            => $request->input('jk'),
          'warga_negara'  => $request->input('warga_negara'),
          'agama'         => $request->input('agama'),
          'alamat'        => $request->input('alamat'),
          'keperluan'     => $request->input('keperluan'),
          'no_hp'         => $request->input('no_hp'),
          'area_id'       => $this->getLokasi()->id,
          'kecamatan_id'  => $this->getLokasi()->kecamatan->id,
          'kota_id'       => $this->getLokasi()->kecamatan->kota->id,
          'file_sp_rtrw'  => $namertrw,
          'file_kk'       => $namekk,
          'file_ktp'      => $namektp,
          'file_surat_pernyataan' => $nameac
      ];
      dd($data);
      //$form =  SKN::create($data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }

  public function riwayatTanah(){
      return view('frontend.formSurat.suket-tanah');
  }
  public function riwayatTanahSubmit(Request $request){
      try{
        dd($request->all());
      }
      catch(QueryException $e){
        return redirect()->back();
      }
      return view('frontend.formSurat.suket-tanah');
  }

  public function ahliWaris(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-ahliWaris', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function ahliWarisSubmit(Request $request){
      try{
        dd($request->all());
      }
      catch(QueryException $e){
        return redirect()->back();
      }
      return view('frontend.formSurat.suket-ahliwaris');
  }

  public function sapuJagad(){
    try{
      $data['pekerjaan'] = Pekerjaan::all();
      $data['provinsi'] = Provinsi::all();
      $data['kota'] = Kota::all();
      $data['kecamatan'] = Kecamatan::all();
      $data['desa'] = Desa::all();
      return view('frontend.formSurat.suket-sapujagat', $data);
    }catch(QueryException $e){
      return redirect()->back();
    }
  }
  public function sapuJagadSubmit(Request $request){
      try{
        dd($request->all());
      }
      catch(QueryException $e){
        return redirect()->back();
      }
      return view('frontend.formSurat.suket-sapujagat');
  }















}
