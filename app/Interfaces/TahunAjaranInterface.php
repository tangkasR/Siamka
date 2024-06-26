<?php

namespace App\Interfaces;

interface TahunAjaranInterface
{
    public function getId($tahun, $semester);
    public function getById($id);
}
