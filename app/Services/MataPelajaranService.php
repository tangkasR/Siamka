<?php

namespace App\Services;

use App\Interfaces\MataPelajaranInterface;

class MataPelajaranService
{
    protected $mapel;
    public function __construct(MataPelajaranInterface $mapel)
    {
        $this->mapel = $mapel;
    }
    public function getOne($id)
    {
        return $this->mapel->getOne($id);
    }
    public function getAll()
    {
        return $this->mapel->getAll();
    }
    public function store($nama_mata_pelajarans)
    {
        return $this->handleStore($nama_mata_pelajarans);
    }
    public function update($data, $id)
    {
        return $this->mapel->update($data['nama_mata_pelajaran'], $id);
    }
    public function destroy($id)
    {
        return $this->mapel->destroy($id);
    }
    private function handleStore($datas)
    {
        foreach ($datas as $data) {
            $this->mapel->store($data);
        }
    }
}
