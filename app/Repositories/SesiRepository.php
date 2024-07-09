<?php

namespace App\Repositories;

use App\Interfaces\SesiInterface;
use App\Models\Sesi;

class SesiRepository implements SesiInterface
{
    private $sesi;
    public function __construct(Sesi $sesi)
    {
        $this->sesi = $sesi;
    }

    public function getAll()
    {
        return $this->sesi->get();
    }
    public function store($data)
    {
        return $this->sesi->create([
            'nama_sesi' => $data,
        ]);
    }
    public function getById($nama)
    {
        return $this->sesi->where('nama_sesi', $nama)->first();
    }

    public function update($data, $sesi)
    {
        return $sesi->update([
            'nama_sesi' => $data,
        ]);
    }
    public function destroy($sesi)
    {
        return $sesi->delete();
    }
}
