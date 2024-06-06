<?php

namespace App\Imports;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // dd($rows);
            if ($row['rombongan_belajar'] != null) {
                $rombel = Rombel::where('nama_rombel', $row['rombongan_belajar'])->first();
            }
            if ($row['tahun_pembelajaran'] != null) {
                $tahun_pembelajaran = $row['tahun_pembelajaran'];
            }
            if ($rombel != null) {
                if ($tahun_pembelajaran != null) {
                    if ($row['nama'] != null && $row['nis'] && $row['nisn'] && $row['nomor_id'] && $row['jenis_kelamin']) {
                        $tahun_awal = explode("/", $tahun_pembelajaran)[0];
                        $tahun_akhir = explode("/", $tahun_pembelajaran)[1];
                        $siswa = Siswa::create([
                            'nama' => $row['nama'],
                            'nis' => $row['nis'],
                            'nisn' => $row['nisn'],
                            'nomor_id' => $row['nomor_id'],
                            'jenis_kelamin' => $row['jenis_kelamin'],
                            'username' => $row['nisn'],
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
                        ]);
                        $siswa->rombels()->attach($rombel, [
                            'tahun_awal' => $tahun_awal,
                            'tahun_akhir' => $tahun_akhir,
                        ]);
                    }
                }
            }
        }
    }
}
