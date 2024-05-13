<?php

namespace App\Imports;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['rombongan_belajar'] != null) {
                $rombel = Rombel::where('nama_rombel', $row['rombongan_belajar'])->first();
            }
            if ($rombel != null) {
                $tanggal_lahir = Date::excelToDateTimeObject($row['tanggal_lahir'])->format('d-m-Y');
                $siswa = Siswa::create([
                    'nama' => $row['nama'],
                    'nik' => $row['nik'],
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['password']),
                ]);
                // dd($rombel->id);
                $siswa->rombels()->attach($rombel, [
                    'tahun_pembelajaran' => $row['tahun_pembelajaran'],
                ]);
            } else {
                return redirect()->back();
            }
        }
    }
}
