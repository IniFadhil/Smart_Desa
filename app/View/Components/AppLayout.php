<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Pastikan path ini menunjuk ke lokasi layout backend yang baru
        return view('backend.layouts.app');
    }
}
