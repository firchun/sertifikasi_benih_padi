<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SertifikasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Sertifikasi Benih'
        ];
        return view('admin.sertifikasi.index', $data);
    }
    public function pengajuan()
    {
        $data = [
            'title' => 'Pengajuan Sertifikasi Benih Padi'
        ];
        return view('admin.sertifikasi.pengajuan', $data);
    }
    public function getData()
    {
        $sertifikasi = Sertifikasi::where('id_user', auth()->user()->id)
            ->with(['desa', 'kecamatan', 'kelas_benih_sebelumnya', 'kelas_benih_asal', 'varietas', 'varietas_sebelumnya', 'user'])
            ->get();

        return response()->json(['data' => $sertifikasi]);
    }
    public function getSertifikasisDataTable()
    {
        $Sertifikasi = Sertifikasi::with(['desa', 'kecamatan', 'kelas_benih_sebelumnya', 'kelas_benih_asal', 'varietas', 'varietas_sebelumnya', 'user'])->orderByDesc('id');

        return Datatables::of($Sertifikasi)
            ->addColumn('action', function ($Sertifikasi) {
                return view('admin.sertifikasi.components.actions', compact('Sertifikasi'));
            })
            ->addColumn('tanaman', function ($Sertifikasi) {
                return view('admin.sertifikasi.components.tanaman', compact('Sertifikasi'));
            })
            ->addColumn('status', function ($Sertifikasi) {
                return '<span class="badge bg-label-info">' . $Sertifikasi->status . '</span>';
            })
            ->addColumn('identitas', function ($Sertifikasi) {
                return '<strong>Ketua : ' . $Sertifikasi->user->name . '</strong>';
            })
            ->rawColumns(['action', 'status', 'tanaman', 'identitas'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'komoditas' => 'required|string',
            'id_user' => 'required|string',
            'alamat' => 'required|string',
            'luas_pertanaman' => 'required',
            'id_varietas' => 'required|exists:varietas,id',
            'tanggal_sebar' => 'required|date',
            'tanggal_tanam' => 'required|date',
            'blok' => 'required|string',
            'id_desa' => 'required|exists:desas,id',
            'id_kecamatan' => 'required|exists:kecamatans,id',
            'jenis_tanaman_sebelumnya' => 'required|string',
            'tanggal_panen_sebelumnya' => 'nullable|date',
            'pemeriksaan_lapangan_sebelumnya' => 'nullable|string',
            'id_varietas_sebelumnya' => 'required|exists:varietas,id',
            'id_kelas_benih_sebelumnya' => 'required|exists:kelas_benihs,id',
            'disertifikasi_sebelumnya' => 'required|in:Ya,Tidak',
            'produsen_asal' => 'required|string',
            'benih_asal' => 'required|string',
            'id_kelas_benih_asal' => 'required|exists:kelas_benihs,id',
            'no_kelompok_benih' => 'required|string',
            'jumlah_benih' => 'required|numeric',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);
        $SertifikasiData = $request->all();

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $SertifikasiData = $request->all();

        if ($request->filled('id')) {
            $Sertifikasi = Sertifikasi::find($request->input('id'));
            if (!$Sertifikasi) {
                return response()->json(['message' => 'Sertifikasi not found'], 404);
            }

            $Sertifikasi->update($SertifikasiData);
            $message = 'Sertifikasi updated successfully';
            return response()->json(['message' => $message]);
        } else {
            Sertifikasi::create($SertifikasiData);
            $message = 'Sertifikasi berhasil diajukan..';
            if (Auth::user()->role = 'Penangkar') {
                return redirect()->to('/home')->with('success', $message)->withInput();
            } else {
                return response()->json(['message' => $message]);
            }
        }
    }
    public function terima($id)
    {
        $sertifikasi = Sertifikasi::find($id);

        if (!$sertifikasi) {
            return response()->json(['message' => 'Sertifikasi not found'], 404);
        }
        $sertifikasi->update(['status' => 'Permohonan diterima']);

        $message = 'Permohonan berhasil diterima';

        return response()->json(['message' => $message]);
    }
    public function tolak($id)
    {
        $sertifikasi = Sertifikasi::find($id);

        if (!$sertifikasi) {
            return response()->json(['message' => 'Sertifikasi not found'], 404);
        }
        $sertifikasi->update(['status' => 'Permohonan ditolak']);

        $message = 'Permohonan berhasil ditolak';

        return response()->json(['message' => $message]);
    }
}
