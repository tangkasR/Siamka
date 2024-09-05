<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\PengumumanService;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class PengumumanController extends Controller
{
    private $pengumuman;
    private $auth;
    public function __construct(PengumumanService $pengumuman, AuthService $auth)
    {
        $this->pengumuman = $pengumuman;
        $this->auth = $auth;
    }
    public function index()
    {
        return view('pages.admin.pengumuman.pengumuman', [
            'pengumumans' => $this->pengumuman->getAll(),
        ]);
    }
    public function detail(Pengumuman $pengumuman)
    {
        return view('pages.admin.pengumuman.detail_pengumuman', [
            'pengumuman' => $this->pengumuman->getById($pengumuman->id),
            'auth' => auth(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'image' => 'max:200',
        ], [
            'image.max' => 'File gambar tampilan pengumuman harus kurang dari 200kb!',
        ]);

        try {
            $this->pengumuman->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');

        } catch (ValidationException $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->pengumuman->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy($id)
    {
        try {
            $this->pengumuman->destroy($id);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
    public function show_pengumuman(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.pengumuman.data-pengumuman', [
                'pengumumans' => $this->pengumuman->paginate(4),
            ])->render();
        }
        return view('pages.pengumuman.pengumuman', [
            'pengumumans' => $this->pengumuman->paginate(4),
            'auth' => auth(),
        ]);
    }
}