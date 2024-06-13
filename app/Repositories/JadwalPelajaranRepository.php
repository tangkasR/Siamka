<?php

namespace App\Repositories;

use App\Imports\JadwalImport;
use App\Interfaces\JadwalPelajaranInterface;
use App\Models\JadwalPelajaran;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPelajaranRepository implements JadwalPelajaranInterface
{
    private $jadwal;
    public function __construct(JadwalPelajaran $jadwal)
    {
        $this->jadwal = $jadwal;
    }
    public function getByRombelId($id)
    {
        return $this->jadwal->with('ruangans', 'sesis', 'gurus')->where('rombel_id', $id)->get();
    }
    public function store($data)
    {
        return Excel::import(new JadwalImport, $data['file']);
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
        return $this->jadwal->where('rombel_id', $id)->delete();
    }
}
