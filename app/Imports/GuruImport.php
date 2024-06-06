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
            $nama_mapel = $row['mapel'];
            $mapel = MataPelajaran::where('nama_mata_pelajaran', $nama_mapel)->first();
            if ($mapel != null) {
                $guru = Guru::create([
                    'mata_pelajaran_id' => $mapel->id,
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
            }
        }

    }
}
