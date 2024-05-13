<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_ruangan',
    ];

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'ruangan_id', 'id');
    }
}
