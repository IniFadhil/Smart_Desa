<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App\Models\Desa;

class CheckDomainPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $domain = DB::table('keldesa')
            ->where('url', $request->getHttpHost())  //ambil url web
            ->where('status', 'Y')
            ->first();
        // dd($domain);
        if (empty($domain)) {
            // FIX: gunakan response()->view() agar return-nya valid
            return response()->view('errors.404', [], 404);
        }

        // Share data ke semua view
        \View::share('slider', \App\Models\Slider::where('desa_id', $domain->id)->where('status', 'show')->get());
        \View::share('potensi', \App\Models\PotensiKategori::where('desa_id', $domain->id)->where('status', 'show')->get());
        \View::share('lokasi', \App\Models\Desa::find($domain->id));
        \View::share('website', \App\Models\Website::where('desa_id', $domain->id)->first());
        \View::share('program', \App\Models\ProgramKategori::where('desa_id', $domain->id)->where('status', 'show')->get());
        \View::share('profile', \App\Models\ProfilDesa::where('id', $domain->id)->get());

        // Simpan session desa
        $data = Desa::find($domain->id);
        Session::put('nama_desa', $data->nama);
        Session::put('provinsi_id', $data->provinsi_id);
        Session::put('kota_id', $data->kota_id);
        Session::put('kecamatan_id', $data->kecamatan_id);
        Session::put('desa_id', $data->id); //meyipan data disession dengan name desa_id

        return $next($request);
    }
}