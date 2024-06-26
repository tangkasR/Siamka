<?php

namespace App\Http\Controllers;

use App\Imports\RombelImport;
use App\Models\Rombel;
use App\Services\GuruService;
use App\Services\RombelService;
use App\Services\TahunAjaranService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class RombelController extends Controller
{
    private $rombel;
    private $guru;
    private $tahun_ajaran;

    public function __construct(
        RombelService $rombel,
        GuruService $guru,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->rombel = $rombel;
        $this->guru = $guru;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function index($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $tahun_ajaran = $this->tahun_ajaran->getById($tahun_ajaran_id);
        return view('pages.admin.rombel.rombel', [
            'rombel' => $this->rombel->getAll($tahun_ajaran_id),
            'gurus' => $this->guru->getAll($tahun_ajaran_id),
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'tahun_ajaran' => $tahun_ajaran,
        ]);
    }

    public function store(Request $request)
    {

        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }

        try {
            Excel::import(new RombelImport($request->tahun, $request->semester), $request->file);
            return redirect()->route('admin.rombel', ['tahun' => $request->tahun, 'semester' => $request->semester])->with('message', 'Berhasil menambah data');
        } catch (ValidationException $er) {
            return redirect()->route('admin.rombel', ['tahun' => $request->tahun, 'semester' => $request->semester])->with('error', $er->getMessage());
        }
    }
    public function update(Request $request, Rombel $rombel)
    {
        try {
            $this->rombel->update($request->all(), $rombel);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Rombel $rombel)
    {
        try {
            $this->rombel->destroy($rombel);
            return back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
    public function tambah_data($tahun, $semester)
    {
        $datas = [];
        return view('pages.admin.rombel.import_data', [
            'tahun' => $tahun,
            'semester' => $semester,
            'datas' => $datas,
        ]);
    }
}
