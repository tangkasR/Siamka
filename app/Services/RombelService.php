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
    public function getAll()
    {
        return $this->rombel->getAll();
    }
    public function rombelWithoutGuru($id)
    {
        return $this->rombel->rombelWithoutGuru($id);
    }
    public function getByGuruId($id)
    {
        return $this->rombel->getByGuruId($id);
    }
    public function getOne($condition, $params)
    {
        return $this->rombel->getOne($condition, $params);
    }
    public function getByGuruIdSesiSatu($guru_id)
    {
        return $this->rombel->getByGuruIdSesiSatu($guru_id);
    }
    public function getBySiswaId($id)
    {
        return $this->rombel->getBySiswaId($id);
    }
    public function getGuruBukanWaliKelas()
    {
        return $this->handleGuruBukanWaliKelas();
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
            $this->rombel->store($datas['guru_id'][$index], $nama_rombel);
            $index++;
        }
    }
    private function handleGuruBukanWaliKelas()
    {
        $gurus = $this->guru->getAll();
        $guru_wali_kelas = [];
        $rombels = $this->rombel->getAll();
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
}
