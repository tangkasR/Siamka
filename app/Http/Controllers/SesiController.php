<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Services\SesiService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    private $sesi;
    public function __construct(SesiService $sesi)
    {
        $this->sesi = $sesi;
    }
    public function index()
    {
        return view('pages.admin.sesi', [
            'sesi' => $this->sesi->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->sesi->store($request->nama_sesi);
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menambah data');
        }
    }

    public function update(Request $request, Sesi $sesi)
    {
        try {
            $this->sesi->update($request->all(), $sesi);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Request $request, Sesi $sesi)
    {
        try {
            $this->sesi->destroy($sesi);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
