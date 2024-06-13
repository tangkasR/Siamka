<?php

namespace App\Services;

use App\Interfaces\SesiInterface;

class SesiService
{
    protected $sesi;
    public function __construct(SesiInterface $sesi)
    {
        $this->sesi = $sesi;
    }
    public function getAll()
    {
        return $this->sesi->getAll();
    }
    public function getByNama($nama)
    {
        return $this->sesi->getById($nama);
    }
    public function store($nama_sesis)
    {
        return $this->handleStore($nama_sesis);
    }
    public function update($data, $sesi)
    {
        return $this->sesi->update($data['nama_sesi'], $sesi);
    }
    public function destroy($sesi)
    {
        return $this->sesi->destroy($sesi);
    }
    private function handleStore($datas)
    {
        foreach ($datas as $data) {
            $this->sesi->store($data);
        }
    }
}
