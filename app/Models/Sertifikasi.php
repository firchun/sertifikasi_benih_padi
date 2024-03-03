<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertifikasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }
    public function kelas_benih_asal(): BelongsTo
    {
        return $this->belongsTo(kelasBenih::class, 'id_kelas_benih_asal');
    }
    public function kelas_benih_sebelumnya(): BelongsTo
    {
        return $this->belongsTo(kelasBenih::class, 'id_kelas_benih_sebelumnya');
    }
    public function varietas(): BelongsTo
    {
        return $this->belongsTo(varietas::class, 'id_varietas');
    }
    public function varietas_sebelumnya(): BelongsTo
    {
        return $this->belongsTo(varietas::class, 'id_varietas_sebelumnya');
    }
}
