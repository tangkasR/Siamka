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
    public function update($data, $ruangan)
    {
        return $this->ruangan->update($data['nomor_ruangan'], $ruangan);
    }
    public function destroy($ruangan)
    {
        return $this->ruangan->destroy($ruangan);
    }
    private function handleStore($datas)
    {
        foreach ($datas as $data) {
            $this->ruangan->store($data);
        }
    }
}
