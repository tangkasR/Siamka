<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\EkskulService;
use App\Services\NilaiEkskulService;
use Illuminate\Http\Request;

class NilaiEkskulController extends Controller
{
    private $nilai_ekskul;
    private $ekskul;
    private $auth;

    public function __construct(
        NilaiEkskulService $nilai_ekskul,
        EkskulService $ekskul,
        AuthService $auth
    ) {
        $this->nilai_ekskul = $nilai_ekskul;
        $this->ekskul = $ekskul;
        $this->auth = $auth;
    }

    public function index()
    {
        $guru = $this->auth->getUser('guru');
        return view('pages.guru.ekskul.nilai.index', [
            'ekskuls' => $this->ekskul->getAll($guru->id),
        ]);
    }
    public function nilai($id)
    {
        $ekskul = $this->ekskul->getById($id);
        return view('pages.guru.ekskul.nilai.nilai', [
            'nilais' => $this->nilai_ekskul->getAll($id),
            'ekskul' => $ekskul,
            'siswas' => $this->ekskul->getMemberList($id),
        ]);
    }

    public function tambah_nilai($id)
    {
        $ekskul = $this->ekskul->getById($id);
        if ($ekskul->status == 'tidak aktif') {
            return redirect()->back()->with('error', 'Status ekskul tidak aktif! Silahkan aktivasi ekskul terlebih dahulu di menu Ekskul!');
        }
        return view('pages.guru.ekskul.nilai.tambah_nilai', [
            'siswas' => $this->ekskul->getMemberList($id),
            'ekskul' => $ekskul,
        ]);
    }

    public function store(Request $request, $ekskul_id)
    {
        $checkNilai = $this->nilai_ekskul->checkNilaiWithSemester($request->ekskul_id, $request->semester);

        if (count($checkNilai) > 0) {
            return redirect()->back()
                ->with('error', 'Nilai dengan semester dan nama ekskul tersebut sudah dimasukan!');
        }
        try {
            $this->nilai_ekskul->store($request->all());
            return redirect()->route('guru.nilai_ekskul', ['ekskul_id' => $ekskul_id])
                ->with('message', 'Berhasil menambah data nilai');

        } catch (QueryException $er) {
            return redirect()->route('guru.nilai_ekskul', ['ekskul_id' => $ekskul_id])
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
}
