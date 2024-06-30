<?php

namespace App\Repositories;

use App\Interfaces\KehadiranGuruInterface;
use App\Models\KehadiranGuru;
use Carbon\Carbon;

class KehadiranGuruRepository implements KehadiranGuruInterface
{
    private $kehadiran_guru;
    public function __construct(KehadiranGuru $kehadiran_guru)
    {
        $this->kehadiran_guru = $kehadiran_guru;
    }

    public function getData($niy, $bulan, $tahun)
    {
        return $this->kehadiran_guru
            ->join('gurus', 'kehadiran_gurus.guru_id', '=', 'gurus.id')
            ->where('gurus.nomor_induk_yayasan', $niy)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->paginate(5);
    }
    public function rekapKehadiranGuru($niy, $tahun)
    {
        $rekapKehadiran = $this->kehadiran_guru
            ->join('gurus', 'kehadiran_gurus.guru_id', '=', 'gurus.id')
            ->where('gurus.nomor_induk_yayasan', $niy)
            ->selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, COUNT(*) as total_kehadiran, SUM(total_jam) as total_jam_per_bulan')
            ->whereYear('tanggal', $tahun)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->get();
        $bulanNama = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Sort the collection by month numerically before converting to names
        $rekapKehadiran = $rekapKehadiran->sortBy('bulan')->values();

        $rekapKehadiran = $rekapKehadiran->map(function ($item) use ($bulanNama) {
            $item->bulan = $bulanNama[$item->bulan];
            return $item;
        });
        return $rekapKehadiran;
    }
    public function getYear()
    {
        return $this->kehadiran_guru->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();
    }
    public function checkAbsensi($guru_id, $tanggal)
    {
        return $this->kehadiran_guru->where('guru_id', $guru_id)
            ->where('tanggal', $tanggal)->get();
    }
    public function setLatLongSekolah()
    {
        // Salah
        // return $lokasi = [
        //     'latitude' => -7.825418618406336,
        //     'longitude' => 110.39078129170166,
        // ];

        // benar
        return $lokasi = [
            'latitude' => -7.537368581394443,
            'longitude' => 109.1264773486788,
        ];

    }
    public function store($datas, $tanggal, $tahun_ajaran_id)
    {
        $jam_masuk = Carbon::now();
        $jam_keluar = Carbon::createFromTime(0, 0, 0);
        return $this->kehadiran_guru->create([
            'guru_id' => $datas['guru_id'],
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'kehadiran' => 'hadir',
            'tanggal' => $tanggal,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'total_jam' => 0,
        ]);
    }
    public function AbsenKeluar($tanggal, $datas)
    {
        $jam_keluar = Carbon::now();
        $kehadiran_guru_ = $this->kehadiran_guru->where('tanggal', $tanggal)->where('guru_id', $datas['guru_id'])->first();
        $jam_masuk = Carbon::parse($kehadiran_guru_->jam_masuk);

        // Hitung total jam dalam menit
        $total_jam = $jam_keluar->diffInMinutes($jam_masuk);

        // Jika ingin total jam dalam jam
        $total_jam_in_hours = $jam_keluar->diffInHours($jam_masuk) + ($jam_keluar->diffInMinutes($jam_masuk) % 60) / 60;
        $total_jam_formatted = number_format($total_jam_in_hours, 2);
        return $this->kehadiran_guru->where('tanggal', $tanggal)->update([
            'jam_keluar' => $jam_keluar,
            'total_jam' => $total_jam_formatted,
        ]);
    }

    public function rataRataJamKerja()
    {
        return $this->kehadiran_guru
            ->join('tahun_ajarans', 'kehadiran_gurus.tahun_ajaran_id', '=', 'tahun_ajarans.id')
            ->selectRaw('tahun_ajarans.tahun_ajaran, tahun_ajarans.semester, AVG(total_jam) as rata_rata_jam_kerja')
            ->groupBy('tahun_ajarans.tahun_ajaran', 'tahun_ajarans.semester')
            ->orderBy('tahun_ajarans.tahun_ajaran')
            ->orderBy('tahun_ajarans.semester')
            ->get();
    }
}
