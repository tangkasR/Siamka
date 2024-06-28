<?php

namespace App\Services;

use App\Interfaces\RombelInterface;
use App\Services\GuruService;
use App\Services\TahunAjaranService;
use Illuminate\Validation\ValidationException;

class RombelService
{
    private $rombel;
    private $guru;
    private $tahun_ajaran;

    public function __construct(RombelInterface $rombel, GuruService $guru, TahunAjaranService $tahun_ajaran)
    {
        $this->rombel = $rombel;
        $this->guru = $guru;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function getAll($id)
    {
        return $this->rombel->getAll($id);
    }
    public function rombelWithoutGuru($id, $tahun_ajaran_id)
    {
        return $this->rombel->rombelWithoutGuru($id, $tahun_ajaran_id);
    }
    public function getOne($rombel)
    {
        return $this->rombel->getOne($rombel);
    }

    public function getBySiswaId($id)
    {
        return $this->rombel->getBySiswaId($id);
    }
    public function getGuruBukanWaliKelas($id)
    {
        return $this->handleGuruBukanWaliKelas($id);
    }
    public function store($datas, $tahun_ajaran_id)
    {
        $guru_ = $this->guru->getById($datas->guru_id);
        $guru = $this->guru->getByNiy($guru_->nomor_induk_yayasan, $tahun_ajaran_id);
        if ($guru == null) {
            throw ValidationException::withMessages(['error' => 'Guru di semester baru tidak ditemukan!']);
        }
        return $this->rombel->store($guru->id, $datas->nama_rombel, $tahun_ajaran_id);
    }
    public function update($data, $rombel)
    {
        return $this->rombel->update($data, $rombel);
    }
    public function destroy($rombel)
    {
        return $this->rombel->destroy($rombel);
    }
    private function handleStore($datas)
    {
        $index = 0;
        foreach ($datas['nama_rombel'] as $nama_rombel) {
            $this->rombel->store($datas['guru_id'][$index], $nama_rombel, $datas['tahun_ajaran_id']);
            $index++;
        }
    }
    private function handleGuruBukanWaliKelas($id)
    {
        $gurus = $this->guru->getAll($id);
        $guru_wali_kelas = [];
        $rombels = $this->rombel->getAll($id);
        foreach ($rombels as $rombel) {
            array_push($guru_wali_kelas, $rombel->guru_id);
        }

        $gurus_bukan_wali_kelas = [];
        foreach ($gurus as $guru) {
            if (!in_array($guru->id, $guru_wali_kelas)) {
                array_push($gurus_bukan_wali_kelas, [
                    'id' => $guru->id,
                    'nama' => $guru->nama,
                ]);
            }
        }
        return $gurus_bukan_wali_kelas;
    }
    public function getRombelGuru($niy, $tahun_ajaran_id)
    {
        return $this->rombel->getRombelGuru($niy, $tahun_ajaran_id);
    }
    public function migrasi($datas)
    {
        if ($datas['semester'] == 'genap') {
            $tahun_ajaran = $datas['tahun'];
            $semester = 'ganjil';
            $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun_ajaran, $semester);
            if ($tahun_ajaran_id == null) {
                throw ValidationException::withMessages(['error' => 'Data semester sebelumnya tidak ada!']);
            }
        } else {
            $tahun_ajaran = $datas['tahun'];
            list($tahun_awal, $tahun_akhir) = explode('-', $tahun_ajaran);
            $tahun_awal = (int) $tahun_awal - 1;
            $tahun_akhir = (int) $tahun_akhir - 1;
            $tahun_ajaran_sebelumnya = $tahun_awal . '-' . $tahun_akhir;
            $semester = 'genap';
            $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun_ajaran_sebelumnya, $semester);
            if ($tahun_ajaran_id == null) {
                throw ValidationException::withMessages(['error' => 'Data semester sebelumnya tidak ada!']);
            }
        }
        $rombels = $this->getAll($tahun_ajaran_id);
        foreach ($rombels as $rombel) {
            $this->store($rombel, $datas['tahun_ajaran_id']);
        }
        return;
    }
    public function getByNama($nama_rombel, $tahun_ajaran_id)
    {
        return $this->rombel->getByNama($nama_rombel, $tahun_ajaran_id);
    }
}
