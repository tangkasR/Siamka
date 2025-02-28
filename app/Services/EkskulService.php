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
    private function handleAddMember($datas)
    {
        $ekskul = $this->ekskul->getById($datas['ekskul_id']);

        foreach ($datas['siswa_id'] as $id) {
            $siswa = $this->siswa->getById($id);
            $siswa->ekskuls()->attach($ekskul);
        }
    }
    public function update($data, $id)
    {
        return $this->ekskul->update($data['nama_ekskul'], $id);
    }

    public function delete_member($id_siswa, $datas)
    {
        return $this->handleDeleteMember($id_siswa, $datas);
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
    public function getRombel($id)
    {
        return $this->ekskul->getRombel($id);
    }
    public function getMemberListNilai($id, $rombel)
    {
        return $this->ekskul->getMemberListNilai($id, $rombel);
    }
}
