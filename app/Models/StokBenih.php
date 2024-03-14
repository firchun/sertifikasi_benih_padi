<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokBenih extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function sertifikasi(): BelongsTo
    {
        return $this->belongsTo(Sertifikasi::class, 'id_sertifikasi');
    }
    public function penangkar(): BelongsTo
    {
        return $this->belongsTo(Penangkar::class, 'id_penangkar');
    }
    public function varietas(): BelongsTo
    {
        return $this->belongsTo(varietas::class, 'id_varietas');
    }
    public function kelas_benih(): BelongsTo
    {
        return $this->belongsTo(KelasBenih::class, 'id_kelas_benih');
    }
    public static function getSertifikasi($id)
    {
        $stokMasuk = self::where('id_sertifikasi', $id)->where('jenis_stok', 'tambah')->sum('jumlah_stok');
        $stokKeluar = self::where('id_sertifikasi', $id)->where('jenis_stok', 'kurang')->sum('jumlah_stok');
        $jumlahStok = $stokMasuk - $stokKeluar;
        return $jumlahStok;
    }
}
