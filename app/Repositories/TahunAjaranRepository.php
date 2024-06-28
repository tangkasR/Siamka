<?php

namespace App\Repositories;

use App\Interfaces\TahunAjaranInterface;
use App\Models\TahunAjaran;

class TahunAjaranRepository implements TahunAjaranInterface
{
    private $tahun_ajaran;

    public function __construct(TahunAjaran $tahun_ajaran)
    {
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function getId($tahun, $semester)
    {
        return $this->tahun_ajaran->where('tahun_ajaran', $tahun)->where('semester', $semester)->first()->id ?? null;
    }
    public function getById($id)
    {
        return $this->tahun_ajaran->where('id', $id)->first();
    }

}
