<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\DateService;
use App\Services\KehadiranGuruService;
use App\Services\KehadiranService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KehadiranGuruController extends Controller
{
    private $auth;
    private $kehadiran;
    private $kehadiran_guru;
    private $date;

    public function __construct(
        AuthService $auth,
        KehadiranService $kehadiran,
        KehadiranGuruService $kehadiran_guru,
        DateService $date
    ) {
        $this->auth = $auth;
        $this->kehadiran = $kehadiran;
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
    }
    public function index(Request $request)
    {
        $latlong = $this->kehadiran_guru->setLatLongSekolah();
        $guru = $this->auth->getUser('guru');
        $tahun = $this->date->getDate()->year;

        $checkAbsen = false;
        if (count($this->kehadiran_guru->checkAbsensi($guru->id)) > 0) {
            $checkAbsen = true;
            if ($this->kehadiran_guru->checkAbsensi($guru->id)[0]->total_jam != 0) {
                $checkAbsen = false;
            }
        }
        $bulan_now = $this->date->getDate()->format('Y-m');
        if ($request->ajax()) {
            $tahun = $request->tahun;
            return view('pages.guru.data_kehadiran', [
                'guru' => $guru,
                'tanggal' => $this->date->getDate()->format('d-m-Y'),
                'bulan' => $this->date->getDate()->month,
                'tahun' => $this->date->getDate()->year,
                'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->nomor_induk_yayasan, $tahun),
                'years' => $this->kehadiran_guru->getYear(),
                'latlong' => $latlong,
                'checkAbsen' => $checkAbsen,
                'bulan_now' => $bulan_now,
            ]);
        }
        return view('pages.guru.kehadiran', [
            'guru' => $guru,
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'bulan' => $this->date->getDate()->month,
            'tahun' => $this->date->getDate()->year,
            'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->nomor_induk_yayasan, $tahun),
            'years' => $this->kehadiran_guru->getYear(),
            'latlong' => $latlong,
            'checkAbsen' => $checkAbsen,
            'bulan_now' => $bulan_now,
        ]);
    }
    public function getData(Request $request)
    {
        $kehadirans = $this->kehadiran_guru->getData($request->niy, $request->bulan, $request->tahun);
        return response($kehadirans);

    }
    public function store(Request $request)
    {
        try {
            $guru = $this->auth->getUser('guru');
            if (count($this->kehadiran_guru->checkAbsensi($guru->id)) > 0) {
                return back()->with('error', 'Anda sudah melakukan absensi');
            }
            $this->kehadiran_guru->store($request->all());
            return back()->with('message', 'Anda berhasil absen hari ini!');
        } catch (ValidationException $err) {
            return back()->with('error', $err->getMessage());
        }

    }
    public function absen_keluar(Request $request)
    {
        $this->kehadiran_guru->AbsenKeluar($request->all());
        return back();
    }
}
