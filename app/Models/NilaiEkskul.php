<?php

namespace App\Models;

use Throwable;
use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\Ekskul;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiEkskul extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'ekskul_id',
        'nilai',
        'semester',
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function ekskuls()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id', 'id');
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
