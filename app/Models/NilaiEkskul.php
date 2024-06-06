<?php

namespace App\Models;

use App\Models\Ekskul;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEkskul extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id',
        'ekskul_id',
        'nilai',
        'semester',
    ];
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function ekskuls()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id', 'id');
    }
}
