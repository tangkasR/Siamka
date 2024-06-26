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
    public function getById($siswa)
    {
        if (is_object($siswa)) {
            return $siswa->with('rombels', 'kehadirans', 'ekskuls', 'ekskuls.gurus')->first();
        }
        return $this->siswa->with('rombels', 'kehadirans', 'ekskuls', 'ekskuls.gurus')->where('id', $siswa)->first();
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
                    $subQuery->where('rombel_siswa.tahun_awal', $currentYear) // membuat kondisi jika pivot tahun awal sama dengan tahun sekarang
                        ->whereBetween(DB::raw($currentMonth), [7, 12]); // maka dari bulan juli sampai desember
                })
                    ->orWhere(function ($subQuery) use ($currentMonth, $currentYear) {
                        $subQuery->where('rombel_siswa.tahun_akhir', $currentYear) // membuat kondisi jika pivot tahun akhir sama dengan tahun sekarang
                            ->whereBetween(DB::raw($currentMonth), [1, 6]); // maka dari bulan januari sampai juni
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
                    $subQuery->where('rombel_siswa.tahun_awal', $currentYear) // membuat kondisi jika pivot tahun awal sama dengan tahun sekarang
                        ->whereBetween(DB::raw($currentMonth), [7, 12]); // maka dari bulan juli sampai desember
                })
                    ->orWhere(function ($subQuery) use ($currentMonth, $currentYear) {
                        $subQuery->where('rombel_siswa.tahun_akhir', $currentYear) // membuat kondisi jika pivot tahun akhir sama dengan tahun sekarang
                            ->whereBetween(DB::raw($currentMonth), [1, 6]); // maka dari bulan januari sampai juni
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
            ->orderBy('siswas.nama')
            ->get();

        return $siswas;
    }
    public function getByRombelIdNextGrade($id)
    {
        $currentYear = $this->date->getDate()->year;
        $currentMonth = $this->date->getDate()->month;

        // Subquery untuk mendapatkan siswa yang berada di rombel terakhir (tahun_akhir terbaru) berdasarkan rombel_id tertentu
        $subQuery = DB::table('rombel_siswa as rs1')
            ->select('rs1.siswa_id') // mengambil siswa id dari rombel_siswa 1
            ->where('rs1.rombel_id', $id) // membuat kondisi berdasarkan rombel_id tertentu
            ->where('rs1.tahun_akhir', $currentYear) // membuat kondisi berdasarkan pivot rombel_id tahun akhir sama dengan tahun sekarang
            ->whereBetween(DB::raw($currentMonth), [7, 12]) // membuat kondisi jika bulan sekarang antara juli sampai desember karena bulan tersebut sudah tahun ajaran baru
            ->where('rs1.tahun_akhir', function ($query) {
                $query->select(DB::raw('MAX(rs2.tahun_akhir)')) // mendapatkan rombel_siswa dengan pivot tahun akhir paling akhir
                    ->from('rombel_siswa as rs2') //membuat alias rombel_siswa 2 menjadi rs2
                    ->whereColumn('rs2.siswa_id', 'rs1.siswa_id'); //nmembandingkan siswa antara rombel_siswa 1 dan rombel_siswa 2
            });

        // Query utama untuk mendapatkan siswa berdasarkan subquery rombel terakhir
        $siswas = DB::table('siswas')
            ->joinSub($subQuery, 'last_rombel', function ($join) { //join query dengan sub query alias last rombel
                $join->on('siswas.id', '=', 'last_rombel.siswa_id'); //mencari siswa id dengan rombel terakhir
            })
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select(
                'siswas.id',
                'siswas.nama',
                'siswas.profil'
            )
            ->orderBy('siswas.nama')
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
        return Excel::import(new SiswaImport($data['tahun'], $data['semester'], $data['rombel_id']), $data['file']);
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
            'username' => '-',
        ]);
    }

    public function aktivasi($id)
    {
        $siswa = $this->siswa->where('id', $id)->first();
        return $this->siswa->where('id', $id)->update([
            'aktivasi_akun' => 'aktif',
            'username' => $siswa->nisn,
        ]);
    }
    public function deaktivasi($id)
    {
        return $this->siswa->where('id', $id)->update([
            'aktivasi_akun' => 'tidak aktif',
            'username' => '-',
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
            ->orderBy('angkatan', 'asc')
            ->get();
    }

    public function getSiswa($id)
    {
        return $this->siswa
            ->where('status_siswa', 'belum lulus')
            ->with(['rombels', 'kehadirans', 'ekskuls', 'ekskuls.gurus'])
            ->whereHas('rombels', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();
    }
    public function getSiswaAdmin($id)
    {
        return $this->siswa
            ->with(['rombels', 'kehadirans', 'ekskuls', 'ekskuls.gurus'])
            ->whereHas('rombels', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();
    }

    public function keluar($id)
    {
        return $this->siswa->where('id', $id)->update([
            'status_siswa' => 'keluar',
        ]);
    }

    public function getSiswaPerAngkatan()
    {
        $total_siswa = $this->siswa
            ->selectRaw('LEFT(nis, 2) as angkatan,
                     COUNT(DISTINCT CASE WHEN jenis_kelamin = "L" THEN nis END) as total_laki_laki,
                     COUNT(DISTINCT CASE WHEN jenis_kelamin = "P" THEN nis END) as total_perempuan')
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'asc')
            ->get();

        return $total_siswa;
    }
}
