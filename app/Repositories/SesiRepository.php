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
        return $this->sesi->select('id', 'nama_sesi')->get();
    }
    public function getById($nama)
    {
        return $this->sesi->where('nama_sesi', $nama)->first();
    }
    public function store($data)
    {
        return $this->sesi->create([
            'nama_sesi' => $data,
        ]);
    }
    public function update($data, $id)
    {
        return $this->sesi->where('id', $id)->update([
            'nama_sesi' => $data,
        ]);
    }
    public function destroy($id)
    {
        return $this->sesi->where('id', $id)->delete();
    }
}
