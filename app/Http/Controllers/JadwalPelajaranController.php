<?php

namespace App\Http\Controllers;

use App\Services\GuruService;
use App\Services\JadwalPelajaranService;
use App\Services\MataPelajaranService;
use App\Services\RombelService;
use App\Services\RuanganService;
use App\Services\SesiService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    private $rombel;
    private $jadwal;
    private $ruangan;
    private $mapel;
    private $sesi;
    private $guru;

    public function __construct(
        RombelService $rombel,
        JadwalPelajaranService $jadwal,
        RuanganService $ruangan,
        MataPelajaranService $mapel,
        SesiService $sesi,
        GuruService $guru
    ) {
        $this->rombel = $rombel;
        $this->jadwal = $jadwal;
        $this->ruangan = $ruangan;
        $this->mapel = $mapel;
        $this->sesi = $sesi;
        $this->guru = $guru;
    }
    public function index()
    {
        return view('pages.admin.jadwal_pelajaran.index', [
            'rombel' => $this->rombel->getAll(),
        ]);
    }

    public function show_jadwal($id)
    {
        return view('pages.admin.jadwal_pelajaran.jadwal_pelajaran', [
            'jadwal_pelajaran' => $this->jadwal->getByRombelId($id),
            'ruangan' => $this->ruangan->getAll(),
            'rombel' => $this->rombel->getOne('id', $id),
            'mapel' => $this->mapel->getAll(),
            'sesi' => $this->sesi->getAll(),
            'templates' => $this->jadwal->createTemplate($id),
            'gurus' => $this->guru->getAll(),
        ]);

    }

    public function store(Request $request)
    {
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        // try {
        $this->jadwal->store($request->all());
        return redirect()->back()->with('message', 'Berhasil menambah data');

        // } catch (QueryException $er) {
        // return redirect()->back()->with('error', 'Gagal menambah data');
        // }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->jadwal->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy($id)
    {
        try {
            $this->jadwal->destroyAllByRombelId($id);
            return back()->with('message', 'Berhasil menghapus semua data');
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal menghapus semua data');
        }
    }

    public function getMapelsByGuru($guru_id)
    {
        // Asumsi bahwa model Teacher dan Subject sudah didefinisikan dan ada relasi many-to-many di antara mereka
        $guru = $this->guru->getById($guru_id);
        $mapels = $guru->mapels;

        return response()->json($mapels);

    }
}
