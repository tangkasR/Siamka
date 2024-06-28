<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Rombel;
use App\Models\Ruangan;
use App\Models\Sesi;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalImport implements ToCollection, WithHeadingRow
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
        $checkJadwal = JadwalPelajaran::where('tahun_ajaran_id', $tahun_ajaran_id)->where('rombel_id', $rombel->id)->get();
        $hari = '';

        if (count($checkJadwal) == 0) {
            foreach ($rows as $row) {
                if ($row['hari'] != '') {
                    $hari = $row['hari'];
                }

                $ruangan = Ruangan::where('nomor_ruangan', $row['ruangan'])->first();
                $sesi = Sesi::where('nama_sesi', $row['sesi'])->first();
                $guru = Guru::with('mapels')->where('nomor_induk_yayasan', $row['niy_guru'])->where('tahun_ajaran_id', $tahun_ajaran_id)->first();

                if ($guru != null) {
                    if ($guru->rombels) {
                        $checkGuru = $guru->rombels()->where('rombel_id', $rombel->id)->get();
                    }
                    if (count($checkGuru) == 0) {
                        $guru->rombels()->attach($rombel);
                    }
                }
                if ($ruangan != null && $rombel != null && $sesi != null && $guru != null && $hari != '') {
                    if (count($guru->mapels) > 1) {
                        $nama_mapel = '-';
                    } else {
                        $nama_mapel = $guru->mapels[0]->nama_mata_pelajaran;
                    }
                    JadwalPelajaran::create([
                        'ruangan_id' => $ruangan->id,
                        'rombel_id' => $rombel->id,
                        'guru_id' => $guru->id,
                        'sesi_id' => $sesi->id,
                        'hari' => $hari,
                        'nama_mata_pelajaran' => $nama_mapel,
                        'tahun_ajaran_id' => $tahun_ajaran_id,
                    ]);
                } else {
                    return redirect()->back();
                }
            }
        } else {
            $message = 'Data jadwal pelajaran rombel = ' . $rombel->nama_rombel . ' | tahun ajaran = ' . $tahun_ajaran->tahun_ajaran . ' | semester = ' . $tahun_ajaran->semester . ' sudah dimasukan!';
            throw ValidationException::withMessages(['error' => $message]);
        }
    }
}
