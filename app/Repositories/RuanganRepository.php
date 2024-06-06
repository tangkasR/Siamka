<?php

namespace App\Repositories;

use App\Interfaces\RuanganInterface;
use App\Models\Ruangan;

class RuanganRepository implements RuanganInterface
{
    private $ruangan;
    public function __construct(Ruangan $ruangan)
    {
        $this->ruangan = $ruangan;
    }

    public function getAll()
    {
        return $this->ruangan->select('id', 'nomor_ruangan')->get();
    }
    public function store($data)
    {
        return $this->ruangan->create([
            'nomor_ruangan' => $data,
        ]);
    }
    public function update($data, $id)
    {
        return $this->ruangan->where('id', $id)->update([
            'nomor_ruangan' => $data,
        ]);
    }
    public function destroy($id)
    {
        return $this->ruangan->where('id', $id)->delete();
    }
}
