<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Services\GuruService;
use App\Services\JadwalPelajaranService;
use App\Services\MataPelajaranService;
use App\Services\RombelService;
use App\Services\RuanganService;
use App\Services\SesiService;
use App\Services\TahunAjaranService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JadwalPelajaranController extends Controller
{
    private $rombel;
    private $jadwal;
    private $ruangan;
    private $mapel;
    private $sesi;
    private $guru;
    private $tahun_ajaran;

    public function __construct(
        RombelService $rombel,
        JadwalPelajaranService $jadwal,
        RuanganService $ruangan,
        MataPelajaranService $mapel,
        SesiService $sesi,
        GuruService $guru,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->rombel = $rombel;
        $this->jadwal = $jadwal;
        $this->ruangan = $ruangan;
        $this->mapel = $mapel;
        $this->sesi = $sesi;
        $this->guru = $guru;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function index($tahun, $semeter)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semeter);
        return view('pages.admin.jadwal_pelajaran.index', [
            'rombel' => $this->rombel->getAll($tahun_ajaran_id),
            'tahun' => $tahun,
            'semester' => $semeter,
        ]);
    }

    public function show_jadwal($tahun, $semeter, Rombel $rombel)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semeter);
        return view('pages.admin.jadwal_pelajaran.jadwal_pelajaran', [
            'jadwal_pelajaran' => $this->jadwal->getByRombelId($rombel->id),
            'ruangan' => $this->ruangan->getAll(),
            'rombel' => $this->rombel->getOne($rombel->id),
            'mapel' => $this->mapel->getAll(),
            'sesi' => $this->sesi->getAll(),
            'templates' => $this->jadwal->createTemplate($rombel),
            'gurus' => $this->guru->getAll($tahun_ajaran_id),
            'tahun' => $tahun,
            'semester' => $semeter,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);

    }

    public function store(Request $request)
    {
        $rombel = $this->rombel->getOne($request->rombel_id);
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        try {
            $this->jadwal->store($request->all());
            return redirect()->route('admin.jadwal_pelajaran.show_jadwal', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('message', 'Berhasil menambah data');

        } catch (ValidationException $er) {
            return redirect()->route('admin.jadwal_pelajaran.show_jadwal', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('error', $er->getMessage());
        }
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

    public function getMapelsByGuru(Request $request)
    {
        $guru = $this->guru->getById($request->guru_id);
        $mapels = $guru->mapels;

        return response()->json($mapels);
    }

    public function tambah_data($tahun, $semester, Rombel $rombel)
    {
        $datas = [];
        return view('pages.admin.jadwal_pelajaran.import_data', [
            'tahun' => $tahun,
            'semester' => $semester,
            'datas' => $datas,
            'rombel' => $rombel,
        ]);
    }
}
