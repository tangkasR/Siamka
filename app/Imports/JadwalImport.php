<?php

namespace App\Imports;

use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $rombel = '';
        $hari = '';
        // dd($rows);
        foreach ($rows as $row) {
            if ($row['hari'] != null) {
                $hari = $row['hari'];
            }
            if ($row['rombel'] != null) {
                $rombel = $row['rombel'];
            }
            $id_ruangan = Ruangan::where('nomor_ruangan', $row['ruangan'])->first();
            $id_rombel = Rombel::where('nama_rombel', $rombel)->first();
            $id_mapel = MataPelajaran::where('nama_mata_pelajaran', $row['mapel'])->first();
            $id_sesi = Sesi::where('nama_sesi', $row['sesi'])->first();
            if ($id_ruangan != null && $id_rombel != null && $id_mapel != null && $id_sesi != null && $hari != '') {
                JadwalPelajaran::create([
                    'ruangan_id' => $id_ruangan->id,
                    'rombel_id' => $id_rombel->id,
                    'mata_pelajaran_id' => $id_mapel->id,
                    'sesi_id' => $id_sesi->id,
                    'hari' => $hari,
                ]);
            } else {
                return redirect()->back();
            }
        }
        // dd($hari);
    }
}
