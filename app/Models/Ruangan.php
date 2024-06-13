<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory, uuid;

    protected $fillable = [
        'nomor_ruangan',
    ];

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'ruangan_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
