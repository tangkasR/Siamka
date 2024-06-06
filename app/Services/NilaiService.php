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
    public function getNilaiUasGroupByMapel($id)
    {
        return $this->nilai->getNilaiUasGroupByMapel($id);
    }

    public function getNilaiUts($id)
    {
        return $this->nilai->getNilaiUts($id);
    }
    public function getNilaiUas($id)
    {
        return $this->nilai->getNilaiUas($id);
    }
    public function getNilaiByThreeParams($conditional_1, $params_1, $conditional_2, $params_2, $conditional_3, $params_3)
    {
        return $this->nilai->getByThreeParams($conditional_1, $params_1, $conditional_2, $params_2, $conditional_3, $params_3);
    }
    public function getNilaiByParams($conditional_1, $params_1)
    {
        return $this->nilai->getByOneParams($conditional_1, $params_1);
    }
    public function get_nilai_with_rombel_id_and_mapel_id($rombel_id, $mapel_id)
    {
        return $this->nilai->getByRombelIdAndMapelId($rombel_id, $mapel_id);

    }
    public function get_nilai_with_rombel_id_and_mapel_id_and_tipe_ujian($rombel_id, $mapel_id, $tipe_ujian, $semester)
    {
        return $this->nilai->getByRombelIdAndMapelIdAndTipeUjian($rombel_id, $mapel_id, $tipe_ujian, $semester);
    }
    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    public function update($data, $id)
    {
        return $this->nilai->update($data, $id);
    }
    public function destroy($datas)
    {
        return $this->handleDestroy($datas);
    }
    private function handleStore($datas)
    {

        $data_siswas = [];
        $index = 0;
        foreach ($datas['siswa_id'] as $siswa_id) {
            array_push($data_siswas, [
                'siswa_id' => $siswa_id,
                'nilai' => $datas['nilai'][$index],
            ]);
            $index++;
        }
        foreach ($data_siswas as $siswa) {
            $this->nilai->store(
                $siswa['siswa_id'],
                $datas['mata_pelajaran_id'],
                $datas['tipe_ujian'],
                $siswa['nilai'],
                $datas['semester'],
            );
        }
    }
    public function getDataUts_chart($siswa_id)
    {
        $arrNilaiUts = [];
        array_push($arrNilaiUts, 0);
        $total_semester_uts = $this->nilai->getTotalSemesterUts($siswa_id);
        $total_nilai_uts = 0;
        for ($i = 1; $i <= $total_semester_uts; $i++) {
            $nilaiUts = $this->nilai->getNilaiUts($siswa_id, $i);
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
    public function getDataUas_chart($siswa_id)
    {
        $arrNilaiUas = [];
        array_push($arrNilaiUas, 0);
        $total_semester_uas = $this->nilai->getTotalSemesterUas($siswa_id);
        $total_nilai_uas = 0;
        for ($i = 1; $i <= $total_semester_uas; $i++) {
            $nilaiUas = $this->nilai->getNilaiUas($siswa_id, $i);
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
    private function handleDestroy($datas)
    {
        $nilais = $this->nilai->getByRombelIdAndMapelIdAndTipeUjian($datas['rombel_id'], $datas['mapel_id'], $datas['tipe_ujian'], $datas['semester'])->get();
        if (count($nilais) == 0) {
            throw ValidationException::withMessages(['error' => 'Data nilai dengan ketentuan tersebut tidak ada!']);
        }
        foreach ($nilais as $nilai) {
            $this->nilai->destroy($nilai->id);
        }
        return;
    }
}
