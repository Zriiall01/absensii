<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Absensi;
use App\Models\AbsensiModel;

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
        // View Composer untuk navbar mahasiswa
        view()->composer('layout.template', function ($view) {
            $absensisAktif = AbsensiModel::where('waktu_mulai', '<=', now())
                ->where('waktu_selesai', '>=', now())
                ->get();

            $view->with('absensisAktif', $absensisAktif);
        });
    }
}
