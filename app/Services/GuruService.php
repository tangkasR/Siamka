<?php

namespace App\Services;

use App\Interfaces\GuruInterface;
use App\Services\AuthService;
use App\Services\MataPelajaranService;
use App\Services\TahunAjaranService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GuruService
{
    private $guru;
    private $auth;
    private $mapel;
    private $tahun_ajaran;

    public function __construct(GuruInterface $guru, AuthService $auth, MataPelajaranService $mapel, TahunAjaranService $tahun_ajaran)
    {
        $this->guru = $guru;
        $this->auth = $auth;
        $this->mapel = $mapel;
        $this->tahun_ajaran = $tahun_ajaran;
    }

    public function getAll($id)
    {
        return $this->guru->getAll($id);
    }
    public function store($data)
    {
        return $this->guru->store($data);
    }
    public function update($data, $guru)
    {
        if (isset($data['mapel_id_1'])) {
            $guru->mapels()->detach();
            $mapel_1 = $this->mapel->getOne($data['mapel_id_1']);
            $guru->mapels()->attach($mapel_1->id);
        }
        if (isset($data['mapel_id_2'])) {
            $mapel_2 = $this->mapel->getOne($data['mapel_id_2']);
            $guru->mapels()->attach($mapel_2);
        }
        return $this->guru->update($data, $guru);
    }
    public function destroy($guru)
    {
        return $this->guru->destroy($guru);
    }
    public function getById($guru)
    {
        return $this->guru->getById($guru);
    }
    public function profil($guru)
    {
        $guru = $this->auth->getUser($guru);
        return $this->guru->getById($guru->id);
    }
    public function updateProfil($datas)
    {
        $guru = $this->auth->getUser('guru');

        if (isset($datas['profil'])) {
            $datas['profil'] = $this->handleStoreAs('profil-guru', $datas['profil'], $datas['old_profil']);
        } else {
            $datas['profil'] = $datas['old_profil'];
        }

        if (isset($datas['ktp'])) {
            $datas['ktp'] = $this->handleStoreAs('ktp', $datas['ktp'], $datas['old_ktp']);
        } else {
            $datas['ktp'] = $datas['old_ktp'];
        }

        if (isset($datas['ijazah'])) {
            $datas['ijazah'] = $this->handleStoreAs('ijazah', $datas['ijazah'], $datas['old_ijazah']);
        } else {
            $datas['ijazah'] = $datas['old_ijazah'];
        }

        if (isset($datas['kartu_keluarga'])) {
            $datas['kartu_keluarga'] = $this->handleStoreAs('kk', $datas['kartu_keluarga'], $datas['old_kartu_keluarga']);
        } else {
            $datas['kartu_keluarga'] = $datas['old_kartu_keluarga'];
        }

        return $this->guru->updateProfil($datas, $guru->id);
    }

    private function handleStoreAs($new_path, $new_file, $old_file)
    {
        $oldPath = storage_path('app/public/' . $old_file);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
        $ext = $new_file->getClientOriginalExtension();
        $new_file_name = $new_path . '-' . rand(0, 9999999) . '.' . $ext;
        if ($new_path == 'ktp' || $new_path == 'ijazah' || $new_path == 'kk') {
            $imageContent = file_get_contents($new_file->getRealPath());
            $encryptedImage = Crypt::encrypt($imageContent);

            // Menyimpan gambar terenkripsi
            $encryptedFileName = 'encrypted_' . $new_path . '_' . rand(0, 9999999) . '_' . $new_file->getClientOriginalName();
            Storage::put('public/' . $encryptedFileName, $encryptedImage);
            return $encryptedFileName;
        }

        $new_file->storeAs('public/' . $new_file_name);
        return $new_file_name;
    }
    public function aktivasi($id)
    {
        return $this->guru->aktivasi($id);
    }
    public function deaktivasi($id)
    {
        return $this->guru->deaktivasi($id);
    }
    public function aktivasi_all($id)
    {
        return $this->handleAktivasiAll($id);
    }
    private function handleAktivasiAll($id)
    {
        $gurus = $this->getAll($id);
        foreach ($gurus as $guru) {
            $this->aktivasi($guru->id);
        }
    }
    public function deaktivasi_all($id)
    {
        return $this->handleDeaktivasiAll($id);
    }
    private function handleDeaktivasiAll($id)
    {
        $gurus = $this->getAll($id);
        foreach ($gurus as $guru) {
            $this->deaktivasi($guru->id);
        }
    }
    public function totalGuru()
    {
        return $this->guru->totalGuru();
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
        $gurus = $this->getAll($tahun_ajaran_id);
        foreach ($gurus as $guru) {
            $this->guru->deaktivasi($guru->id);
            $this->guru->create($guru, $datas['tahun_ajaran_id']);
        }
        return;
    }

    public function getByNiy($niy, $tahun_ajaran_id)
    {
        return $this->guru->getByNiy($niy, $tahun_ajaran_id);
    }
}
