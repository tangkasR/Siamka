<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RombelImport implements ToCollection, WithHeadingRow
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
        foreach ($rows as $row) {
            if ($row['niy'] != null && $row['nama_rombel'] != null) {
                $guru = Guru::where('nomor_induk_yayasan', $row['niy'])->where('tahun_ajaran_id', $tahun_ajaran_id)->first();
                if ($guru) {
                    $checkrombel = Rombel::where('tahun_ajaran_id', $tahun_ajaran_id)->where('guru_id', $guru->id)->first();
                    if ($checkrombel == null) {
                        $check++;
                        Rombel::create([
                            'guru_id' => $guru->id,
                            'tahun_ajaran_id' => $tahun_ajaran_id,
                            'nama_rombel' => $row['nama_rombel'],
                        ]);
                    }

                }
            }
        }
        if ($check == 0) {
            $message = 'Data rombel dengan tahun ajaran = ' . $tahun_ajaran->tahun_ajaran . ' | semester = ' . $tahun_ajaran->semester . ' sudah dimasukan!';
            throw ValidationException::withMessages(['error' => $message]);
        }
    }
}
