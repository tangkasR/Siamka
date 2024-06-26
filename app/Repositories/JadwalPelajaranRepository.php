<?php

namespace App\Repositories;

use App\Imports\JadwalImport;
use App\Interfaces\JadwalPelajaranInterface;
use App\Models\JadwalPelajaran;
use App\Services\DateService;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPelajaranRepository implements JadwalPelajaranInterface
{
    private $jadwal;
    private $date;

    public function __construct(JadwalPelajaran $jadwal, DateService $date)
    {
        $this->jadwal = $jadwal;
        $this->date = $date;
    }
    public function getByRombelId($id)
    {
        return $this->jadwal->with('ruangans', 'sesis', 'gurus')->where('rombel_id', $id)->get();
    }
    public function store($data)
    {
        return Excel::import(new JadwalImport($data['tahun'], $data['semester'], $data['rombel_id']), $data['file']);
    }
    public function update($data, $id)
    {
        return $this->jadwal->where('id', $id)->update([
            'ruangan_id' => $data['ruangan_id'],
            'guru_id' => $data['guru_id'],
            'nama_mata_pelajaran' => $data['nama_mata_pelajaran'],
        ]);
    }
    public function destroyAllByRombelId($id)
    {
        return $this->jadwal->where('tahun_ajaran_id', $id)->delete();
    }
    private function translateDayToIndonesian($englishDay)
    {
        $days = [
            'Sunday' => 'minggu',
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
        ];

        return $days[$englishDay] ?? $englishDay;
    }
    public function getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id)
    {
        return $this->jadwal
            ->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->where('sesi_id', 1)
            ->where('hari', $this->translateDayToIndonesian($this->date->getDate()->format('l')))
            ->where('guru_id', $guru_id)
            ->with('rombels')->first();

    }
}
