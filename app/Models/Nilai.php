<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'tipe_ujian',
        'nilai',
        'semester',
    ];

    public function mapels()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
