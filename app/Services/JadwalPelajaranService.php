<?php

namespace App\Services;

use App\Interfaces\JadwalPelajaranInterface;
use App\Services\RombelService;
use App\Services\SesiService;

class JadwalPelajaranService
{
    private $jadwal;
    private $sesi;
    private $rombel;

    public function __construct(
        JadwalPelajaranInterface $jadwal,
        SesiService $sesi,
        RombelService $rombel
    ) {
        $this->jadwal = $jadwal;
        $this->sesi = $sesi;
        $this->rombel = $rombel;
    }
    public function getByRombelId($id)
    {
        return $this->jadwal->getByRombelId($id);
    }
    public function store($data)
    {
        return $this->jadwal->store($data);
    }
    public function update($data, $id)
    {
        return $this->jadwal->update($data, $id);
    }
    public function destroyAllByRombelId($id)
    {
        return $this->jadwal->destroyAllByRombelId($id);
    }
    public function createTemplate($rombel)
    {
        $sesi = $this->sesi->getAll();
        $hari = [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
        ];
        $templates = [];
        $temp_hari = '';
        foreach ($hari as $data) {
            if ($temp_hari != $data) {
                foreach ($sesi as $item_sesi) {
                    array_push($templates, [
                        'hari' => $data,
                        'sesi' => $item_sesi->nama_sesi,
                        'rombel' => $rombel->id,
                    ]);
                }
            }
            $temp_hari = $data;
        }
        return $templates;
    }
    public function getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id){
        return $this->jadwal->getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id);
    }
}
