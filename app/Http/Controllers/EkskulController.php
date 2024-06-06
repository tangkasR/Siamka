<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\EkskulService;
use App\Services\MataPelajaranService;
use App\Services\NilaiService;
use App\Services\RombelService;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    private $rombel;
    private $auth;
    private $ekskul;

    public function __construct(
        RombelService $rombel,
        AuthService $auth,
        EkskulService $ekskul
    ) {
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->ekskul = $ekskul;
    }
    public function index()
    {
        $guru = $this->auth->getUser('guru');
        return view('pages.guru.ekskul.index', [
            'ekskuls' => $this->ekskul->getAll($guru->id),
            'guru' => $guru,
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

    public function destroy($id)
    {
        try {
            $this->ekskul->destroy($id);
            return redirect()->back()->with('message', 'Berhasil menonaktifkan data ekskul');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan data ekskul');
        }
    }

    public function daftar_anggota($id)
    {
        return view('pages.Guru.ekskul.anggota.index', [
            'id' => $id,
            'siswas' => $this->ekskul->getMemberList($id),
            'ekskul' => $this->ekskul->getById($id),
        ]);
    }
    public function daftar_rombel($id)
    {
        $checkStatus = $this->ekskul->getById($id);
        if ($checkStatus->status == 'tidak aktif') {
            return redirect()->back()->with('error', 'Status ekskul tidak aktif');
        }
        return view('pages.Guru.ekskul.anggota.list_rombel', [
            'rombels' => $this->rombel->getAll(),
            'id' => $id,
        ]);
    }
    public function show_siswa($id, $rombel_id)
    {
        return view('pages.Guru.ekskul.anggota.tambah', [
            'siswas' => $this->ekskul->getSiswaNonMember($rombel_id, $id),
            'id' => $id,
            'rombel' => $this->rombel->getOne('id', $rombel_id),
            'ekskul' => $this->ekskul->getById($id),
        ]);
    }

    public function addMember(Request $request)
    {
        try {
            $this->ekskul->addMember($request->all());
            return redirect()->route('guru.ekskul.daftar_anggota', ['id' => $request->ekskul_id])->with('message', 'Berhasil menambah anggota ekskul');

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
    public function change_status(Request $request)
    {
        try {
            $this->ekskul->change_status($request->all());
            return redirect()->back()->with('message', 'Berhasil mengubah status siswa');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah status siswa');
        }
    }
    public function activate($id)
    {
        try {
            $this->ekskul->activate($id);
            return redirect()->back()->with('message', 'Berhasil mengaktifkan data ekskul');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengaktifkan data ekskul');
        }
    }
}
