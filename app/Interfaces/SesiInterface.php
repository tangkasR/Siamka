<?php

namespace App\Interfaces;

interface SesiInterface
{
    public function getAll();
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
