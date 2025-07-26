<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TahunAjaran;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Kirim tahun ajaran aktif ke semua view
        View::composer('*', function ($view) {
            $tahun_ajaran_aktif = TahunAjaran::where('status', 'aktif')->first();
            $view->with('tahun_ajaran', $tahun_ajaran_aktif?->nama ?? '');
        });
    }
}
