<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mata_pelajaran',
    ];

    public function gurus()
    {
        return $this->hasMany(Guru::class, 'mata_pelajaran_id', 'id');
    }

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'mata_pelajaran_id', 'id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'mata_pelajaran_id', 'id');
    }
}
