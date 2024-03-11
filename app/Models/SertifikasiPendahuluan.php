<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SertifikasiPendahuluan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sertifikasi(): BelongsTo
    {
        return $this->belongsTo(Sertifikasi::class, 'id_sertifikasi');
    }
    public function kelas_benih_sebelumnya(): BelongsTo
    {
        return $this->belongsTo(kelasBenih::class, 'id_kelas_benih_sebelumnya');
    }
    public function varietas_sebelumnya(): BelongsTo
    {
        return $this->belongsTo(varietas::class, 'id_varietas_sebelumnya');
    }
}
