<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToCollection, WithHeadingRow
{
    protected $tahun_ajaran;
    protected $semester;
    protected $rombel_id;

    public function __construct($tahun_ajaran, $semester, $mapel_id, $tipe_ujian, $semester_nilai)
    {
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester = $semester;
        $this->mapel_id = $mapel_id;
        $this->tipe_ujian = $tipe_ujian;
        $this->semester_nilai = $semester_nilai;
    }
    public function collection(Collection $rows)
    {
        $tahun_ajaran = TahunAjaran::where('tahun_ajaran', $this->tahun_ajaran)
            ->where('semester', $this->semester)
            ->first();
        $tahun_ajaran_id = $tahun_ajaran->id;
        $check = 0;

        foreach ($rows as $row) {
            $siswa = Siswa::where('tahun_ajaran_id', $tahun_ajaran_id)->where('nama', $row['nama'])->where('nomor_id', $row['nomor_id'])->first();
            if ($siswa != null && $row['nilai'] != null) {
                $checkNilaiSiswa = Nilai::where('siswa_id', $siswa->id)->where('mata_pelajaran_id', $this->mapel_id)
                    ->where('tahun_ajaran_id', $tahun_ajaran_id)->where('tipe_ujian', $this->tipe_ujian)->where('semester', $this->semester_nilai)->get();
                if (count($checkNilaiSiswa) == 0) {
                    $check++;
                    Nilai::create([
                        'siswa_id' => $siswa->id,
                        'mata_pelajaran_id' => $this->mapel_id,
                        'tahun_ajaran_id' => $tahun_ajaran_id,
                        'tipe_ujian' => $this->tipe_ujian,
                        'nilai' => $row['nilai'],
                        'semester' => $this->semester_nilai,
                    ]);
                }
            }
        }
        if ($check == 0) {
            $message = 'Data nilai sudah dimasukan!';
            throw ValidationException::withMessages(['error' => $message]);
        }
    }
}
