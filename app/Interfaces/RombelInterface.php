<?php

namespace App\Interfaces;

interface RombelInterface
{
    public function getAll();
    public function getOne($condition, $params);
    public function getBySiswaId($id);
    public function store($guru_id, $nama_rombel);
    public function update($data, $id);
    public function destroy($id);
}
