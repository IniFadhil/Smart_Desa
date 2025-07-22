<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

// Import semua model yang digunakan
use App\Models\SKTM;
use App\Models\SKBN;
use App\Models\SKN;
use App\Models\SKP;
use App\Models\SKU;
use App\Models\SKM;
use App\Models\SKK;
use App\Models\SKSJ;
use App\Models\SKRT;
use App\Models\SKAW;
use App\Models\ProfilDesa;
use App\Models\BukuTamu;
use App\Models\Slider;
use App\Models\Admin;
use App\Models\User;
use App\Models\KelDesa;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin yang sudah login.
     */
    public function index()
    {
        try {
            $desaId = Session::get('desa_id');
            // $data = $this->getDashboardData($desaId);
            $data = [];
            return view('backend.dashboard', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan data publik berdasarkan URL.
     */
    public function publik()
    {
        try {
            $url = url('/');
            $desa = KelDesa::where('url', str_replace(["https://", "http://"], "", $url))->firstOrFail();
            $data = $this->getDashboardData($desa->id);
            return view('backend.publik', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data publik: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman profil desa untuk diedit.
     */
    public function profilDesa()
    {
        try {
            $data['profil'] = ProfilDesa::find(Session::get('desa_id'));
            return view('backend.profilDesa', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat profil desa: ' . $e->getMessage());
        }
    }

    /**
     * Mengupdate data profil desa.
     */
    public function updateProfilDesa(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'kades' => 'required|max:150',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'foto_desa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kades' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $desaId = Session::get('desa_id');
            $profilDesa = ProfilDesa::find($desaId);

            $dataToUpdate = $request->except(['_token', 'foto_desa', 'foto_kades']);
            $dataToUpdate['id'] = $desaId;

            // Handle upload file
            if ($request->hasFile('foto_desa')) {
                $dataToUpdate['foto_desa'] = $this->handleFileUpload($request->file('foto_desa'), $profilDesa->foto_desa ?? null, 'profil/desa', 'desa');
            }
            if ($request->hasFile('foto_kades')) {
                $dataToUpdate['foto_kades'] = $this->handleFileUpload($request->file('foto_kades'), $profilDesa->foto_kades ?? null, 'profil/kades', 'kades');
            }

            // Gunakan updateOrCreate untuk menyederhanakan logika
            ProfilDesa::updateOrCreate(['id' => $desaId], $dataToUpdate);

            return redirect()->route('backend.dashboard')->with('success', 'Data Profil Desa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    // =================================================================================
    // PRIVATE HELPER METHODS
    // =================================================================================

    /**
     * Mengambil semua data yang dibutuhkan untuk dashboard.
     * @param int|string $desaId
     * @return array
     */
    private function getDashboardData($desaId): array
    {
        $data['sktm'] = SKTM::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skbn'] = SKBN::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skn']  = SKN::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skp']  = SKP::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['sku']  = SKU::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skm']  = SKM::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skk']  = SKK::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['sksj'] = SKSJ::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skrt'] = SKRT::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();
        $data['skaw'] = SKAW::where('status', '1')->where('desa_id', $desaId)->orderBy('created_at', 'asc')->get();

        $data['admin'] = Admin::where('status', 1)->where('desa_id', $desaId)->count();
        $data['userVerified'] = User::where('is_verified', 1)->where('desa_id', $desaId)->count();
        $data['userUnverified'] = User::where('is_verified', 0)->where('desa_id', $desaId)->count();

        return $data;
    }

    /**
     * Menangani logika upload dan delete file lama.
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $oldFileName
     * @param string $path
     * @param string $prefix
     * @return string
     */
    private function handleFileUpload($file, ?string $oldFileName, string $path, string $prefix): string
    {
        // Hapus file lama jika ada
        if ($oldFileName && File::exists(public_path('backend/images/' . $path . '/' . $oldFileName))) {
            File::delete(public_path('backend/images/' . $path . '/' . $oldFileName));
        }

        // Buat nama baru dan pindahkan file
        $newFileName = $prefix . '_' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('backend/images/' . $path), $newFileName);

        return $newFileName;
    }
}
