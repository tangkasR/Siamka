<?php

namespace App\Services;

use App\Interfaces\RombelInterface;
use App\Services\GuruService;

class RombelService
{
    private $rombel;
    private $guru;

    public function __construct(RombelInterface $rombel, GuruService $guru)
    {
        $this->rombel = $rombel;
        $this->guru = $guru;
    }
    public function getAll($id)
    {
        return $this->rombel->getAll($id);
    }
    public function rombelWithoutGuru($id, $tahun_ajaran_id)
    {
        return $this->rombel->rombelWithoutGuru($id, $tahun_ajaran_id);
    }
    public function getOne($rombel)
    {
        return $this->rombel->getOne($rombel);
    }

    public function getBySiswaId($id)
    {
        return $this->rombel->getBySiswaId($id);
    }
    public function getGuruBukanWaliKelas($id)
    {
        return $this->handleGuruBukanWaliKelas($id);
    }
    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    public function update($data, $rombel)
    {
        return $this->rombel->update($data, $rombel);
    }
    public function destroy($rombel)
    {
        return $this->rombel->destroy($rombel);
    }
    private function handleStore($datas)
    {
        $index = 0;
        foreach ($datas['nama_rombel'] as $nama_rombel) {
            $this->rombel->store($datas['guru_id'][$index], $nama_rombel, $datas['tahun_ajaran_id']);
            $index++;
        }
    }
    private function handleGuruBukanWaliKelas($id)
    {
        $gurus = $this->guru->getAll($id);
        $guru_wali_kelas = [];
        $rombels = $this->rombel->getAll($id);
        foreach ($rombels as $rombel) {
            array_push($guru_wali_kelas, $rombel->guru_id);
        }

        $gurus_bukan_wali_kelas = [];
        foreach ($gurus as $guru) {
            if (!in_array($guru->id, $guru_wali_kelas)) {
                array_push($gurus_bukan_wali_kelas, [
                    'id' => $guru->id,
                    'nama' => $guru->nama,
                ]);
            }
        }
        return $gurus_bukan_wali_kelas;
    }
    public function getRombelGuru($niy, $tahun_ajaran_id)
    {
        return $this->rombel->getRombelGuru($niy, $tahun_ajaran_id);
    }
}
