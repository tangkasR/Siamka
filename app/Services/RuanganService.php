<?php

namespace App\Services;

use App\Interfaces\RuanganInterface;

class RuanganService
{
    protected $ruangan;
    public function __construct(RuanganInterface $ruangan)
    {
        $this->ruangan = $ruangan;
    }
    public function getAll()
    {
        return $this->ruangan->getAll();
    }
    public function store($nomor_ruangans)
    {
        return $this->handleStore($nomor_ruangans);
    }
    public function update($data, $id)
    {
        return $this->ruangan->update($data['nomor_ruangan'], $id);
    }
    public function destroy($id)
    {
        return $this->ruangan->destroy($id);
    }
    private function handleStore($datas)
    {
        foreach ($datas as $data) {
            $this->ruangan->store($data);
        }
    }
}
