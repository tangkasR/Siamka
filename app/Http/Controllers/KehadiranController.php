<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\DateService;
use App\Services\KehadiranService;
use App\Services\RombelService;
use App\Services\SiswaService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KehadiranController extends Controller
{
    private $rombel;
    private $kehadiran;
    private $siswa;
    private $date;
    private $auth;

    public function __construct(
        RombelService $rombel,
        KehadiranService $kehadiran,
        SiswaService $siswa,
        DateService $date,
        AuthService $auth
    ) {
        $this->rombel = $rombel;
        $this->kehadiran = $kehadiran;
        $this->siswa = $siswa;
        $this->date = $date;
        $this->auth = $auth;
    }
    public function index()
    {
        $guru = $this->auth->getUser('guru');
        return view('pages.guru.kehadiran.kehadiran', [
            'rombel' => $this->rombel->getByGuruIdSesiSatu($guru->id),
            'date' => $this->date->getDate()->format('Y-m-d'),
        ]);
    }
    public function getKehadiran_guru(Request $request)
    {
        $kehadiran = $this->kehadiran
            ->getByRombelId($request->rombel_id, $this->date->getDate()->format('Y-m-d'))
            ->paginate(5);
        return response($kehadiran);
    }
    public function filter(Request $request)
    {
        $kehadiran = $this->kehadiran
            ->getByRombelId($request->rombel_id, $request->tanggal)
            ->paginate(5);
        return response($kehadiran);
    }
    public function show_input($id)
    {
        return view('pages.guru.kehadiran.tambah_kehadiran', [
            'rombel' => $this->rombel->getOne('id', $id),
            'date' => $this->date->getDate()->format('Y-m-d'),
            'siswas' => $this->siswa->getByRombelIdActive($id),

        ]);
    }

    public function store(Request $request)
    {

        $check_kehadiran = $this->kehadiran->getByRombelId($request->rombel_id, $request->tanggal)->get();

        if (count($check_kehadiran) != 0) {
            return redirect()->route('guru.kehadiran.show_siswa', ['id' => $request->rombel_id])
                ->with('error', 'Data Kehadiran hari ini sudah ada!');
        }

        $this->kehadiran->store($request->all());
        return redirect()->route('guru.kehadiran.show_siswa', ['id' => $request->rombel_id])
            ->with('message', 'Berhasil menambah kehadiran hari ini');
    }

    public function show_update($id, $siswa_id)
    {
        $siswa = $this->siswa->getById($siswa_id);
        return view('pages.guru.kehadiran.ubah-kehadiran', [
            'siswa' => $siswa,
            'rombel_id' => $siswa->rombels->last()->id,
            'kehadiran' => $this->kehadiran->getById($id),
        ]);
    }
    public function update(Request $request, $id)
    {

        $this->kehadiran->update($request->all(), $id);
        return redirect()->route('guru.kehadiran.show_siswa', ['id' => $request->rombel_id])
            ->with('message', 'Berhasil mengubah data kehadiran');
    }
    public function destroy($rombel_id)
    {
        try {
            $this->kehadiran->destroy($rombel_id);
            return redirect()->back()
                ->with('message', 'Berhasil menghapus data kehadiran hari ini!');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
}
