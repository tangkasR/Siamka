<?php

namespace App\Models;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KehadiranGuru extends Model
{
    use HasFactory;
    protected $fillable = [
        'guru_id',
        'kehadiran',
        'tanggal',
    ];

    public function gurus()
    {
        return $this->belongsTo(Guru::class);
    }
}
