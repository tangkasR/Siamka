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
    public function getAll($id, $tahun_ajaran_id)
    {
        return $this->ekskul->getAll($id, $tahun_ajaran_id);
    }
    public function getAllDatas($tahun_ajaran_id)
    {
        return $this->ekskul->getAllDatas($tahun_ajaran_id);
    }
    public function getById($ekskul)
    {
        return $this->ekskul->getById($ekskul);
    }
    public function getMemberList($id)
    {
        return $this->ekskul->getMemberList($id);
    }
    public function getMemberListNotActive($id)
    {
        return $this->ekskul->getMemberListNotActive($id);
    }
    public function getSiswaNonMember($rombel, $ekskul)
    {
        return $this->ekskul->getSiswaNonMember($rombel, $ekskul);
    }
    public function store($datas)
    {
        return $this->ekskul->store($datas['nama_ekskul'], $datas['guru_id'], $datas['tahun_ajaran_id']);
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
        $siswas = $this->ekskul->getMemberList($id)->get();
        return $this->handleDestroy($siswas, $id);
    }
    private function handleDestroy($siswas, $id)
    {
        $ekskul = $this->ekskul->getById($id);
        foreach ($siswas as $siswa) {
            $siswa = $this->siswa->getById($siswa->id);
            $ekskul->siswas()->detach($siswa);
            $ekskul->siswas()->attach($siswa, [
                'status' => 'tidak aktif',
            ]);
        }
    }
    public function activate($id)
    {
        return $this->ekskul->activate($id);
    }
    public function change_status($datas)
    {
        $siswa = $this->siswa->getById($datas['siswa_id']);
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);
        $ekskul->siswas()->detach($siswa);
        $ekskul->siswas()->attach($siswa, [
            'status' => $datas['status'],
        ]);
    }
    public function delete_member($id_siswa, $datas)
    {
        return $this->handleDeleteMember($id_siswa, $datas);
    }
    private function handleAddMember($datas)
    {
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);

        foreach ($datas['siswa_id'] as $id) {
            $siswa = $this->siswa->getById($id);
            $siswa->ekskuls()->attach($ekskul);
        }
    }
    private function handleDeleteMember($id_siswa, $datas)
    {
        $siswa = $this->siswa->getById($id_siswa);
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);
        $ekskul->siswas()->detach($siswa);
    }

    public function getEkskulSiswa($nis)
    {
        return $this->ekskul->getEkskulSiswa($nis);
    }
}
