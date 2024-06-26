<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\NilaiEkskul;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Throwable;

class Ekskul extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'guru_id',
        'nama_ekskul',
        'tahun_ajaran_id',
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class);
    }
    public function nilai_ekskuls()
    {
        return $this->hasMany(NilaiEkskul::class, 'ekskul_id', 'id');
    }
    public function gurus()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }

    public function getRouteKey()
    {
        return Crypt::encrypt($this->uuid);
    }
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $decrypted = Crypt::decrypt($value);
            $field = $field ?? $this->getRouteKeyName();

            return parent::resolveRouteBinding($decrypted, $field);
        } catch (Throwable $er) {
            abort(404);
        }
    }
}
