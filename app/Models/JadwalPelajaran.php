<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
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
        'guru_id',
        'sesi_id',
        'hari',
        'nama_mata_pelajaran',
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
    public function gurus()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}
