<?php

namespace App\Services;

use App\Interfaces\NilaiEkskulInterface;

class NilaiEkskulService
{
    protected $nilai_ekskul;
    public function __construct(NilaiEkskulInterface $nilai_ekskul)
    {
        $this->nilai_ekskul = $nilai_ekskul;
    }
    public function getAll($ekskul_id, $rombel)
    {
        return $this->nilai_ekskul->getAll($ekskul_id, $rombel);
    }
    public function checkNilaiWithSemester($ekskul_id, $tahun_ajaran_id, $rombel)
    {
        return $this->nilai_ekskul->checkNilaiWithSemester($ekskul_id, $tahun_ajaran_id, $rombel);
    }
    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    public function update($datas, $id)
    {
        return $this->nilai_ekskul->update($datas, $id);
    }
    public function destroy($nis)
    {
        return $this->nilai_ekskul-> destroy($nis);
    }
    public function rekap($nis)
    {
        $nilaiEkskuls = $this->nilai_ekskul->getBySiswaNis($nis); // Menggunakan method getBySiswaId untuk mendapatkan nilai ekskul berdasarkan siswa_id
        $rekap = [];

        // Mengumpulkan semua semester yang ada
        $semesters = $nilaiEkskuls->pluck('semester')->unique()->sort()->values()->all();

        // Mengumpulkan semua nama ekskul yang ada
        $namaEkskuls = $nilaiEkskuls->pluck('ekskuls.nama_ekskul')->unique()->values()->all();

        // Membuat header tabel
        $header = array_merge(['Nama Ekskul'], $semesters);

        // Menginisialisasi tabel dengan nama ekskul dan mengisi dengan nilai
        foreach ($namaEkskuls as $namaEkskul) {
            $rekap[$namaEkskul] = array_fill(0, count($semesters), null);
        }

        // Mengisi tabel dengan nilai berdasarkan nama ekskul dan semester
        foreach ($nilaiEkskuls as $nilaiEkskul) {
            $semesterIndex = array_search($nilaiEkskul->semester, $semesters);
            $namaEkskul = $nilaiEkskul->ekskuls->nama_ekskul;
            $rekap[$namaEkskul][$semesterIndex] = $nilaiEkskul->nilai;
        }

        // Mengubah hasil array menjadi format yang mudah dibaca
        $result = [];
        foreach ($rekap as $namaEkskul => $nilaiSemester) {
            $result[] = array_merge([$namaEkskul], $nilaiSemester);
        }

        // Menambahkan header ke hasil akhir
        array_unshift($result, $header);

        return $result;
    }
    private function handleStore($datas)
    {
        foreach ($datas['siswa_id'] as $key => $siswa_id) {
            $this->nilai_ekskul->store($siswa_id, $datas['ekskul_id'], $datas['nilai'][$key], $datas['tahun_ajaran_id'], $datas['semester']);
        }
    }
}
