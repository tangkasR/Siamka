<?php

namespace App\Interfaces;

interface JadwalPelajaranInterface
{
    public function getByRombelId($id);
    public function store($data);
    public function update($data, $id);
    public function destroyAllByRombelId($id);
    public function getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id);
}
