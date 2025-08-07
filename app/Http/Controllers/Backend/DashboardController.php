<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- PENTING: Tambahkan ini
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

// Import semua model yang digunakan
use App\Models\Admin;
use App\Models\User;
use App\Models\ProfilDesa;
use App\Models\Modul;       // <-- PENTING: Tambahkan ini
use App\Models\Permission; // <-- PENTING: Tambahkan ini
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

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama admin.
     */
    public function index()
    {
        try {
            // =================================================================
            // DATA UNTUK KONTEN HALAMAN DASHBOARD (Logika Anda yang sudah ada)
            // =================================================================
            $admin = \App\Models\Admin::count();
            $userVerified = \App\Models\User::where('is_verified', 1)->count();
            $userUnverified = \App\Models\User::where('is_verified', 0)->count();
            // $latest_surat = $this->getLatestSurat();


            // =================================================================
            // DATA UNTUK LAYOUT SIDEBAR (Logika yang hilang & menyebabkan error)
            // =================================================================
            $user = Auth::guard('admin')->user();
            $userRole = $user->roles()->first();

            // Safety net jika user tidak punya role
            if (!$userRole) {
                Auth::guard('admin')->logout();
                return redirect()->route('backend.auth.login')->with('toastr', [
                    'type' => 'error',
                    'message' => 'Konfigurasi hak akses tidak ditemukan. Silakan login kembali.'
                ]);
            }

            // Ambil semua permission berdasarkan role, beserta relasi menu dan modul
            $permissions = Permission::where('role_id', $userRole->id)
                ->with(['menu', 'modul'])
                ->get();

            // Ambil semua ID modul yang diizinkan
            $allowedModulIds = $permissions->pluck('modul_id')->unique();

            // Ambil data modul yang aktif dan diizinkan
            $moduls = Modul::where('status', 1)
                ->whereIn('id', $allowedModulIds)
                ->orderBy('sequence', 'asc')
                ->get();


            // =================================================================
            // KIRIM SEMUA DATA (KONTEN + SIDEBAR) KE VIEW
            // =================================================================
            return view('backend.dashboard.index', compact(
                // Data konten
                'admin',
                'userVerified',
                'userUnverified',
                'latest_surat',
                // Data sidebar
                'moduls',
                'permissions'
            ));
        } catch (\Exception $e) {
            // Logout jika ada error serius untuk mencegah loop
            Auth::guard('admin')->logout();
            return redirect()->route('backend.auth.login')->with('toastr', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memuat dashboard: ' . $e->getMessage()
            ]);
        }
    }

    // --- Method lainnya (profilDesa, updateProfilDesa, dll) tetap sama ---
    // ... (Tidak perlu diubah) ...

    /**
     * Menampilkan halaman profil desa untuk diedit.
     */
    public function profilDesa()
    {
        $profil = ProfilDesa::firstOrCreate(['id' => Session::get('desa_id')]);
        return view('backend.profilDesa', compact('profil'));
    }

    /**
     * Mengupdate data profil desa.
     */
    public function updateProfilDesa(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'kades' => 'required|string|max:150',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string',
            'foto_desa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kades' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $desaId = Session::get('desa_id');
            $profil = ProfilDesa::find($desaId);

            if ($request->hasFile('foto_desa')) {
                $validated['foto_desa'] = $this->handleFileUpload($request->file('foto_desa'), $profil->foto_desa ?? null, 'profil/desa', 'desa');
            }
            if ($request->hasFile('foto_kades')) {
                $validated['foto_kades'] = $this->handleFileUpload($request->file('foto_kades'), $profil->foto_kades ?? null, 'profil/kades', 'kades');
            }

            ProfilDesa::updateOrCreate(['id' => $desaId], $validated);

            return redirect()->route('backend.dashboard')->with('success', 'Data Profil Desa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    // private function getLatestSurat()
    // {
    //     $suratModels = [SKTM::class, SKBN::class, SKN::class, SKP::class, SKU::class, SKM::class, SKK::class, SKSJ::class, SKRT::class, SKAW::class];
    //     $allSurat = collect();

    //     foreach ($suratModels as $model) {
    //         $suratData = $model::latest()->take(10)->get();
    //         $allSurat = $allSurat->merge($suratData);
    //     }

    //     return $allSurat->sortByDesc('created_at')->take(10);
    // }

    private function handleFileUpload($file, ?string $oldFileName, string $path, string $prefix): string
    {
        if ($oldFileName && File::exists(public_path('backend/images/' . $path . '/' . $oldFileName))) {
            File::delete(public_path('backend/images/' . $path . '/' . $oldFileName));
        }

        $newFileName = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('backend/images/' . $path), $newFileName);

        return $newFileName;
    }
}