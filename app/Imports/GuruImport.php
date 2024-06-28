<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToCollection, WithHeadingRow
{
    protected $tahun_ajaran;
    protected $semester;

    public function __construct($tahun_ajaran, $semester)
    {
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester = $semester;
    }

    public function collection(Collection $rows)
    {
        $tahun_ajaran = TahunAjaran::where('tahun_ajaran', $this->tahun_ajaran)
            ->where('semester', $this->semester)
            ->first();
        $tahun_ajaran_id = $tahun_ajaran->id;
        $check = 0;

        foreach ($rows as $index => $row) {
            if ($row['nama'] != null && $row['jabatan'] != null && $row['niy'] != null && $row['password'] != null && $tahun_ajaran_id != null) {
                $checkInput = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->where('nomor_induk_yayasan', $row['niy'])->first();
                if ($checkInput == null) {
                    $check++;
                    $guru = Guru::create([
                        'nama' => $row['nama'],
                        'jabatan' => $row['jabatan'],
                        'nomor_induk_yayasan' => $row['niy'],
                        'username' => '-',
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
                        'tahun_ajaran_id' => $tahun_ajaran_id,
                        'status_akun' => 'tidak aktif',
                    ]);
                    $nama_mapel1 = str_replace('_', ' ', $row['mapel1']);
                    $mapel1 = MataPelajaran::where(DB::raw('LOWER(nama_mata_pelajaran)'), 'like', '%' . strtolower($nama_mapel1) . '%')->first();
                    $guru->mapels()->attach($mapel1);
                    if ($row['mapel2'] != null) {
                        $nama_mapel2 = str_replace('_', ' ', $row['mapel2']);
                        $mapel2 = MataPelajaran::where(DB::raw('LOWER(nama_mata_pelajaran)'), 'like', '%' . strtolower($nama_mapel2) . '%')->first();
                        $guru->mapels()->attach($mapel2);
                    }
                }
            }
        }
        if ($check == 0) {
            $message = 'Data guru dengan tahun ajaran = ' . $tahun_ajaran->tahun_ajaran . ' | semester = ' . $tahun_ajaran->semester . ' sudah dimasukan!';
            throw ValidationException::withMessages(['error' => $message]);
        }

    }
}
