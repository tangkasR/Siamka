<?php

namespace App\Imports;

use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    protected $tahun_ajaran;
    protected $semester;
    protected $rombel_id;

    public function __construct($tahun_ajaran, $semester, $rombel_id)
    {
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester = $semester;
        $this->rombel_id = $rombel_id;
    }

    public function collection(Collection $rows)
    {
        $tahun_ajaran = TahunAjaran::where('tahun_ajaran', $this->tahun_ajaran)
            ->where('semester', $this->semester)
            ->first();
        $tahun_ajaran_id = $tahun_ajaran->id;
        $rombel = Rombel::where('id', $this->rombel_id)->first();
        $rombel_id = $rombel->id;
        $check = 0;

        foreach ($rows as $row) {
            if ($rombel != null) {
                if ($row['nama'] != null && $row['nis'] != null && $row['nisn'] != null && $row['nomor_id'] != null && $row['jenis_kelamin'] != null) {
                    $checkSiswa = Siswa::where('nis', $row['nis'])->where('tahun_ajaran_id', $tahun_ajaran_id)->first();
                    if ($checkSiswa == null) {
                        $check++;
                        $siswa = Siswa::create([
                            'nama' => $row['nama'],
                            'nis' => $row['nis'],
                            'nisn' => $row['nisn'],
                            'nomor_id' => $row['nomor_id'],
                            'jenis_kelamin' => $row['jenis_kelamin'],
                            'username' => '-',
                            'password' => Hash::make($row['nomor_id']),
                            'nik' => '-',
                            'tempat_tanggal_lahir' => '-',
                            'alamat' => '-',
                            'no_hp' => '-',
                            'kompetensi_keahlian' => '-',
                            'agama' => '-',
                            'nama_ayah' => '-',
                            'nama_ibu' => '-',
                            'pekerjaan_orang_tua' => '-',
                            'no_hp_orang_tua' => '-',
                            'asal_smp' => '-',
                            'tahun_lulus_smp' => '-',
                            'status_siswa' => 'belum lulus',
                            'aktivasi_akun' => 'tidak aktif',
                            'profil' => '-',
                            'tahun_ajaran_id' => $tahun_ajaran_id,
                        ]);
                        $siswa->rombels()->attach($rombel);
                    }
                }
            }
        }
        if ($check == 0) {
            $message = 'Data siswa rombel = ' . $rombel->nama_rombel . ' | tahun ajaran = ' . $tahun_ajaran->tahun_ajaran . ' | semester = ' . $tahun_ajaran->semester . ' sudah dimasukan!';
            throw ValidationException::withMessages(['error' => $message]);
        }

    }
}
