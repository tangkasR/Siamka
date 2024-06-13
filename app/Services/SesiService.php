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
    public function update($data, $id)
    {
        return $this->sesi->update($data['nama_sesi'], $id);
    }
    public function destroy($id)
    {
        return $this->sesi->destroy($id);
    }
    private function handleStore($datas)
    {
        foreach ($datas as $data) {
            $this->sesi->store($data);
        }
    }
}
