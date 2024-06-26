<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Services\DateService;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    private $date;

    public function __construct(DateService $date)
    {
        $this->date = $date;
    }

    public function index($type)
    {
        $tahun_ajarans = TahunAjaran::select('tahun_ajaran')->distinct()->orderBy('tahun_ajaran', 'desc')->get();
        return view('pages.tahun_ajaran', [
            'tahun_ajarans' => $tahun_ajarans,
            'type' => $type,
        ]);
    }
    public function semester($type, $tahun)
    {
        // $tahun = Crypt::decrypt($tahun);
        return view('pages.semester', [
            'tahun_ajaran' => $tahun,
            'type' => $type,
        ]);
    }

    public function create()
    {
        // $tahun_ajaran = $this->date->getDate()->year;
        // $tahun_ajaran = $tahun_ajaran . '/' . $tahun_ajaran + 1;
        // $semester = [
        //     'gasal', 'genap',
        // ];
        // foreach ($semester as $i) {
        //     TahunAjaran::create([
        //         'tahun_ajaran' => $tahun_ajaran,
        //         'semester' => $i,
        //     ]);
        // }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

}
