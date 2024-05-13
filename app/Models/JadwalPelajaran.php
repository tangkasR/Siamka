<?php

namespace App\Models;

use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'ruangan_id',
        'rombel_id',
        'mata_pelajaran_id',
        'sesi_id',
        'hari',
    ];
    public function ruangans()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
    public function rombels()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }
    public function mata_pelajarans()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
    public function sesis()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'id');
    }
}
