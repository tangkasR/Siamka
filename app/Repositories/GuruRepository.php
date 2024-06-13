<?php

namespace App\Repositories;

use App\Imports\GuruImport;
use App\Interfaces\GuruInterface;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuruRepository implements GuruInterface
{
    private $guru;
    public function __construct(Guru $guru)
    {
        $this->guru = $guru;
    }

    public function getAll()
    {
        return $this->guru->with('mapels')->get();
    }
    public function getById($id)
    {
        return $this->guru->with('mapels', 'rombels')->where('id', $id)
            ->first();
    }
    public function store($data)
    {
        return Excel::import(new GuruImport, $data['file']);
    }
    public function update($data, $id)
    {
        return $this->guru->where('id', $id)->update([
            'mata_pelajaran_id' => $data['mata_pelajaran_id'],
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'nomor_induk_yayasan' => $data['nomor_induk_yayasan'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function destroy($id)
    {
        return $this->guru->where('id', $id)->delete();
    }
    public function updateProfil($data, $id)
    {
        return $this->guru->where('id', $id)->update([
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tempat_tanggal_lahir' => $data['tempat_tanggal_lahir'],
            'alamat' => $data['alamat'],
            'pendidikan_terakhir' => $data['pendidikan_terakhir'],
            'no_hp' => $data['no_hp'],
            'ktp' => $data['ktp'],
            'ijazah' => $data['ijazah'],
            'kartu_keluarga' => $data['kartu_keluarga'],
            'profil' => $data['profil'],
        ]);
    }
}
