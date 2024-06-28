<?php

namespace App\Interfaces;

interface GuruInterface
{
    public function getAll($id);
    public function getById($guru);
    public function store($data);
    public function update($data, $guru);
    public function destroy($guru);
    public function updateProfil($data, $id);
    public function aktivasi($id);
    public function deaktivasi($id);
    public function totalGuru();
    public function create($guru, $tahun_ajaran_id);
    public function getByNiy($niy, $tahun_ajaran_id);
}
