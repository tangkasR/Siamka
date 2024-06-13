<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Services\RuanganService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    private $ruangan;
    public function __construct(RuanganService $ruangan)
    {
        $this->ruangan = $ruangan;
    }
    public function index()
    {
        return view('pages.admin.ruangan', [
            'ruangan' => $this->ruangan->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->ruangan->store($request->nomor_ruangan);
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah data');
        }
    }
    public function update(Request $request, Ruangan $ruangan)
    {
        try {
            $this->ruangan->update($request->all(), $ruangan);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Ruangan $ruangan)
    {
        try {
            $this->ruangan->destroy($ruangan);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
