<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KehadiranGuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiEkskulController;
use App\Http\Controllers\PengumumanController;
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
    Route::post('/login', [AuthController::class, 'login']);
});
Route::group(['middleware' => ["must-login"]], function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
    // auth
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::controller(PengumumanController::class)->prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/show_pengumuman', 'show_pengumuman')->name('show_pengumuman');
        Route::get('/detail/{id}', 'detail')->name('detail');
    });
    Route::controller(GuruController::class)->prefix('guru')->name('guru.')->group(function () {
        Route::post('/download_ktp', 'download_ktp')->name('download_ktp');
        Route::post('/download_kk', 'download_kk')->name('download_kk');
        Route::post('/download_ijazah', 'download_ijazah')->name('download_ijazah');
    });
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
            Route::post('/siswa/move_class/{id}', 'move_class')->name('siswa.move_class');
            Route::get('/siswa/destroy/{id}', 'destroy')->name('siswa.destroy');
            Route::get('/siswa/detail_siswa/{id}', 'detail_siswa')->name('siswa.detail_siswa');
            Route::post('/siswa/next_grade/{id}', 'next_grade')->name('siswa.next_grade');
            Route::post('/siswa/lulus/{id}', 'lulus')->name('siswa.lulus');
            Route::post('/siswa/aktivasi', 'aktivasi')->name('siswa.aktivasi');
            Route::get('/siswa/tambah_aktivasi/{id}', 'tambah_aktivasi')->name('siswa.tambah_aktivasi');
            Route::get('/siswa/deaktivasiAll/{id}', 'deaktivasiAll')->name('siswa.deaktivasiAll');
            Route::get('/siswa/deaktivasi/{id}', 'deaktivasi')->name('siswa.deaktivasi');
            Route::get('/siswa/rekap_nilai/{id}', 'rekap_nilai')->name('siswa.rekap_nilai');
            Route::get('/siswa/rekap_kehadiran/{id}', 'rekap_kehadiran')->name('siswa.rekap_kehadiran');
            Route::get('/siswa/siswa_not_active', 'siswa_not_active_index')->name('siswa.siswa_not_active');
            Route::get('/siswa/not_active/{angkatan}', 'siswa_not_active')->name('siswa.not_active');
            Route::get('/siswa/clear_data/{angkatan}', 'clear_data')->name('siswa.clear_data');
        });

        // guru
        Route::controller(GuruController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/guru', 'index')->name('guru');
            Route::post('/guru', 'store')->name('guru.store');
            Route::post('/guru/update/{guru}', 'update')->name('guru.update');
            Route::get('/guru/destroy/{guru}', 'destroy')->name('guru.destroy');
            Route::get('/guru/detail_guru/{id}', 'detail_guru')->name('guru.detail_guru');
            Route::get('/guru/cetak_kehadiran/{id}', 'cetak_kehadiran')->name('guru.cetak_kehadiran');
        });

        // rombel
        Route::controller(RombelController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/rombel', 'index')->name('rombel');
            Route::post('/rombel', 'store')->name('rombel.store');
            Route::post('/rombel/update/{rombel}', 'update')->name('rombel.update');
            Route::get('/rombel/destroy/{rombel}', 'destroy')->name('rombel.destroy');
        });

        // sesi
        Route::controller(SesiController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/sesi', 'index')->name('sesi');
            Route::post('/sesi', 'store')->name('sesi.store');
            Route::post('/sesi/update/{sesi}', 'update')->name('sesi.update');
            Route::get('/sesi/destroy/{sesi}', 'destroy')->name('sesi.destroy');
        });

        // ruangan
        Route::controller(RuanganController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/ruangan', 'index')->name('ruangan');
            Route::post('/ruangan', 'store')->name('ruangan.store');
            Route::post('/ruangan/update/{ruangan}', 'update')->name('ruangan.update');
            Route::get('/ruangan/destroy/{ruangan}', 'destroy')->name('ruangan.destroy');
        });

        // pengumuman
        Route::controller(PengumumanController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/pengumuman', 'index')->name('pengumuman');
            Route::post('/pengumuman', 'store')->name('pengumuman.store');
            Route::post('/pengumuman/update/{id}', 'update')->name('pengumuman.update');
            Route::get('/pengumuman/destroy/{id}', 'destroy')->name('pengumuman.destroy');
        });

        // mata pelajaran
        Route::controller(MataPelajaranController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/mapel', 'index')->name('mapel');
            Route::post('/mapel', 'store')->name('mapel.store');
            Route::post('/mapel/update/{mapel}', 'update')->name('mapel.update');
            Route::get('/mapel/destroy/{mapel}', 'destroy')->name('mapel.destroy');
        });

        // jadwal pelajaran
        Route::controller(JadwalPelajaranController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/jadwal_pelajaran', 'index')->name('jadwal_pelajaran');
            Route::get('/jadwal_pelajaran/show-jadwal/{id}', 'show_jadwal')->name('jadwal_pelajaran.show_jadwal');
            Route::post('/jadwal_pelajaran', 'store')->name('jadwal_pelajaran.store');
            Route::post('/jadwal_pelajaran/update/{id}', 'update')->name('jadwal_pelajaran.update');
            Route::get('/jadwal_pelajaran/destroy/{id}', 'destroy')->name('jadwal_pelajaran.destroy');
            Route::get('/jadwal_pelajaran/get-mapels/{guru_id}', 'getMapelsByGuru')->name('jadwal_pelajaran.get-mapels');
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
            Route::get('/nilai/destroy', 'destroy')->name('nilai.destroy');
            Route::get('/nilai/get-nilai', 'getNilai_guru')->name('nilai.get-nilai');
            Route::get('/nilai/show_update/{id}/{rombel_id}', 'show_update')->name('nilai.show_update');
        });

        // Kehadiran
        Route::controller(KehadiranController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/kehadiran', 'index')->name('kehadiran');
            Route::get('/kehadiran/filter', 'filter')->name('kehadiran.filter');
            Route::get('/kehadiran/show_input/{id}', 'show_input')->name('kehadiran.show_input');
            Route::post('/kehadiran/save', 'store')->name('kehadiran.store');
            Route::post('/kehadiran/update/{id}', 'update')->name('kehadiran.update');
            Route::get('/kehadiran/destroy/{rombel_id}', 'destroy')->name('kehadiran.destroy');
            Route::get('/kehadiran/get-kehadiran', 'getKehadiran_guru')->name('kehadiran.get-kehadiran');
            Route::get('/kehadiran/show_update/{id}/{siswa_id}', 'show_update')->name('kehadiran.show_update');
        });

        // ekskul
        Route::controller(EkskulController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/ekskul', 'index')->name('ekskul');
            Route::get('/ekskul/daftar_anggota/{id}', 'daftar_anggota')->name('ekskul.daftar_anggota');
            Route::get('/ekskul/daftar_rombel/{id}', 'daftar_rombel')->name('ekskul.daftar_rombel');
            Route::get('/ekskul/show-siswa/{id}/{rombel_id}', 'show_siswa')->name('ekskul.show-siswa');
            Route::post('/ekskul/store', 'store')->name('ekskul.store');
            Route::post('/ekskul/addmember', 'addmember')->name('ekskul.addmember');
            Route::post('/ekskul/update/{id}', 'update')->name('ekskul.update');
            Route::get('/ekskul/destroy/{id}', 'destroy')->name('ekskul.destroy');
            Route::get('/ekskul/delete_member/{id}', 'delete_member')->name('ekskul.delete_member');
            Route::post('/ekskul/change_status', 'change_status')->name('ekskul.change_status');
            Route::get('/ekskul/activate/{id}', 'activate')->name('ekskul.activate');
        });
        Route::controller(NilaiEkskulController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/show_ekskul', 'index')->name('show_ekskul');
            Route::get('/nilai_ekskul/{ekskul_id}', 'nilai')->name('nilai_ekskul');
            Route::get('/tambah_nilai/{ekskul_id}', 'tambah_nilai')->name('tambah_nilai');
            Route::post('/nilai_ekskul/store/{ekskul_id}', 'store')->name('nilai_ekskul.store');
            Route::post('/nilai_ekskul/update/{id}', 'update')->name('nilai_ekskul.update');
            Route::get('/nilai_ekskul/destroy/{id}', 'destroy')->name('nilai_ekskul.destroy');
        });

        // profil
        Route::controller(GuruController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/profil', 'profil')->name('profil');
            Route::get('/tambah_rombel', 'tambah_rombel')->name('tambah_rombel');
            Route::post('/update_profil', 'update_profil')->name('update_profil');
            Route::post('/store_rombel', 'store_rombel')->name('store_rombel');

        });

        // absensi guru
        Route::controller(KehadiranGuruController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/kehadiran_guru', 'index')->name('kehadiran_guru');
            Route::post('/kehadiran_guru/store', 'store')->name('kehadiran_guru.store');
        });
    });
    Route::controller(KehadiranGuruController::class)->prefix('guru')->name('guru.')->group(function () {
        Route::get('/getData', 'getData')->name('kehadiran_guru.getData');
    });
    Route::group(['middleware' => ["siswa"]], function () {
        Route::controller(SiswaController::class)->prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/siswa/jadwal-pelajaran', 'show_jadwal')->name('show_jadwal');
            Route::get('/siswa/nilai', 'show_nilai')->name('show_nilai');
            Route::get('/profil', 'profil')->name('profil');
            Route::post('/update_profil', 'update_profil')->name('update_profil');
            Route::get('/siswa/nilai/filter', 'filter_nilai')->name('nilai.filter');
            Route::get('/siswa/nilai/get_nilai', 'getNilai')->name('nilai.get_nilai');
            Route::get('/siswa/kehadiran', 'show_kehadiran')->name('show_kehadiran');
            Route::get('/siswa/get-kehadiran', 'get_kehadiran')->name('get-kehadiran');
            Route::get('/siswa/filter-kehadiran', 'filter_kehadiran')->name('filter-kehadiran');
            Route::get('/siswa/ekskul', 'show_ekskul')->name('ekskul');
        });
    });
});
