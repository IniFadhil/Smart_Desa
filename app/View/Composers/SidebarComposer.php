<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Modul;
use App\Models\Permission;

class SidebarComposer
{
    public function compose(View $view)
    {
        $moduls = collect();
        $permissions = collect();

        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->roles->isNotEmpty()) {
            $roleId = Auth::guard('admin')->user()->roles->first()->id;

            // dd($roleId);
            // 1. Ambil semua permission untuk role ini, beserta relasi ke menu
            $permissions = Permission::with('menu', 'modul')->where('role_id', $roleId)->get();
            // dd($permissions);

            // 2. Dari permission, ambil ID modul yang unik (yang boleh diakses)
            $allowedModulIds = $permissions->pluck('modul_id')->unique();
            // dd($allowedModulIds);

            // 3. Ambil data Modul berdasarkan ID yang diizinkan
            $moduls = Modul::whereIn('id', $allowedModulIds)->where('status', true)->get();
            // dd($moduls);
        }

        // Kirim DUA variabel ini ke view
        $view->with(compact('moduls', 'permissions'));
    }
}
