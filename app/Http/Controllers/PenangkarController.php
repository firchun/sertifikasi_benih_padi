<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
use App\Models\PenangkarAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PenangkarController extends Controller
{
    public function index()
    {
        $data = [
            'title' => Auth::user()->role == 'Penangkar' ? 'Daftar jadi penangkar' : 'Data Penangkar',
        ];
        return view('admin.penangkar.index', $data);
    }
    public function getAll()
    {
        $Penangkar = Penangkar::select(['id', 'id_user', 'nama', 'alamat', 'jumlah_anggota', 'jenis', 'luas_lahan', 'latitude', 'longitude', 'created_at', 'updated_at', 'is_verified', 'phone'])->with(['user'])->orderByDesc('id')->get();

        return response()->json($Penangkar);
    }
    public function getPenangkarsDataTable(Request $request)
    {
        $Penangkar = Penangkar::select(['id', 'id_user', 'nama', 'alamat', 'jumlah_anggota', 'jenis', 'luas_lahan', 'latitude', 'longitude', 'created_at', 'updated_at', 'is_verified', 'phone'])->with(['user'])->orderByDesc('id');

        if ($request->filled('verifikasi')) {
            $verifikasi = $request->input('verifikasi');
            if ($verifikasi == 'true') {
                $Penangkar->where('is_verified', 1);
            } elseif ($verifikasi == 'false') {
                $Penangkar->where('is_verified', 0);
            }
        }
        return Datatables::of($Penangkar)
            ->addColumn('action', function ($Penangkar) {
                return view('admin.penangkar.components.actions', compact('Penangkar'));
            })
            ->addColumn('verifikasi', function ($Penangkar) {
                return view('admin.penangkar.components.verifikasi', compact('Penangkar'));
            })
            ->addColumn('verifikasi_text', function ($Penangkar) {
                return $Penangkar->is_verified == 1 ? 'Terverifikasi' : 'Pending';
            })
            ->addColumn('tanggal', function ($Penangkar) {
                return $Penangkar->created_at->format('d M Y');
            })
            ->addColumn('koordinat', function ($Penangkar) {
                $latitude = $Penangkar->latitude;
                $longitude = $Penangkar->longitude;
                $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query=$latitude,$longitude";
                return '<a href="' . $googleMapsUrl . '" target="__blank">' . $latitude . ', ' . $longitude . '</a>';
            })
            ->addColumn('koordinat', function ($Penangkar) {
                $latitude = $Penangkar->latitude;
                $longitude = $Penangkar->longitude;
                $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query=$latitude,$longitude";
                return '<a href="' . $googleMapsUrl . '" target="__blank">' . $latitude . ', ' . $longitude . '</a>';
            })

            ->rawColumns(['action', 'koordinat', 'verifikasi', 'tanggal', 'verifikasi_text'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_user' => 'required',
            'alamat' => 'string|max:255',
            'jenis' => 'string|max:255',
            'jumlah_anggota' => 'string|max:255',
            'luas_lahan' => 'string|max:255',
            'latitude' => 'string|max:255',
            'longitude' => 'string|max:255',
            'nama_anggota.*' => 'nullable|string',
            'luas_lahan_anggota.*' => 'nullable|numeric|min:1',
        ]);

        $DesaData = [
            'nama' => $request->input('nama'),
            'id_user' => $request->input('id_user'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
            'jenis' => $request->input('jenis'),
            'jumlah_anggota' => $request->input('jumlah_anggota'),
            'luas_lahan' => $request->input('luas_lahan'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ];

        if ($request->filled('id')) {
            $Desa = Penangkar::find($request->input('id'));
            if (!$Desa) {
                return response()->json(['message' => 'Penangkar not found'], 404);
            }

            $Desa->update($DesaData);
            $message = 'Penangkar updated successfully';
            // return response()->json(['message' => $message]);
            return redirect()->back()->with('success', $message);
        } else {
            $penangkar = Penangkar::create($DesaData);

            $nama_penangkars = $request->input('nama_anggota');
            $luas_lahans = $request->input('luas_lahan_anggota');

            if ($nama_penangkars && $luas_lahans) {
                foreach ($nama_penangkars as $key => $name) {
                    $PenangkarAnggota = new PenangkarAnggota();
                    $PenangkarAnggota->id_penangkar = $penangkar->id; // Menggunakan variabel $penangkar untuk mendapatkan ID baru
                    $PenangkarAnggota->nama_anggota = $name;
                    $PenangkarAnggota->luas_lahan = isset($luas_lahans[$key]) ? $luas_lahans[$key] : null;
                    $PenangkarAnggota->save();
                }
            }
            return redirect()->back()->with('success', 'Berhasil melakukan pendaftaran penangkar..');
        }
    }
    public function destroy($id)
    {
        $Desas = Penangkar::find($id);

        if (!$Desas) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        $Desas->delete();

        return response()->json(['message' => 'Desa deleted successfully']);
    }
    public function edit($id)
    {
        $Penangkar = Penangkar::with('user')->find($id);

        if (!$Penangkar) {
            return response()->json(['message' => 'Penangkar not found'], 404);
        }

        return response()->json($Penangkar);
    }
    public function detail($id)
    {
        $Penangkar = Penangkar::with('user')->find($id);

        if (!$Penangkar) {
            return response()->json(['message' => 'Penangkar not found'], 404);
        }

        return response()->json($Penangkar);
    }
    public function verifikasi($id)
    {
        $Penangkar = Penangkar::with('user')->find($id);
        if (!$Penangkar) {
            return response()->json(['message' => 'Penangkar not found'], 404);
        }
        $Penangkar->update(['is_verified' => 1]);

        return response()->json($Penangkar);
    }
}
