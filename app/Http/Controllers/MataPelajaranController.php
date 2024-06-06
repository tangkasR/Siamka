<?php

namespace App\Http\Controllers;

use App\Services\MataPelajaranService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    private $mapel;
    public function __construct(MataPelajaranService $mapel)
    {
        $this->mapel = $mapel;
    }

    public function index()
    {
        return view('pages.admin.mata_pelajaran', [
            'mapel' => $this->mapel->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->mapel->store($request->nama_mata_pelajaran);
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah data');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->mapel->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy($id)
    {
        try {
            $this->mapel->destroy($id);
            return redirect()->back()->with('message', 'Berhasil menghapus data');
        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
