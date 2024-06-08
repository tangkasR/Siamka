<?php

namespace App\Http\Controllers;

use App\Services\DateService;
use App\Services\GuruService;
use App\Services\KehadiranGuruService;
use App\Services\MataPelajaranService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    private $guru;
    private $mapel;
    private $kehadiran_guru;
    private $date;

    public function __construct(
        GuruService $guru,
        MataPelajaranService $mapel,
        KehadiranGuruService $kehadiran_guru,
        DateService $date
    ) {
        $this->guru = $guru;
        $this->mapel = $mapel;
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
    }
    public function index()
    {
        // dd($this->guru->getAll());
        return view('pages.admin.guru.guru', [
            'guru' => $this->guru->getAll(),
            'mapel' => $this->mapel->getAll(),
        ]);
    }

    public function detail_guru($id)
    {
        // dd($this->guru->getById($id));
        return view('pages.admin.guru.show-guru', [
            'guru' => $this->guru->getById($id),
        ]);
    }
    public function store(Request $request)
    {
        try {
            $this->guru->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');
        } catch (ValidationException $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->guru->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $this->guru->destroy($id);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
    public function profil()
    {
        return view('pages.guru.profil', [
            'guru' => $this->guru->profil('guru'),
        ]);
    }
    public function update_profil(Request $request)
    {
        $validator = $request->validate([
            'profil' => 'max:200|mimes:jpg, png, jpeg',
            'ktp' => 'max:1000|mimes:pdf',
            'ijazah' => 'max:1000|mimes:pdf',
            'kartu_keluarga' => 'max:1000|mimes:pdf',
        ], [
            'profil.max' => 'File foto harus kurang dari 200kb!',
            'ktp.max' => 'File KTP harus kurang dari 1mb!',
            'ijazah.max' => 'File ijazah harus kurang dari 1mb!',
            'kartu_keluarga.max' => 'File kartu keluarga harus kurang dari 1mb!',
            'profil.mimes' => 'Format File foto harus jpg atau jpeg atau png!',
            'ktp.mimes' => 'Format File KTP harus pdf!',
            'ijazah.mimes' => 'Format File Ijazah harus pdf!',
            'kartu_keluarga.mimes' => 'Format Kartu Keluarga harus pdf!',
        ]);
        $this->guru->updateProfil($request->all());
        return redirect()->route('guru.profil')->with('message', 'Berhasil mengubah profil!');

    }
    public function cetak_kehadiran(Request $request, $id)
    {
        $guru = $this->guru->getById($id);
        $tahun = $this->date->getDate()->year;
        if ($request->ajax()) {
            $tahun = $request->tahun;
            return view('pages.admin.guru.data-kehadiran', [
                'guru' => $guru,
                'tanggal' => $this->date->getDate()->format('d-m-Y'),
                'bulan' => $this->date->getDate()->month,
                'tahun' => $this->date->getDate()->year,
                'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->id, $tahun),
                'years' => $this->kehadiran_guru->getYear(),
            ]);
        }
        return view('pages.admin.guru.rekap-kehadiran', [
            'guru' => $guru,
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'bulan' => $this->date->getDate()->month,
            'tahun' => $this->date->getDate()->year,
            'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->id, $tahun),
            'years' => $this->kehadiran_guru->getYear(),
        ]);
    }
}
