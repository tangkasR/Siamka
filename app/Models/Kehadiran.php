<?php

namespace App\Models;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $fillable = [
        'rombel_id',
        'tanggal',
    ];

    public function rombels()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class)->withPivot('kehadiran');
    }
}
