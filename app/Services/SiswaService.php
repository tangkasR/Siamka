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
    public function getById($id)
    {
        return $this->siswa->getById($id);
    }
    public function getPivotTahunPembelajaran($id)
    {
        return $this->siswa->getPivotTahunPembelajaran($id);
    }
    public function getNotActive()
    {
        return $this->siswa->getNotActive();
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
        $rombel = $this->rombel->getBySiswaId($id)->last();
        $new_rombel = $this->rombel->getOne('id', $data['rombel_id']);
        $old_rombel = $this->rombel->getOne('id', $rombel->id);

        $tahun_pembelajaran = $data['tahun_pembelajaran'];
        $tahun_awal = explode("/", $tahun_pembelajaran)[0];
        $tahun_akhir = explode("/", $tahun_pembelajaran)[1];

        $siswa->rombels()->detach($old_rombel);
        $siswa->rombels()->attach($new_rombel, [
            'tahun_awal' => $tahun_awal,
            'tahun_akhir' => $tahun_akhir,
        ]);
    }
    public function destroy($id)
    {
        $siswa = $this->siswa->getById($id);
        $siswa->rombels()->detach();
        return $this->siswa->destroy($id);
    }
    public function nextGrade($datas, $rombel_id)
    {
        return $this->handleNextGrade($datas, $rombel_id);
    }
    public function lulus($rombel_id)
    {
        return $this->handleLulus($rombel_id);
    }
    public function aktivasi($datas)
    {
        return $this->handleAktivasi($datas);
    }
    public function deaktivasiAll($id)
    {
        $siswas = $this->siswa->getByRombelIdActive($id);
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

    private function handleDeaktivasiAll($datas)
    {
        foreach ($datas as $data) {
            $this->siswa->deaktivasi($data->id);
        }
    }
    private function handleAktivasi($datas)
    {
        foreach ($datas['siswa_id'] as $id) {
            $this->siswa->aktivasi($id);
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
    private function handleLulus($rombel_id)
    {
        $siswas = $this->siswa->getByRombelIdNextGrade($rombel_id);
        $check = 0;
        foreach ($siswas as $siswa) {
            $siswa_ = $this->siswa->getById($siswa->id);
            if ($siswa_->status_siswa == 'belum lulus') {
                $check++;
                $this->siswa->lulus($siswa->id);
            }
        }
        if ($check == 0) {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah di Luluskan']);
        }
    }
    private function handleNextGrade($datas, $rombel_id)
    {
        $siswas = $this->siswa->getByRombelIdNextGrade($rombel_id);
        $rombel = $this->rombel->getOne('id', $datas['target_rombel_id']);
        $tahun_pembelajaran = $datas['tahun_pembelajaran'];
        $tahun_awal = explode("/", $tahun_pembelajaran)[0];
        $tahun_akhir = explode("/", $tahun_pembelajaran)[1];

        $check = 0;
        foreach ($siswas as $siswa) {

            $siswa_ = $this->siswa->getById($siswa->id);
            $rombel_id_check = $siswa_->rombels->last()->id;
            if ($rombel_id_check != $datas['target_rombel_id']) {
                $check++;
                $siswa_->rombels()->attach($rombel, [
                    'tahun_awal' => $tahun_awal,
                    'tahun_akhir' => $tahun_akhir,
                ]);
            }
        }
        if ($check == 0) {
            throw ValidationException::withMessages(['error' => 'Data siswa sudah naik kelas']);
        }
    }

    public function getNotActiveClear($year)
    {
        return $this->siswa->getNotActiveClear($year);
    }
}
