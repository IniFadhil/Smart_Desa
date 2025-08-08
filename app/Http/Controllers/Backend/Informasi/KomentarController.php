<?php

namespace App\Http\Controllers\Backend\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    /**
     * Menampilkan daftar semua komentar.
     */
    public function index()
    {
        $komentars = Komentar::latest()->get();
        return view('backend.informasi.komentar.list', compact('komentars'));
    }

    /**
     * Menampilkan form untuk membalas komentar.
     */
    public function reply(Komentar $komentar)
    {
        return view('backend.informasi.komentar.reply', compact('komentar'));
    }

    /**
     * Menyimpan balasan untuk sebuah komentar.
     */
    public function updateReply(Request $request, Komentar $komentar)
    {
        $request->validate([
            'balas' => 'required|string',
        ]);

        $komentar->update([
            'balas' => $request->balas,
            'admin' => auth()->guard('admin')->user()->name,
            'status' => 'show', // Otomatis tampilkan setelah dibalas
        ]);

        return redirect()->route('backend.informasi.komentar.index')->with('success', 'Komentar berhasil dibalas.');
    }

    /**
     * Mengubah status (show/hide) sebuah komentar.
     */
    public function toggleStatus(Komentar $komentar)
    {
        $komentar->status = ($komentar->status == 'show') ? 'hide' : 'show';
        $komentar->save();
        return back()->with('success', 'Status komentar berhasil diubah.');
    }

    /**
     * Menghapus sebuah komentar.
     */
    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return redirect()->route('backend.informasi.komentar.index')->with('success', 'Komentar berhasil dihapus.');
    }
}