<?php

namespace App\Services;

use App\Interfaces\SiswaInterface;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\RombelService;
use App\Services\TahunAjaranService;
use Illuminate\Validation\ValidationException;

class SiswaService
{
    private $siswa;
    private $rombel;
    private $auth;
    private $date;
    private $tahun_ajaran;

    public function __construct(
        SiswaInterface $siswa,
        RombelService $rombel,
        AuthService $auth,
        DateService $date,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->siswa = $siswa;
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->date = $date;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function getById($siswa)
    {
        return $this->siswa->getById($siswa);
    }
    public function getNotActive($angkatan, $nama_rombel)
    {
        return $this->siswa->getNotActive($angkatan, $nama_rombel);
    }
    public function getSiswa($id)
    {
        return $this->siswa->getSiswa($id);
    }
    public function getSiswaAdmin($id)
    {
        return $this->siswa->getSiswaAdmin($id);
    }

    public function store($data)
    {
        return $this->siswa->store($data);
    }
    public function update($data, $id)
    {
        $this->siswa->update($data, $id);
    }
    public function moveClass($data, $id)
    {
        $siswa = $this->siswa->getById($id);
        $new_rombel = $this->rombel->getOne($data['rombel_id']);
        $old_rombel = $siswa->rombels->last();

        $siswa->rombels()->detach($old_rombel);
        $siswa->rombels()->attach($new_rombel);
    }
    public function destroy($id)
    {
        $siswa = $this->siswa->getById($id);
        $siswa->rombels()->detach();
        return $this->siswa->destroy($id);
    }
    public function nextGrade($datas)
    {
        return $this->handleNextGrade($datas);
    }
    private function handleNextGrade($datas)
    {

        $rombel_next = $this->rombel->getOne($datas['id_next']);
        $rombel_now = $this->rombel->getOne($datas['class_id_now']);

        if (isset($datas['siswa_id'])) {
            foreach ($datas['siswa_id'] as $index => $id) {
                $this->siswa->deaktivasi($id);
                $siswa = $this->siswa->getById($id);
                if ($datas['status'][$index] == 'naik') {
                    $this->siswa->create($siswa, $datas['tahun_ajaran_id'], $rombel_next);
                } else {
                    $this->siswa->create($siswa, $datas['tahun_ajaran_id'], $rombel_now);
                }
            }
        } else {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah naik kelas']);
        }
    }
    public function lulus($datas)
    {
        return $this->handleLulus($datas);
    }
    public function aktivasi($datas)
    {
        return $this->siswa->aktivasi($datas['siswa_id']);
    }
    public function aktivasiAll($rombel)
    {
        $siswas = $this->siswa->getSiswa($rombel->id);
        return $this->handleAktivasiAll($siswas);
    }

    public function deaktivasi($id)
    {
        return $this->siswa->deaktivasi($id);
    }
    public function update_profil($datas)
    {
        $siswa = $this->auth->getUser('siswa');

        if (isset($datas['profil'])) {
            $datas['profil'] = $this->handleStoreAs('profil-siswa', $datas['profil'], $datas['old_profil']);
        } else {
            $datas['profil'] = $datas['old_profil'];
        }

        return $this->siswa->update_profil($datas, $siswa->id);
    }
    public function deaktivasiAll($rombel)
    {
        $siswas = $this->siswa->getSiswa($rombel->id);
        return $this->handleDeaktivasiAll($siswas);
    }
    private function handleDeaktivasiAll($datas)
    {
        foreach ($datas as $data) {
            $this->siswa->deaktivasi($data->id);
        }
    }
    private function handleAktivasiAll($datas)
    {
        foreach ($datas as $data) {
            $this->siswa->aktivasi($data->id);
        }
    }

    private function handleStoreAs($new_path, $new_file, $old_file)
    {
        $oldPath = storage_path('app/public/' . $old_file);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        $ext = $new_file->getClientOriginalExtension();
        $new_file_name = $new_path . '-' . rand(0, 9999999) . '.' . $ext;
        $new_file->storeAs('public/' . $new_file_name);
        return $new_file_name;
    }
    private function handleLulus($datas)
    {
        if (!isset($datas['siswa_id'])) {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah di Luluskan']);
        }

        foreach ($datas['siswa_id'] as $index => $siswa_id) {
            $siswa = $this->getById($siswa_id);
            if ($datas['status'][$index] == 'lulus') {
                if ($siswa->status_siswa == 'belum lulus') {
                    $this->siswa->lulus($siswa->id);
                }
            }
        }
    }


    public function getAngkatan()
    {
        return $this->siswa->getAngkatan();
    }
    public function keluar($id)
    {
        $this->siswa->deaktivasi($id);
        return $this->siswa->keluar($id);
    }
    public function getSiswaPerAngkatan()
    {
        return $this->siswa->getSiswaPerAngkatan();
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
        $rombel_next = $this->rombel->getOne($datas['rombel_id']);
        $siswas = $rombel->siswas()->where('status_siswa', 'belum lulus')->get();
        foreach ($siswas as $siswa) {
            $this->siswa->deaktivasi($siswa->id);
            $this->siswa->create($siswa, $datas['tahun_ajaran_id'], $rombel_next);
        }
    }
    public function getNotActiveRombel($angkatan)
    {
        return $this->siswa->getNotActiveRombel($angkatan);
    }
}
