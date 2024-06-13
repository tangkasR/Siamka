<?php

namespace App\Repositories;

use App\Imports\SiswaImport;
use App\Interfaces\SiswaInterface;
use App\Models\Siswa;
use App\Services\DateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaRepository implements SiswaInterface
{
    private $siswa;
    private $date;

    public function __construct(Siswa $siswa, DateService $date)
    {
        $this->siswa = $siswa;
        $this->date = $date;
    }
    public function getById($id)
    {
        return $this->siswa->with('rombels', 'kehadirans', 'ekskuls', 'ekskuls.gurus')->where('id', $id)->first();
    }
    public function getPivotTahunPembelajaran($id)
    {
        return DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('siswas.id', '=', $id)
            ->select(
                'rombel_siswa.tahun_awal',
                'rombel_siswa.tahun_akhir',
            )
            ->get()->last();
    }
    public function getByNama($nama)
    {
        return $this->siswa->with('rombels')->where('nama', $nama)->first();
    }
    public function getByRombelIdNotActiveAccount($id)
    {
        $currentYear = $this->date->getDate()->year;
        // Dapatkan bulan sekarang
        $currentMonth = $this->date->getDate()->month;
        // Query untuk mendapatkan siswa
        $siswas = DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $id)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->where('siswas.aktivasi_akun', '=', 'tidak aktif')
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->where(function ($subQuery) use ($currentMonth, $currentYear) {
                    $subQuery->where('rombel_siswa.tahun_awal', $currentYear)
                        ->whereBetween(DB::raw($currentMonth), [7, 12]);
                })
                    ->orWhere(function ($subQuery) use ($currentMonth, $currentYear) {
                        $subQuery->where('rombel_siswa.tahun_akhir', $currentYear)
                            ->whereBetween(DB::raw($currentMonth), [1, 6]);
                    });
            })
            ->select(
                'siswas.id',
                'siswas.nama',
            )
            ->get();

        return $siswas;
    }
    public function getByRombelIdActive($id)
    {
        $currentYear = $this->date->getDate()->year;
        $currentMonth = $this->date->getDate()->month;

        $siswas = DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $id)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->where(function ($subQuery) use ($currentMonth, $currentYear) {
                    $subQuery->where('rombel_siswa.tahun_awal', $currentYear)
                        ->whereBetween(DB::raw($currentMonth), [7, 12]);
                })
                    ->orWhere(function ($subQuery) use ($currentMonth, $currentYear) {
                        $subQuery->where('rombel_siswa.tahun_akhir', $currentYear)
                            ->whereBetween(DB::raw($currentMonth), [1, 6]);
                    });
            })
            ->select(
                'siswas.id',
                'siswas.nama',
                'siswas.nis',
                'siswas.nisn',
                'siswas.nomor_id',
                'siswas.jenis_kelamin',
                'siswas.status_siswa',
                'siswas.aktivasi_akun',
                'siswas.username',
                'siswas.password',
                'rombel_siswa.tahun_awal',
                'rombel_siswa.tahun_akhir',
            )
            ->get();

        return $siswas;
    }
    public function getByRombelIdNextGrade($id)
    {
        $currentYear = $this->date->getDate()->year;
        $currentMonth = $this->date->getDate()->month;

        $siswas = DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $id)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->Where(function ($subQuery) use ($currentMonth, $currentYear) {
                    $subQuery->where('rombel_siswa.tahun_akhir', $currentYear)
                        ->whereBetween(DB::raw($currentMonth), [7, 12]);
                });
            })
            ->select(
                'siswas.id',
            )
            ->get();

        return $siswas;
    }
    public function getNotActive($angkatan)
    {
        // mencari rombel terbaru setiap siswa
        return $this->siswa
            ->whereRaw('LEFT(nis, 2) = ?', [$angkatan])
            ->where('status_siswa', '!=', 'belum lulus')
            ->get();
    }

    public function store($data)
    {
        return Excel::import(new SiswaImport, $data['file']);
    }
    public function update($data, $id)
    {
        return $this->siswa->where('id', $id)->update([
            'nama' => $data['nama'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'nomor_id' => $data['nomor_id'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'status_siswa' => $data['status_siswa'],
        ]);
    }
    public function destroy($id)
    {
        return $this->siswa->where('id', $id)->delete();
    }
    public function lulus($id)
    {
        return $this->siswa->where('id', $id)->update([
            'status_siswa' => 'lulus',
            'aktivasi_akun' => 'tidak aktif',
        ]);
    }

    public function aktivasi($id)
    {
        return $this->siswa->where('id', $id)->update([
            'aktivasi_akun' => 'aktif',
        ]);
    }
    public function deaktivasi($id)
    {
        return $this->siswa->where('id', $id)->update([
            'aktivasi_akun' => 'tidak aktif',
        ]);
    }
    public function update_profil($datas, $id)
    {
        return $this->siswa->where('id', $id)->update([
            'profil' => $datas['profil'],
            'nik' => $datas['nik'],
            'tempat_tanggal_lahir' => $datas['tempat_tanggal_lahir'],
            'alamat' => $datas['alamat'],
            'no_hp' => $datas['no_hp'],
            'kompetensi_keahlian' => $datas['kompetensi_keahlian'],
            'agama' => $datas['agama'],
            'nama_ayah' => $datas['nama_ayah'],
            'nama_ibu' => $datas['nama_ibu'],
            'pekerjaan_orang_tua' => $datas['pekerjaan_orang_tua'],
            'no_hp_orang_tua' => $datas['no_hp_orang_tua'],
            'asal_smp' => $datas['asal_smp'],
            'tahun_lulus_smp' => $datas['tahun_lulus_smp'],
        ]);
    }
    public function getAngkatan()
    {
        return $this->siswa
            ->where('status_siswa', '!=', 'belum lulus')
            ->selectRaw("LEFT(nis, 2) as angkatan")
            ->distinct()
            ->get();
    }
}
