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
        // dd($rows);
        foreach ($rows as $row) {
            $mapel = MataPelajaran::where('nama_mata_pelajaran', $row['nama_mapel'])->first();
            // dd($mapel);
            if ($mapel != null) {
                $siswa = Guru::create([
                    'mata_pelajaran_id' => $mapel->id,
                    'nama' => $row['nama'],
                    'nomor_induk' => $row['nomor_induk'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['password']),
                    'wali_kelas' => null,
                ]);
            }
        }

    }
}
