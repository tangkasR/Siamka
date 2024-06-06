<?php

namespace App\Services;

use App\Interfaces\EkskulInterface;
use App\Services\SiswaService;

class EkskulService
{
    protected $ekskul;
    protected $siswa;
    public function __construct(EkskulInterface $ekskul, SiswaService $siswa)
    {
        $this->ekskul = $ekskul;
        $this->siswa = $siswa;
    }
    public function getAll($id)
    {
        return $this->ekskul->getAll($id);
    }
    public function getById($id)
    {
        return $this->ekskul->getById($id);
    }
    public function getMemberList($id)
    {
        return $this->ekskul->getMemberList($id);
    }
    public function getSiswaNonMember($rombel_id, $ekskul_id)
    {
        return $this->ekskul->getSiswaNonMember($rombel_id, $ekskul_id);
    }
    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    public function addMember($datas)
    {
        return $this->handleAddMember($datas);
    }
    public function update($data, $id)
    {
        return $this->ekskul->update($data['nama_ekskul'], $id);
    }
    public function destroy($id)
    {
        $siswas = $this->ekskul->getMemberList($id);
        foreach ($siswas as $siswa) {
            $siswa = $this->siswa->getById($siswa->id);
            $ekskul = $this->ekskul->getById($id);
            $ekskul->siswas()->detach($siswa);
            $ekskul->siswas()->attach($siswa, [
                'status' => 'tidak aktif',
            ]);
        }
        return $this->ekskul->destroy($id);
    }
    public function activate($id)
    {
        return $this->ekskul->activate($id);
    }
    public function change_status($datas)
    {
        $siswa = $this->siswa->getById($datas['siswa_id']);
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);
        // dd($datas['status']);
        $ekskul->siswas()->detach($siswa);
        $ekskul->siswas()->attach($siswa, [
            'status' => $datas['status'],
        ]);
    }
    public function delete_member($id_siswa, $datas)
    {
        return $this->handleDeleteMember($id_siswa, $datas);
    }
    private function handleStore($datas)
    {
        $guru_id = $datas['guru_id'];
        foreach ($datas['nama_ekskul'] as $data) {
            $this->ekskul->store($data, $guru_id);
        }
    }
    private function handleAddMember($datas)
    {
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);

        foreach ($datas['siswa_id'] as $id) {
            $siswa = $this->siswa->getById($id);
            $siswa->ekskuls()->attach($ekskul, [
                'status' => 'aktif',
            ]);
        }
    }
    private function handleDeleteMember($id_siswa, $datas)
    {
        $siswa = $this->siswa->getById($id_siswa);
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);
        $ekskul->siswas()->detach($siswa);
    }
}
