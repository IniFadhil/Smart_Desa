<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Date; // Baris ini ditambahkan

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengatur lokal untuk format tanggal Carbon ke Bahasa Indonesia
        Date::setLocale(config('app.locale')); // Baris ini ditambahkan
    }
}
