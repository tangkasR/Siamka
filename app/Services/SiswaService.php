<?php

namespace App\Services;

use App\Interfaces\SiswaInterface;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\RombelService;
use Illuminate\Validation\ValidationException;

class SiswaService
{
    private $siswa;
    private $rombel;
    private $auth;
    private $date;

    public function __construct(
        SiswaInterface $siswa,
        RombelService $rombel,
        AuthService $auth,
        DateService $date,
    ) {
        $this->siswa = $siswa;
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->date = $date;
    }
    public function getById($siswa)
    {
        return $this->siswa->getById($siswa);
    }
    public function getPivotTahunPembelajaran($id)
    {
        return $this->siswa->getPivotTahunPembelajaran($id);
    }
    public function getNotActive($angkatan)
    {
        return $this->siswa->getNotActive($angkatan);
    }
    public function getSiswa($id)
    {
        return $this->siswa->getSiswa($id);
    }
    public function getSiswaAdmin($id)
    {
        return $this->siswa->getSiswaAdmin($id);
    }
    public function getByRombelIdActive($id)
    {
        return $this->siswa->getByRombelIdActive($id);
    }
    public function getByRombelIdNotActiveAccount($id)
    {
        return $this->siswa->getByRombelIdNotActiveAccount($id);
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
        // dd($data);
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
    public function deaktivasiAll($rombel)
    {
        $siswas = $this->siswa->getSiswa($rombel->id);
        return $this->handleDeaktivasiAll($siswas);
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

    public function getByRombelIdNextGrade($id)
    {
        return $this->siswa->getByRombelIdNextGrade($id);
    }
    private function handleAktivasiAll($datas)
    {
        foreach ($datas as $data) {
            $this->siswa->aktivasi($data->id);
        }
    }
    private function handleDeaktivasiAll($datas)
    {
        foreach ($datas as $data) {
            $this->siswa->deaktivasi($data->id);
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
    private function handleNextGrade($datas)
    {

        $rombel_next = $this->rombel->getOne($datas['id_next']);
        $tahun_pembelajaran = $datas['tahun_pembelajaran'];
        $tahun_awal = explode("/", $tahun_pembelajaran)[0];
        $tahun_akhir = explode("/", $tahun_pembelajaran)[1];

        if (isset($datas['siswa_id'])) {
            foreach ($datas['siswa_id'] as $index => $id) {
                $siswa_ = $this->siswa->getById($id);
                $last_rombel = $siswa_->rombels->last();
                $last_pivot_tahun_awal = $last_rombel->pivot->tahun_awal;
                $rombel_now = $this->rombel->getOne($last_rombel->id);

                if ($last_pivot_tahun_awal != $tahun_awal) {
                    if ($datas['status'][$index] == 'naik') {

                        $siswa_->rombels()->attach($rombel_next, [
                            'tahun_awal' => $tahun_awal,
                            'tahun_akhir' => $tahun_akhir,
                        ]);
                    } else {

                        $siswa_->rombels()->detach($rombel_now);
                        $siswa_->rombels()->attach($rombel_now, [
                            'tahun_awal' => $tahun_awal,
                            'tahun_akhir' => $tahun_akhir,
                        ]);
                    }
                }

            }
        } else {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah naik kelas']);
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
}
