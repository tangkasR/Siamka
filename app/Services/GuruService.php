<?php

namespace App\Services;

use App\Interfaces\GuruInterface;
use App\Services\AuthService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GuruService
{
    private $guru;
    private $auth;

    public function __construct(GuruInterface $guru, AuthService $auth)
    {
        $this->guru = $guru;
        $this->auth = $auth;
    }

    public function getAll()
    {
        return $this->guru->getAll();
    }
    public function store($data)
    {
        return $this->guru->store($data);
    }
    public function update($data, $guru)
    {
        return $this->guru->update($data, $guru);
    }
    public function destroy($guru)
    {
        return $this->guru->destroy($guru);
    }
    public function getById($id)
    {
        return $this->guru->getById($id);
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
}
