<?php

namespace App\Services;

use App\Interfaces\TahunAjaranInterface;

class TahunAjaranService
{
    private $tahun_ajaran;
    public function __construct(TahunAjaranInterface $tahun_ajaran)
    {
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function getId($tahun, $semester)
    {
        return $this->tahun_ajaran->getId($tahun, $semester);
    }
    public function getById($id)
    {
        return $this->tahun_ajaran->getById($id);
    }
}
