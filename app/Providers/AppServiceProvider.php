<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\RuanganInterface::class, \App\Repositories\RuanganRepository::class);
        $this->app->bind(\App\Interfaces\SesiInterface::class, \App\Repositories\SesiRepository::class);
        $this->app->bind(\App\Interfaces\MataPelajaranInterface::class, \App\Repositories\MataPelajaranRepository::class);
        $this->app->bind(\App\Interfaces\GuruInterface::class, \App\Repositories\GuruRepository::class);
        $this->app->bind(\App\Interfaces\AuthInterface::class, \App\Repositories\AuthRepository::class);
        $this->app->bind(\App\Interfaces\RombelInterface::class, \App\Repositories\RombelRepository::class);
        $this->app->bind(\App\Interfaces\SiswaInterface::class, \App\Repositories\SiswaRepository::class);
        $this->app->bind(\App\Interfaces\JadwalPelajaranInterface::class, \App\Repositories\JadwalPelajaranRepository::class);
        $this->app->bind(\App\Interfaces\NilaiInterface::class, \App\Repositories\NilaiRepository::class);
        $this->app->bind(\App\Interfaces\KehadiranInterface::class, \App\Repositories\KehadiranRepository::class);
        $this->app->bind(\App\Interfaces\PengumumanInterface::class, \App\Repositories\PengumumanRepository::class);
        $this->app->bind(\App\Interfaces\EkskulInterface::class, \App\Repositories\EkskulRepository::class);
        $this->app->bind(\App\Interfaces\NilaiEkskulInterface::class, \App\Repositories\NilaiEkskulRepository::class);
        $this->app->bind(\App\Interfaces\KehadiranGuruInterface::class, \App\Repositories\KehadiranGuruRepository::class);
        $this->app->bind(\App\Interfaces\DateInterface::class, \App\Repositories\DateRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
