<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Services\DateService;

class TahunAjaranController extends Controller
{
    private $date;

    public function __construct(DateService $date)
    {
        $this->date = $date;
    }

    public function index($type)
    {
        $tahun_ajarans = TahunAjaran::orderBy('tahun_ajaran', 'desc')
            ->get()
            ->groupBy('tahun_ajaran')
            ->map(function ($items, $key) {
                return [
                    'tahun_ajaran' => $key,
                    'semesters' => $items->pluck('semester')->toArray(),
                ];
            })
            ->values()
            ->toArray();
        $tahun_ajarans = json_decode(json_encode($tahun_ajarans));
        return view('pages.tahun_ajaran', [
            'tahun_ajarans' => $tahun_ajarans,
            'type' => $type,
        ]);
    }

}
