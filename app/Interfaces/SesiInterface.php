<?php

namespace App\Interfaces;

interface SesiInterface
{
    public function getAll();
    public function getById($nama);
    public function store($data);
    public function update($data, $sesi);
    public function destroy($sesi);
}
