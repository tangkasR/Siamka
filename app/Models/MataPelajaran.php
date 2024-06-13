<?php

namespace App\Models;

use App\Models\Guru;
use App\Traits\uuid;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataPelajaran extends Model
{
    use HasFactory, uuid;

    protected $fillable = [
        'nama_mata_pelajaran',
    ];

    public function gurus()
    {
        return $this->belongsToMany(Guru::class);
    }

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'mata_pelajaran_id', 'id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'mata_pelajaran_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
