<?php

namespace App\Repositories;

use App\Imports\SiswaImport;
use App\Interfaces\SiswaInterface;
use App\Models\Siswa;
use App\Services\DateService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
    public function getByNama($nama)
    {
        return $this->siswa->with('rombels')->where('nama', $nama)->first();
    }

    public function getNotActive($angkatan, $nama_rombel)
    {
        // mencari rombel terbaru setiap siswa
        return $this->siswa
            ->whereRaw('LEFT(nis, 2) = ?', [$angkatan])
            ->where('status_siswa', '!=', 'belum lulus')
            ->join('rombel_siswa', 'id', 'rombel_siswa.siswa_id')
            ->join('rombels', 'rombel_siswa.rombel_id', 'rombels.id')
            ->where('rombels.nama_rombel', $nama_rombel)
            ->select('*')
            ->get();
    }
    public function getNotActiveRombel($angkatan)
    {
        // mencari rombel terbaru setiap siswa
        $rombels = $this->siswa
            ->whereRaw('LEFT(nis, 2) = ?', [$angkatan])
            ->where('status_siswa', '!=', 'belum lulus')
            ->with(['rombels' => function ($query) {
                $query->select('nama_rombel');
            }])
            ->get()
            ->pluck('rombels.*.nama_rombel')
            ->flatten()
            ->unique();

        return $rombels->values();
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
            'username' => $siswa->nomor_id,
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
    public function create($siswa, $tahun_ajaran_id, $rombel)
    {
        $check = 0;
        $checkSiswa = $this->siswa->where('nis', $siswa->nis)->where('tahun_ajaran_id', $tahun_ajaran_id)->first();

        if ($checkSiswa == null) {
            $siswa = $this->siswa->create([
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'nisn' => $siswa->nisn,
                'nomor_id' => $siswa->nomor_id,
                'jenis_kelamin' => $siswa->jenis_kelamin,
                'username' => '-',
                'password' => $siswa->password,
                'nik' => $siswa->nik,
                'tempat_tanggal_lahir' => $siswa->tempat_tanggal_lahir,
                'alamat' => $siswa->alamat,
                'no_hp' => $siswa->no_hp,
                'kompetensi_keahlian' => $siswa->kompetensi_keahlian,
                'agama' => $siswa->agama,
                'nama_ayah' => $siswa->nama_ayah,
                'nama_ibu' => $siswa->nama_ibu,
                'pekerjaan_orang_tua' => $siswa->pekerjaan_orang_tua,
                'no_hp_orang_tua' => $siswa->no_hp_orang_tua,
                'asal_smp' => $siswa->asal_smp,
                'tahun_lulus_smp' => $siswa->tahun_lulus_smp,
                'status_siswa' => 'belum lulus',
                'aktivasi_akun' => 'tidak aktif',
                'profil' => $siswa->profil,
                'tahun_ajaran_id' => $tahun_ajaran_id,
            ]);

            $siswa->rombels()->attach($rombel);
            $check++;
        }
        if ($check == 0) {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah naik kelas']);
        }
        return;
    }
}
