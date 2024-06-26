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

    public function getAll($id)
    {
        return $this->guru->with('mapels')->where('tahun_ajaran_id', $id)->get();
    }
    public function getById($guru)
    {

        if (is_object($guru)) {
            return $guru->with('mapels', 'rombels')->first();
        }
        $guru = $this->guru->with('mapels', 'rombel')->where('id', $guru)->first();
        return $guru;
    }
    public function store($data)
    {
        return Excel::import(new GuruImport($data['tahun'], $data['semester']), $data['file']);
    }
    public function update($data, $guru)
    {
        return $guru->update([
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'nomor_induk_yayasan' => $data['nomor_induk_yayasan'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function destroy($guru)
    {
        return $guru->delete();
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

    public function aktivasi($id)
    {
        $guru = $this->guru->where('id', $id);

        return $guru->update([
            'username' => $guru->first()->nomor_induk_yayasan,
            'status_akun' => 'aktif',
        ]);
    }
    public function deaktivasi($id)
    {
        return $this->guru->where('id', $id)->update([
            'username' => '-',
            'status_akun' => 'tidak aktif',
        ]);
    }
    public function totalGuru()
    {
        return $this->guru
            ->selectRaw('tahun_ajaran_id, COUNT(*) as total_guru')
            ->groupBy('tahun_ajaran_id')
            ->with('tahun_ajaran')
            ->get()
            ->map(function ($guru) {
                return [
                    'tahun_ajaran' => $guru->tahun_ajaran->tahun_ajaran,
                    'semester' => $guru->tahun_ajaran->semester,
                    'total_guru' => $guru->total_guru,
                ];
            })
            ->sortBy('tahun_ajaran');
    }
}
