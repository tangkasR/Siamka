<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Services\AuthService;
use App\Services\EkskulService;
use App\Services\NilaiEkskulService;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NilaiEkskulController extends Controller
{
    private $nilai_ekskul;
    private $ekskul;
    private $auth;
    private $tahun_ajaran;

    public function __construct(
        NilaiEkskulService $nilai_ekskul,
        EkskulService $ekskul,
        AuthService $auth,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->nilai_ekskul = $nilai_ekskul;
        $this->ekskul = $ekskul;
        $this->auth = $auth;
        $this->tahun_ajaran = $tahun_ajaran;
    }

    public function index($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $guru = $this->auth->getUser('guru');
        return view('pages.guru.ekskul.nilai.index', [
            'ekskuls' => $this->ekskul->getAll($guru->nomor_induk_yayasan, $tahun_ajaran_id),
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function nilai($tahun, $semester, $id)
    {
        $ekskul = $this->ekskul->getById(Crypt::decrypt($id));
        return view('pages.guru.ekskul.nilai.nilai', [
            'nilais' => $this->nilai_ekskul->getAll($ekskul->id),
            'ekskul' => $ekskul,
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran_id' => $this->tahun_ajaran->getId($tahun, $semester),
        ]);
    }

    public function tambah_nilai($tahun_ajaran_id, Ekskul $ekskul)
    {
        $tahun_ajaran = $this->tahun_ajaran->getById(Crypt::decrypt($tahun_ajaran_id));
        return view('pages.guru.ekskul.nilai.tambah_nilai', [
            'siswas' => $this->ekskul->getMemberList($ekskul->id),
            'ekskul' => $ekskul,
            'tahun_ajaran_id' => Crypt::decrypt($tahun_ajaran_id),
            'semester' => $tahun_ajaran->semester,
        ]);
    }

    public function store(Request $request, Ekskul $ekskul)
    {
        $checkNilai = $this->nilai_ekskul->checkNilaiWithSemester($request->ekskul_id, $request->tahun_ajaran_id);
        $tahun_ajaran = $this->tahun_ajaran->getById($request->tahun_ajaran_id);

        if (count($checkNilai) > 0) {
            $message = 'Nilai dengan tahun ajaran ' . $tahun_ajaran->tahun_ajaran . ' dan semester ' . $tahun_ajaran->semester . ' sudah dimasukan!';
            return redirect()->back()
                ->with('error', $message);
        }

        try {
            $this->nilai_ekskul->store($request->all());
            return redirect()->route('guru.nilai_ekskul', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'id' => Crypt::encrypt($ekskul->id)])
                ->with('message', 'Berhasil menambah data nilai');

        } catch (QueryException $er) {
            return redirect()->route('guru.nilai_ekskul', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'id' => Crypt::encrypt($ekskul->id)])
                ->with('error', 'Gagal menambah data nilai');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->nilai_ekskul->update($request->all(), $id);
            return redirect()->back()
                ->with('message', 'Berhasil menambah data nilai');

        } catch (QueryException $er) {
            return redirect()->back()
                ->with('error', 'Gagal menambah data nilai');
        }
    }

    public function destroy($id)
    {
        try {
            $this->nilai_ekskul->destroy('id', $id);
            return redirect()->back()
                ->with('message', 'Berhasil menghapus data nilai');

        } catch (QueryException $er) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data nilai');
        }
    }

    public function admin_detail_ekskul($tahun, $semester, Ekskul $ekskul)
    {
        return view('pages.admin.ekskul.detail_ekskul', [
            'tahun' => $tahun,
            'semester' => $semester,
            'ekskul' => $ekskul,
            'nilais' => $this->nilai_ekskul->getAll($ekskul->id),
        ]);
    }
}
