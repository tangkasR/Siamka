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
        return $this->ruangan->get();
    }
    public function store($data)
    {
        return $this->ruangan->create([
            'nomor_ruangan' => $data,
        ]);
    }
    public function update($data, $ruangan)
    {
        return $ruangan->update([
            'nomor_ruangan' => $data,
        ]);
    }
    public function destroy($ruangan)
    {
        return $ruangan->delete();
    }
}
