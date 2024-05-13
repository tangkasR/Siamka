<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::group(['middleware' => ["must-logout"]], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');;
    Route::post('/login', [AuthController::class, 'auth']);
});
Route::group(['middleware' => ["must-login"]], function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
    // auth
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => ["admin"]], function () {
        // profil
        Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', 'index')->name('profil');
        });

        // siswa
        Route::controller(SiswaController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/siswa', 'index')->name('siswa');
            Route::get('/siswa/show-siswa/{id}', 'show_siswa')->name('siswa.show_siswa');
            Route::post('/siswa', 'store')->name('siswa.store');
            Route::post('/siswa/update/{id}', 'update')->name('siswa.update');
            Route::get('/siswa/destroy/{id}', 'destroy')->name('siswa.destroy');
        });

        // guru
        Route::controller(GuruController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/guru', 'index')->name('guru');
            Route::post('/guru', 'store')->name('guru.store');
            Route::post('/guru/update/{id}', 'update')->name('guru.update');
            Route::get('/guru/destroy/{id}', 'destroy')->name('guru.destroy');
        });

        // rombel
        Route::controller(RombelController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/rombel', 'index')->name('rombel');
            Route::post('/rombel', 'store')->name('rombel.store');
            Route::post('/rombel/update/{id}', 'update')->name('rombel.update');
            Route::get('/rombel/destroy/{id}', 'destroy')->name('rombel.destroy');
        });

        // sesi
        Route::controller(SesiController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/sesi', 'index')->name('sesi');
            Route::post('/sesi', 'store')->name('sesi.store');
            Route::post('/sesi/update/{id}', 'update')->name('sesi.update');
            Route::get('/sesi/destroy/{id}', 'destroy')->name('sesi.destroy');
        });

        // ruangan
        Route::controller(RuanganController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/ruangan', 'index')->name('ruangan');
            Route::post('/ruangan', 'store')->name('ruangan.store');
            Route::post('/ruangan/update/{id}', 'update')->name('ruangan.update');
            Route::get('/ruangan/destroy/{id}', 'destroy')->name('ruangan.destroy');
        });

        // mata pelajaran
        Route::controller(MataPelajaranController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/mapel', 'index')->name('mapel');
            Route::post('/mapel', 'store')->name('mapel.store');
            Route::post('/mapel/update/{id}', 'update')->name('mapel.update');
            Route::get('/mapel/destroy/{id}', 'destroy')->name('mapel.destroy');
        });

        // jadwal pelajaran
        Route::controller(JadwalPelajaranController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/jadwal_pelajaran', 'index')->name('jadwal_pelajaran');
            Route::get('/jadwal_pelajaran/show-jadwal/{id}', 'show_jadwal')->name('jadwal_pelajaran.show_jadwal');
            Route::post('/jadwal_pelajaran', 'store')->name('jadwal_pelajaran.store');
            Route::post('/jadwal_pelajaran/update/{id}', 'update')->name('jadwal_pelajaran.update');
            Route::get('/jadwal_pelajaran/destroy/{id}', 'destroy')->name('jadwal_pelajaran.destroy');
        });

    });
    Route::group(['middleware' => ["guru"]], function () {

        // Nilai
        Route::controller(NilaiController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/nilai', 'index')->name('nilai');
            Route::get('/nilai/filter', 'filter')->name('nilai.filter');
            Route::get('/nilai/daftar_siswa/{id}', 'show_siswa')->name('nilai.show_siswa');
            Route::get('/nilai/input/{id}', 'show_input')->name('nilai.show_input');
            Route::post('/nilai/save', 'store')->name('nilai.store');
            Route::post('/nilai/update/{id}', 'update')->name('nilai.update');
            Route::get('/nilai/destroy/{id}', 'destroy')->name('nilai.destroy');
        });

        // Kehadiran
        Route::controller(KehadiranController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/kehadiran', 'index')->name('kehadiran');
            Route::get('/kehadiran/filter', 'filter')->name('kehadiran.filter');
            Route::get('/kehadiran/daftar_siswa/{id}', 'show_siswa')->name('kehadiran.show_siswa');
            Route::get('/kehadiran/show_input/{id}', 'show_input')->name('kehadiran.show_input');
            Route::post('/kehadiran/save', 'store')->name('kehadiran.store');
            Route::post('/kehadiran/update/{id}', 'update')->name('kehadiran.update');
            Route::get('/kehadiran/destroy/{id}', 'destroy')->name('kehadiran.destroy');
        });

        // profil
        Route::controller(GuruController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/profil', 'profil')->name('profil');
        });
    });
    Route::group(['middleware' => ["siswa"]], function () {
        Route::controller(SiswaController::class)->prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/siswa/jadwal-pelajaran', 'show_jadwal')->name('show_jadwal');
            Route::get('/siswa/kehadiran', 'show_kehadiran')->name('show_kehadiran');
            Route::get('/siswa/nilai', 'show_nilai')->name('show_nilai');
            Route::get('/profil', 'profil')->name('profil');
            Route::get('/siswa/nilai/filter', 'filter_nilai')->name('nilai.filter');
        });
    });
});
