<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\EkskulService;
use App\Services\RombelService;
use App\Services\TahunAjaranService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;

class EkskulController extends Controller
{
    private $rombel;
    private $auth;
    private $ekskul;
    private $tahun_ajaran;

    public function __construct(
        RombelService $rombel,
        AuthService $auth,
        EkskulService $ekskul,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->ekskul = $ekskul;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function index($tahun, $semester)
    {
        $guru = $this->auth->getUser('guru');
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return view('pages.guru.ekskul.index', [
            'ekskuls' => $this->ekskul->getAll($guru->nomor_induk_yayasan, $tahun_ajaran_id),
            'guru' => $guru,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->ekskul->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah data');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $this->ekskul->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function daftar_anggota($tahun, $semester, $id)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $tahun_ajaran = $this->tahun_ajaran->getById($tahun_ajaran_id);
        return view('pages.guru.ekskul.anggota.index', [
            'siswas' => $this->ekskul->getMemberList(Crypt::decrypt($id)),
            'ekskul' => $this->ekskul->getById(Crypt::decrypt($id)),
            'tahun_ajaran' => $tahun_ajaran,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function daftar_rombel($tahun, $semester, TahunAjaran $tahun_ajaran, Ekskul $ekskul)
    {
        return view('pages.guru.ekskul.anggota.list_rombel', [
            'rombels' => $this->rombel->getAll($tahun_ajaran->id),
            'ekskul' => $ekskul,
            'tahun' => $tahun,
            'semester' => $semester,
            'ekskul' => $ekskul,
            'tahun_ajaran' => $tahun_ajaran,
        ]);
    }
    public function show_siswa($tahun, $semester, Ekskul $ekskul, Rombel $rombel)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $tahun_ajaran = $this->tahun_ajaran->getById($tahun_ajaran_id);
        return view('pages.guru.ekskul.anggota.tambah', [
            'siswas' => $this->ekskul->getSiswaNonMember($rombel, $ekskul),
            'ekskul' => $ekskul,
            'rombel' => $rombel,
            'ekskul' => $ekskul,
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran,
        ]);
    }

    public function addMember(Request $request)
    {
        try {
            $this->ekskul->addMember($request->all());
            return redirect()->route('guru.ekskul.daftar_anggota', ['tahun' => $request->tahun_, 'semester' => $request->semester_, 'id' => Crypt::encrypt($request->ekskul_id)])->with('message', 'Berhasil menambah anggota ekskul');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah anggota ekskul');
        }
    }

    public function delete_member($id, Request $request)
    {
        try {
            $this->ekskul->delete_member($id, $request->all());
            return redirect()->back()->with('message', 'Berhasil mengeluarkan siswa dari ekskul');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengeluarkan siswa dari ekskul');
        }
    }

    public function admin_show_ekskul($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $ekskuls = $this->ekskul->getAllDatas($tahun_ajaran_id);
        return view('pages.admin.ekskul.index', [
            'tahun' => $tahun,
            'semester' => $semester,
            'ekskuls' => $ekskuls,
        ]);
    }
}