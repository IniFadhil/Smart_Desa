<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BerandaController extends Controller
{
    /**
     * Menampilkan data untuk halaman utama (home).
     */
    public function home()
    {
        $desaId = Session::get('desa_id');

        $beritas = Berita::where('desa_id', $desaId)->where('status', 'show')->latest()->take(2)->get();
        $pengumumanTerbaru = Pengumuman::where('desa_id', $desaId)->where('status', 'show')->latest()->first();
        $agendas = Agenda::where('desa_id', $desaId)
            ->where('status', 'show')
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(2)
            ->get();

        return view('frontend.home', compact('beritas', 'pengumumanTerbaru', 'agendas'));
    }

    /**
     * Menampilkan semua berita dengan paginasi.
     */
    public function berita()
    {
        $beritas = Berita::where('desa_id', Session::get('desa_id'))
            ->where('status', 'show')
            ->latest()
            ->paginate(6);
        return view('frontend.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan detail satu berita.
     */
    public function beritaDetail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('frontend.berita.show', compact('berita'));
    }

    /**
     * Menampilkan semua pengumuman dengan paginasi.
     */
    public function pengumuman()
    {
        $pengumumans = Pengumuman::where('desa_id', Session::get('desa_id'))
            ->where('status', 'show')
            ->latest()
            ->paginate(5);
        return view('frontend.pengumuman', compact('pengumumans'));
    }

    /**
     * Menampilkan semua agenda.
     */
    public function agenda()
    {
        $desaId = Session::get('desa_id');
        $agendaAkanDatang = Agenda::where('desa_id', $desaId)
            ->where('status', 'show')
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        $agendaSudahLewat = Agenda::where('desa_id', $desaId)
            ->where('status', 'show')
            ->where('start_date', '<', now())
            ->latest('start_date')
            ->paginate(5);

        return view('frontend.agenda', compact('agendaAkanDatang', 'agendaSudahLewat'));
    }

    // ... (method-method lain di controller Anda) ...
}
