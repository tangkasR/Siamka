<?php

namespace App\Services;

use App\Interfaces\JadwalPelajaranInterface;
use App\Services\GuruService;
use App\Services\RombelService;
use App\Services\SesiService;
use App\Services\TahunAjaranService;
use Illuminate\Validation\ValidationException;

class JadwalPelajaranService
{
    private $jadwal;
    private $sesi;
    private $rombel;
    private $tahun_ajaran;
    private $guru;

    public function __construct(
        JadwalPelajaranInterface $jadwal,
        SesiService $sesi,
        RombelService $rombel,
        TahunAjaranService $tahun_ajaran,
        GuruService $guru
    ) {
        $this->jadwal = $jadwal;
        $this->sesi = $sesi;
        $this->rombel = $rombel;
        $this->tahun_ajaran = $tahun_ajaran;
        $this->guru = $guru;
    }
    public function getByRombelId($id)
    {
        return $this->jadwal->getByRombelId($id);
    }
    public function store($data)
    {
        return $this->jadwal->store($data);
    }
    public function update($data, $id)
    {
        return $this->jadwal->update($data, $id);
    }
    public function destroyAllByRombelId($id)
    {
        return $this->jadwal->destroyAllByRombelId($id);
    }
    public function createTemplate($rombel)
    {
        $sesi = $this->sesi->getAll();
        $hari = [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
        ];
        $templates = [];
        $temp_hari = '';
        foreach ($hari as $data) {
            if ($temp_hari != $data) {
                foreach ($sesi as $item_sesi) {
                    array_push($templates, [
                        'hari' => $data,
                        'sesi' => $item_sesi->nama_sesi,
                        'rombel' => $rombel->id,
                    ]);
                }
            }
            $temp_hari = $data;
        }
        return $templates;
    }
    public function getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id)
    {
        return $this->jadwal->getByGuruIdSesiSatu($guru_id, $tahun_ajaran_id);
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
        $rombel = $this->rombel->getByNama($datas['nama_rombel'], $tahun_ajaran_id);
        $jadwals = $this->getByRombelId($rombel->id);
        if (count($jadwals) == 0) {
            throw ValidationException::withMessages(['error' => 'Data semester sebelumnya tidak ada!']);
        }
        $rombel = $this->rombel->getOne($datas['rombel_id']);
        foreach ($jadwals as $jadwal) {
            $guru = $this->guru->getById($jadwal->guru_id);
            $guru = $this->guru->getByNiy($guru->nomor_induk_yayasan, $datas['tahun_ajaran_id']);
            $checkGuru = $guru->rombels()->where('rombel_id', $rombel->id)->get();
            if (count($checkGuru) == 0) {
                $guru->rombels()->attach($rombel);
            }
            $this->jadwal->create($jadwal, $datas['rombel_id'], $guru->id, $datas['tahun_ajaran_id']);
        }
        return;
    }
}
