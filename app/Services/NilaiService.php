<?php

namespace App\Services;

use App\Interfaces\NilaiInterface;
use Illuminate\Validation\ValidationException;

class NilaiService
{
    private $nilai;
    private $siswa;
    private $rombel;

    public function __construct(NilaiInterface $nilai, SiswaService $siswa, RombelService $rombel)
    {
        $this->nilai = $nilai;
        $this->siswa = $siswa;
        $this->rombel = $rombel;
    }
    public function getNilaiById($id)
    {
        return $this->nilai->getNilaiById($id);
    }
    public function getNilai($rombel_id, $mapel_id, $tahun_ajaran_id)
    {
        return $this->nilai->getNilai($rombel_id, $mapel_id, $tahun_ajaran_id);
    }

    public function getNilaiByParams($rombel_id, $mapel_id, $tipe_ujian, $semester, $tahun_ajaran_id)
    {
        return $this->nilai->getNilaiByParams($rombel_id, $mapel_id, $tipe_ujian, $semester, $tahun_ajaran_id);
    }

    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    private function handleStore($datas)
    {

        $data_siswas = [];
        foreach ($datas['siswa_id'] as $index => $siswa_id) {
            array_push($data_siswas, [
                'siswa_id' => $siswa_id,
                'nilai' => $datas['nilai'][$index],
            ]);
        }
        foreach ($data_siswas as $siswa) {
            $this->nilai->store(
                $siswa['siswa_id'],
                $datas['mata_pelajaran_id'],
                $datas['tipe_ujian'],
                $siswa['nilai'],
                $datas['semester'],
                $datas['tahun_ajaran_id'],
            );
        }
    }

    public function update($data, $nilai)
    {
        return $this->nilai->update($data, $nilai);
    }

    public function destroy($datas)
    {
        return $this->handleDestroy($datas);
    }
    private function handleDestroy($datas)
    {
        $nilais = $this->nilai->getNilaiByParams($datas['rombel_id'], $datas['mapel_id'], $datas['tipe_ujian'], $datas['semester'])->get();
        if (count($nilais) == 0) {
            throw ValidationException::withMessages(['error' => 'Data nilai dengan ketentuan tersebut tidak ada!']);
        }
        foreach ($nilais as $nilai) {
            $this->nilai->destroy($nilai->id);
        }
        return;
    }

    public function getDataUts_chart($nis)
    {
        $arrNilaiUts = [];
        array_push($arrNilaiUts, 0);
        $total_semester_uts = $this->nilai->getTotalSemesterUts($nis);
        $total_nilai_uts = 0;
        for ($i = 1; $i <= $total_semester_uts; $i++) {
            $nilaiUts = $this->nilai->getNilaiUts($nis, $i);

            if (count($nilaiUts) > 0) {
                foreach ($nilaiUts as $nilai) {
                    $total_nilai_uts = $total_nilai_uts + $nilai->nilai;
                }
                $rata_rata_uts = number_format(($total_nilai_uts / count($nilaiUts)), 2, '.', '');
                array_push($arrNilaiUts, $rata_rata_uts);
                $total_nilai_uts = 0;
            }
        }

        return $arrNilaiUts;
    }
    public function getDataUas_chart($nis)
    {
        $arrNilaiUas = [];
        array_push($arrNilaiUas, 0);
        $total_semester_uas = $this->nilai->getTotalSemesterUas($nis);
        $total_nilai_uas = 0;
        for ($i = 1; $i <= $total_semester_uas; $i++) {
            $nilaiUas = $this->nilai->getNilaiUas($nis, $i);
            if (count($nilaiUas) > 0) {
                foreach ($nilaiUas as $nilai) {
                    $total_nilai_uas = $total_nilai_uas + $nilai->nilai;
                }
                $rata_rata_uas = number_format(($total_nilai_uas / count($nilaiUas)), 2, '.', '');
                array_push($arrNilaiUas, $rata_rata_uas);
                $total_nilai_uas = 0;
            }
        }

        return $arrNilaiUas;
    }

    public function getNilaiUts($id)
    {
        return $this->nilai->getNilaiUts($id);
    }
    public function getNilaiUas($id)
    {
        return $this->nilai->getNilaiUas($id);
    }

    public function getNilaiBySiswa($semester, $tipe_ujian, $nis)
    {
        return $this->nilai->getNilaiBySiswa($semester, $tipe_ujian, $nis);
    }
    public function getByNisSiswa($nis)
    {
        return $this->nilai->getByNisSiswa($nis);
    }

}
