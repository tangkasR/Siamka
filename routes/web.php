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
use App\Http\Controllers\TahunAjaranController;
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
    Route::controller(KehadiranController::class)->prefix('guru')->name('guru.')->group(function () {
        Route::post('/kehadiran/update/{id}', 'update')->name('kehadiran.update');
        Route::get('/kehadiran/destroy/{rombel_id}', 'destroy')->name('kehadiran.destroy');
    });

    Route::controller(TahunAjaranController::class)->prefix('tahun_ajaran')->name('tahun_ajaran.')->group(function () {
        Route::get('/tahun_ajaran/{type}', 'index')->name('index');
    });
    Route::controller(PengumumanController::class)->prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/show_pengumuman', 'show_pengumuman')->name('show_pengumuman');
        Route::get('/detail/{pengumuman}', 'detail')->name('detail');
    });
    Route::controller(GuruController::class)->prefix('guru')->name('guru.')->group(function () {
        Route::post('/download_ktp', 'download_ktp')->name('download_ktp');
        Route::post('/download_kk', 'download_kk')->name('download_kk');
        Route::post('/download_ijazah', 'download_ijazah')->name('download_ijazah');
    });
    Route::group(['middleware' => ["adminandguru"]], function () {
        Route::controller(SiswaController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/siswa/detail_siswa/{tahun}/{semester}/{rombel}/{id}', 'detail_siswa')->name('siswa.detail_siswa');
            Route::get('rekap_nilai/{tahun}/{semester}/{rombel}/{id}', 'rekap_nilai')->name('siswa.rekap_nilai');
            Route::get('rekap_kehadiran/{tahun}/{semester}/{rombel}/{id}', 'rekap_kehadiran')->name('siswa.rekap_kehadiran');
            Route::get('get_rekap_kehadiran/', 'getDataRekapKehadiran')->name('siswa.get_rekap_kehadiran');
        });

    });
    Route::group(['middleware' => ["admin"]], function () {
        // profil
        Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', 'index')->name('profil');
        });
        Route::controller(NilaiController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/show_nilai/{tahun}/{semester}', 'admin_show_nilai')->name('nilai.show_nilai');
            Route::get('/detail_nilai/{tahun}/{semester}/{rombel}', 'admin_detail_nilai')->name('nilai.detail_nilai');
            Route::get('/get_nilai', 'admin_get_nilai')->name('nilai.get_nilai');
        });
        Route::controller(KehadiranController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/show_kehadiran/{tahun}/{semester}', 'admin_show_kehadiran')->name('kehadiran.show_kehadiran');
            Route::get('/detail_kehadiran/{tahun}/{semester}/{rombel}', 'admin_detail_kehadiran')->name('kehadiran.detail_kehadiran');
            Route::get('/get_kehadiran', 'admin_get_kehadiran')->name('kehadiran.get_kehadiran');
            Route::get('/kehadiran/show_input/{tahun}/{semester}/{id}', 'admin_show_input')->name('kehadiran.show_input');
            Route::post('/kehadiran/save', 'admin_store')->name('kehadiran.store');
        });
        Route::controller(EkskulController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/show_ekskul/{tahun}/{semester}', 'admin_show_ekskul')->name('ekskul.show_ekskul');
        });
        Route::controller(NilaiEkskulController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/detail_ekskul/{tahun}/{semester}/{ekskul}', 'admin_detail_ekskul')->name('ekskul.detail_ekskul');
        });

        // siswa
        Route::controller(SiswaController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/siswa/show-siswa/{tahun}/{semester}/{rombel}', 'show_siswa')->name('siswa.show_siswa');
            Route::post('/siswa', 'store')->name('siswa.store');
            Route::post('/siswa/update/{id}', 'update')->name('siswa.update');
            Route::post('/siswa/move_class/{id}', 'move_class')->name('siswa.move_class');
            Route::delete('/siswa/destroy/{id}', 'destroy')->name('siswa.destroy');
            Route::put('/siswa/keluar/{id}', 'keluar')->name('siswa.keluar');

            Route::post('/siswa/next_grade', 'next_grade')->name('siswa.next_grade');
            Route::post('/siswa/aktivasi', 'aktivasi')->name('siswa.aktivasi');
            Route::post('/siswa/aktivasiAll/{rombel}', 'aktivasiAll')->name('siswa.aktivasiAll');
            Route::post('/siswa/deaktivasiAll/{rombel}', 'deaktivasiAll')->name('siswa.deaktivasiAll');
            Route::post('/siswa/deaktivasi/{id}', 'deaktivasi')->name('siswa.deaktivasi');

            Route::delete('/siswa/clear_data/{angkatan}/{nama_rombel}', 'clear_data')->name('siswa.clear_data');
            Route::get('/siswa/show_next_grade/{tahun}/{semester}/{rombel}', 'show_next_grade')->name('siswa.show_next_grade');
            Route::get('/siswa/show_lulus/{tahun}/{semester}/{rombel}', 'show_lulus')->name('siswa.show_lulus');
            Route::post('/siswa/lulus', 'lulus')->name('siswa.lulus');

            Route::get('/siswa/tambah_data/{tahun}/{semester}/{rombel}', 'tambah_data')->name('siswa.tambah_data');
            Route::post('/siswa/migrasi', 'migrasi')->name('siswa.migrasi');

            Route::get('/siswa_not_active', 'siswa_not_active_index')->name('siswa.siswa_not_active');
            Route::get('/siswa_not_active_rombel/{angkatan}', 'siswa_not_active_rombel')->name('siswa.siswa_not_active_rombel');
            Route::get('/not_active/{angkatan}/{nama_rombel}', 'siswa_not_active')->name('siswa.not_active');
        });

        // guru
        Route::controller(GuruController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/guru/{tahun}/{semester}', 'index')->name('guru');
            Route::post('/guru/update/{guru}', 'update')->name('guru.update');
            Route::delete('/guru/destroy/{guru}', 'destroy')->name('guru.destroy');
            Route::get('/guru/detail_guru/{tahun}/{semester}/{guru}', 'detail_guru')->name('guru.detail_guru');
            Route::get('/guru/cetak_kehadiran/{tahun}/{semester}/{guru}', 'cetak_kehadiran')->name('guru.cetak_kehadiran');
            Route::get('/guru/show_rombel/{tahun}/{semester}/{guru}', 'show_rombel_admin')->name('guru.show_rombel');
            Route::get('/tambah_rombel/{tahun}/{semester}/{guru}', 'tambah_rombel')->name('tambah_rombel');
            Route::post('/store_rombel/{guru}', 'store_rombel')->name('store_rombel');
            Route::get('/detach_rombel/{rombel}/{guru}', 'detach_rombel')->name('detach_rombel');
            Route::post('/guru/aktivasi/{id}', 'aktivasi')->name('guru.aktivasi');
            Route::post('/guru/deaktivasi/{id}', 'deaktivasi')->name('guru.deaktivasi');
            Route::post('/guru/aktivasi_all/{id}', 'aktivasi_all')->name('guru.aktivasi_all');
            Route::post('/guru/deaktivasi_all/{id}', 'deaktivasi_all')->name('guru.deaktivasi_all');
            Route::post('/guru', 'store')->name('guru.store');
            Route::get('/guru/tambah_data/{tahun}/{semester}', 'tambah_data')->name('guru.tambah_data');
            Route::get('/guru/filter_kehadiran/{tahun}/{semester}', 'filter_kehadiran')->name('guru.filter_kehadiran');
            Route::post('/guru/migrasi', 'migrasi')->name('guru.migrasi');
        });

        // rombel
        Route::controller(RombelController::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('/rombel/{tahun}/{semester}', 'index')->name('rombel');
            Route::post('/rombel', 'store')->name('rombel.store');
            Route::post('/rombel/update/{rombel}', 'update')->name('rombel.update');
            Route::delete('/rombel/destroy/{rombel}', 'destroy')->name('rombel.destroy');
            Route::get('/rombel/tambah_data/{tahun}/{semester}', 'tambah_data')->name('rombel.tambah_data');
            Route::post('/rombel/migrasi', 'migrasi')->name('rombel.migrasi');
            Route::get('/rombel/show/{tahun}/{semester}/{rombel}', 'show')->name('rombel.show');

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
            Route::get('/jadwal_pelajaran/show-jadwal/{tahun}/{semester}/{rombel}', 'show_jadwal')->name('jadwal_pelajaran.show_jadwal');
            Route::post('/jadwal_pelajaran', 'store')->name('jadwal_pelajaran.store');
            Route::post('/jadwal_pelajaran/update/{id}', 'update')->name('jadwal_pelajaran.update');
            Route::delete('/jadwal_pelajaran/destroy/{id}', 'destroy')->name('jadwal_pelajaran.destroy');
            Route::get('/jadwal_pelajaran/get-mapels', 'getMapelsByGuru')->name('jadwal_pelajaran.get-mapels');
            Route::get('/jadwal/tambah_data/{tahun}/{semester}/{rombel}', 'tambah_data')->name('jadwal.tambah_data');
            Route::post('/jadwal/migrasi', 'migrasi')->name('jadwal.migrasi');
        });

    });
    Route::group(['middleware' => ["guru"]], function () {

        // Nilai
        Route::controller(NilaiController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/nilai/{tahun}/{semester}', 'index')->name('nilai');
            Route::get('/nilai/filter', 'filter')->name('nilai.filter');
            Route::get('/nilai/daftar_siswa/{tahun}/{semester}/{rombel}', 'show_siswa')->name('nilai.show_siswa');
            Route::get('/nilai/input/{tahun}/{semester}/{tipe_ujian}/{rombel}', 'show_input')->name('nilai.show_input');
            Route::post('/nilai/save', 'store')->name('nilai.store');
            Route::post('/nilai/update/{nilai}', 'update')->name('nilai.update');
            Route::get('/nilai/destroy', 'destroy')->name('nilai.destroy');
            Route::get('/nilai/get-nilai', 'getNilai_guru')->name('nilai.get-nilai');
        });

        // Kehadiran
        Route::controller(KehadiranController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/kehadiran/{tahun}/{semester}', 'index')->name('kehadiran');
            Route::get('/kehadiran/filter', 'filter')->name('kehadiran.filter');
            Route::get('/kehadiran/show_input/{tahun}/{semester}/{id}', 'show_input')->name('kehadiran.show_input');
            Route::post('/kehadiran/save', 'store')->name('kehadiran.store');
            Route::get('/kehadiran/get-kehadiran', 'getKehadiran_guru')->name('kehadiran.get-kehadiran');
        });

        // ekskul
        Route::controller(EkskulController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/ekskul/{tahun}/{semester}', 'index')->name('ekskul');
            Route::get('/ekskul/daftar_anggota/{tahun}/{semester}/{id}', 'daftar_anggota')->name('ekskul.daftar_anggota');
            Route::get('/ekskul/daftar_rombel/{tahun}/{semester}/{tahun_ajaran}/{ekskul}', 'daftar_rombel')->name('ekskul.daftar_rombel');
            Route::get('/ekskul/show-siswa/{tahun}/{semester}/{ekskul}/{rombel}', 'show_siswa')->name('ekskul.show-siswa');
            Route::post('/ekskul/store', 'store')->name('ekskul.store');
            Route::post('/ekskul/addmember', 'addmember')->name('ekskul.addmember');
            Route::post('/ekskul/update/{id}', 'update')->name('ekskul.update');
            Route::delete('/ekskul/delete_member/{id}', 'delete_member')->name('ekskul.delete_member');
        });
        Route::controller(NilaiEkskulController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/show_ekskul/{tahun}/{semester}', 'index')->name('show_ekskul');
            Route::get('/show_rombel/{tahun}/{semester}/{ekskul_id}', 'show_rombel')->name('nilai_ekskul.show_rombel');
            Route::get('/nilai_ekskul/{tahun}/{semester}/{rombel}/{id}', 'nilai')->name('nilai_ekskul');
            Route::get('/tambah_nilai/{rombel}/{tahun_ajaran_id}/{ekskul}', 'tambah_nilai')->name('tambah_nilai');
            Route::post('/nilai_ekskul/store/{ekskul}', 'store')->name('nilai_ekskul.store');
            Route::post('/nilai_ekskul/update/{id}', 'update')->name('nilai_ekskul.update');
            Route::get('/nilai_ekskul/destroy/{id}', 'destroy')->name('nilai_ekskul.destroy');

        });

        // profil
        Route::controller(GuruController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/profil', 'profil')->name('profil');
            Route::post('/update_profil', 'update_profil')->name('update_profil');
            Route::get('/wali_kelas/{tahun}/{semester}', 'wali_kelas')->name('wali_kelas');
        });

        // absensi guru
        Route::controller(KehadiranGuruController::class)->prefix('guru')->name('guru.')->group(function () {
            Route::get('/kehadiran_guru', 'index')->name('kehadiran_guru');
            Route::post('/kehadiran_guru/store', 'store')->name('kehadiran_guru.store');
            Route::put('/kehadiran_guru/absen_keluar', 'absen_keluar')->name('kehadiran_guru.absen_keluar');
        });
    });
    Route::controller(KehadiranGuruController::class)->prefix('guru')->name('guru.')->group(function () {
        Route::get('/getData', 'getData')->name('kehadiran_guru.getData');
    });
    Route::controller(SiswaController::class)->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/siswa/nilai/get_nilai', 'getNilai')->name('nilai.get_nilai');
        Route::get('/siswa/get-kehadiran', 'get_kehadiran')->name('get-kehadiran');
        Route::get('/siswa/filter-kehadiran', 'filter_kehadiran')->name('filter-kehadiran');
        Route::get('/siswa/nilai/filter', 'filter_nilai')->name('nilai.filter');
        Route::get('/siswa/kehadiran', 'show_kehadiran')->name('show_kehadiran');
    });
    Route::group(['middleware' => ["siswa"]], function () {
        Route::controller(SiswaController::class)->prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/siswa/jadwal-pelajaran', 'show_jadwal')->name('show_jadwal');
            Route::get('/siswa/nilai', 'show_nilai')->name('show_nilai');
            Route::get('/profil', 'profil')->name('profil');
            Route::post('/update_profil', 'update_profil')->name('update_profil');
            Route::get('/siswa/ekskul', 'show_ekskul')->name('ekskul');
        });
    });
});
