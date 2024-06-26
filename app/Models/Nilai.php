<?php

namespace App\Models;

use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Throwable;

class Nilai extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'tahun_ajaran_id',
        'tipe_ujian',
        'nilai',
        'semester',
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

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
