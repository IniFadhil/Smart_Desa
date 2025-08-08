<?php

namespace App\View\Components\Backend\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Modul;
use App\Models\Permission;

class App extends Component
{
    public $moduls;
    public $permissions;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Mengabaikan hak akses dan mengambil SEMUA modul yang statusnya aktif
        $this->moduls = Modul::where('status', true)->orderBy('name', 'asc')->get();


        // Mengambil SEMUA permission yang ada beserta relasi menunya
        $this->permissions = Permission::with('menu')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.layouts.app');
    }
}
