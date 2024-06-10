<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
use App\Models\SertifikasiLab;
use App\Models\StokBenih;
use App\Models\varietas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
    public function getStoksDataTable()
    {
        $Stok = StokBenih::selectRaw('stok_benihs.id_penangkar,stok_benihs.id_kelas_benih, stok_benihs.id_varietas')
            ->groupBy('stok_benihs.id_penangkar', 'stok_benihs.id_varietas', 'stok_benihs.id_kelas_benih')
            ->join('penangkars', 'penangkars.id', '=', 'stok_benihs.id_penangkar')
            ->join('varietas', 'varietas.id', '=', 'stok_benihs.id_varietas')
            ->join('kelas_benihs', 'kelas_benihs.id', '=', 'stok_benihs.id_kelas_benih')
            ->with(['penangkar', 'varietas', 'kelas_benih']);

        return DataTables::of($Stok)
            ->addColumn('stok', function ($Stok) {
                $stokMasuk = StokBenih::where('id_varietas', $Stok->id_varietas)->where('jenis_stok', 'tambah')->sum('jumlah_stok');
                $stokKeluar = StokBenih::where('id_varietas', $Stok->id_varietas)->where('jenis_stok', 'kurang')->sum('jumlah_stok');
                $jumlahStok = $stokMasuk - $stokKeluar;
                return $jumlahStok;
            })

            ->rawColumns(['stok'])
            ->make(true);
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

    public function getDetailStok($id)
    {
        $stok = StokBenih::selectRaw('stok_benihs.id_penangkar,stok_benihs.id_kelas_benih, stok_benihs.id_varietas,stok_benihs.id_sertifikasi')
            ->where('stok_benihs.id_varietas', $id)
            ->groupBy('stok_benihs.id_penangkar', 'stok_benihs.id_varietas', 'stok_benihs.id_kelas_benih', 'stok_benihs.id_sertifikasi')
            ->join('penangkars', 'penangkars.id', '=', 'stok_benihs.id_penangkar')
            ->join('varietas', 'varietas.id', '=', 'stok_benihs.id_varietas')
            ->join('kelas_benihs', 'kelas_benihs.id', '=', 'stok_benihs.id_kelas_benih')
            ->with(['penangkar', 'varietas', 'kelas_benih'])
            ->get();

        foreach ($stok as $key => $stokItem) {
            $stokMasuk = StokBenih::where('id_varietas', $stokItem->id_varietas)->where('jenis_stok', 'tambah')->sum('jumlah_stok');
            $stokKeluar = StokBenih::where('id_varietas', $stokItem->id_varietas)->where('jenis_stok', 'kurang')->sum('jumlah_stok');
            $jumlahStok = $stokMasuk - $stokKeluar;
            $stok[$key]->stok = $jumlahStok;

            $sertifikasiLabs = SertifikasiLab::where('id_sertifikasi', $stokItem->id_sertifikasi)->latest()->first()->tanggal_label ?? null;
            $stok[$key]->expired = $sertifikasiLabs;
        }
        return response()->json($stok);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_sertifikasi' => 'required|exists:sertifikasis,id',
            'id_varietas' => 'required|exists:varietas,id',
            'id_kelas_benih' => 'required|exists:kelas_benihs,id',
            'id_penangkar' => 'required|exists:penangkars,id',
            'id_user' => 'required|exists:users,id',
            'jenis_stok' => 'required|string',
            'jumlah_stok' => 'required|numeric',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        $stokData = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'id_varietas' => $request->input('id_varietas'),
            'id_user' => $request->input('id_user'),
            'id_kelas_benih' => $request->input('id_kelas_benih'),
            'id_penangkar' => $request->input('id_penangkar'),
            'jenis_stok' => $request->input('jenis_stok'),
            'jumlah_stok' => $request->input('jumlah_stok'),
        ];


        if ($request->filled('id')) {
            $StokBenih = StokBenih::find($request->input('id'));
            if (!$StokBenih) {
                return response()->json(['message' => 'Stok not found'], 404);
            }

            $StokBenih->update($stokData);
            $message = 'Stok berhasil diupdate..';
        } else {
            StokBenih::create($stokData);
            $message = 'Stok berhasil disimpan..';
        }
        return response()->json(['message' => $message]);
    }
}
