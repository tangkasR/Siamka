<?php

namespace App\Http\Controllers;

use App\Services\GuruService;
use App\Services\RombelService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    private $rombel;
    private $guru;
    public function __construct(
        RombelService $rombel,
        GuruService $guru
    ) {
        $this->rombel = $rombel;
        $this->guru = $guru;
    }
    public function index()
    {
        return view('pages.admin.rombel', [
            'rombel' => $this->rombel->getAll(),
            'guru' => $this->rombel->getGuruBukanWaliKelas(),
            'guruAll' => $this->guru->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->rombel->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah data');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->rombel->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $this->rombel->destroy($id);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
