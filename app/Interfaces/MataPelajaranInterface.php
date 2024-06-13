<?php

namespace App\Interfaces;

interface MataPelajaranInterface
{
    public function getOne($id);
    public function getAll();
    public function getByAttribute($attribute, $data);
    public function store($data);
    public function update($data, $mapel);
    public function destroy($mapel);
}
