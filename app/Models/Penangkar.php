<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penangkar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'id_user',
        'alamat',
        'jenis',
        'jumlah_anggota',
        'luas_lahan',
        'latitude',
        'longitude',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
