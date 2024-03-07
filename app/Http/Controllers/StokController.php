<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
use App\Models\StokBenih;
use App\Models\varietas;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function getall(Request $request)
    {
        $query = varietas::select([
            'id',
            'name',
            'umur',
            'potensi_hasil',
        ])
            ->when(request()->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('id');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $varietas = $query->paginate(10);

        // Ambil data jumlah_stok dari tabel stok_benihs
        foreach ($varietas as $key => $varietasItem) {
            $stokMasuk = StokBenih::where('id_varietas', $varietasItem->id)->where('jenis_stok', 'tambah')->sum('jumlah_stok');
            $stokKeluar = StokBenih::where('id_varietas', $varietasItem->id)->where('jenis_stok', 'kurang')->sum('jumlah_stok');
            $jumlahStok = $stokMasuk - $stokKeluar;
            $varietas[$key]->stok = $jumlahStok;
        }

        return response()->json($varietas);
    }

    public function getThree()
    {
        $varietas = varietas::select([
            'id',
            'name',
            'umur',
            'potensi_hasil',
        ])
            ->when(request()->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('id')
            ->latest()->limit(3)->get();
        // Ambil data jumlah_stok dari tabel stok_benihs
        foreach ($varietas as $key => $varietasItem) {
            $stokMasuk = StokBenih::where('id_varietas', $varietasItem->id)->where('jenis_stok', 'tambah')->sum('jumlah_stok');
            $stokKeluar = StokBenih::where('id_varietas', $varietasItem->id)->where('jenis_stok', 'kurang')->sum('jumlah_stok');
            $jumlahStok = $stokMasuk - $stokKeluar;
            $varietas[$key]->stok = $jumlahStok;
        }

        return response()->json($varietas);
    }
    public function getVarietas($id)
    {
        $stok = StokBenih::where('id_varietas', $id);
    }
}
