<?php

namespace App\Repositories;

use App\Interfaces\MataPelajaranInterface;
use App\Models\MataPelajaran;

class MataPelajaranRepository implements MataPelajaranInterface
{
    private $mapel;
    public function __construct(MataPelajaran $mapel)
    {
        $this->mapel = $mapel;
    }
    public function getOne($id)
    {
        return $this->mapel->where('id', $id)->first();
    }
    public function getAll()
    {
        return $this->mapel->get();
    }
    public function getByAttribute($attribute, $data)
    {
        return $this->mapel->where($attribute, $data)->select('id', 'nama_mata_pelajaran')->get();
    }
    public function store($data)
    {
        return $this->mapel->create([
            'nama_mata_pelajaran' => $data,
        ]);
    }
    public function update($data, $mapel)
    {
        return $mapel->update([
            'nama_mata_pelajaran' => $data,
        ]);
    }
    public function destroy($mapel)
    {
        return $mapel->delete();
    }
}
