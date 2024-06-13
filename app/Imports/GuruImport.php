<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        // input guru
        foreach ($rows as $index => $row) {
            if ($row['nama'] != '') {
                $guru = Guru::create([
                    'nama' => $row['nama'],
                    'jabatan' => $row['jabatan'],
                    'nomor_induk_yayasan' => $row['niy'],
                    'username' => $row['niy'],
                    'password' => Hash::make($row['password']),
                    'jenis_kelamin' => '-',
                    'tempat_tanggal_lahir' => '-',
                    'alamat' => '-',
                    'pendidikan_terakhir' => '-',
                    'no_hp' => '-',
                    'profil' => '-',
                    'ktp' => '-',
                    'ijazah' => '-',
                    'kartu_keluarga' => '-',
                ]);
                $nama_mapel1 = $row['mapel1'];
                $nama_mapel2 = $row['mapel2'];
                $mapel1 = MataPelajaran::where('nama_mata_pelajaran', $nama_mapel1)->first();
                $mapel2 = MataPelajaran::where('nama_mata_pelajaran', $nama_mapel2)->first();
                $guru->mapels()->attach($mapel1);
                if ($mapel2 != null) {
                    $guru->mapels()->attach($mapel2);
                }
            }
        }

    }
}
