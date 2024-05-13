<?php

namespace App\Models;

use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'tipe_ujian',
        'nilai',
    ];

    public function mapels()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
