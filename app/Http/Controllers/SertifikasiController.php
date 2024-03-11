<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
use App\Models\Sertifikasi;
use App\Models\SertifikasiPendahuluan;
use App\Models\SertifikasiVegetatif;
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
                $penangkar = Penangkar::where('id_user', $Sertifikasi->id_user)->first();
                $pendahuluan = SertifikasiPendahuluan::where('id_sertifikasi', $Sertifikasi->id)->first();
                return view('admin.sertifikasi.components.actions', compact(['Sertifikasi', 'penangkar', 'pendahuluan']));
            })
            ->addColumn('identitas', function ($Sertifikasi) {
                $penangkar = Penangkar::where('id_user', $Sertifikasi->id_user)->first();
                return '<strong>Penangkaran : </strong>' . $penangkar->nama . '<br><strong>Ketua : </strong>' . $Sertifikasi->user->name;
            })
            ->addColumn('tanaman', function ($Sertifikasi) {
                return view('admin.sertifikasi.components.tanaman', compact('Sertifikasi'));
            })
            ->addColumn('status', function ($Sertifikasi) {
                return '<span class="badge bg-label-info">' . $Sertifikasi->status . '</span>';
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
    public function fase_pendahuluan_store(Request $request)
    {
        $request->validate([
            'id_sertifikasi' => 'required|exists:sertifikasis,id',
            'tanaman_utara' => 'required|string',
            'tanaman_selatan' => 'required|string',
            'tanaman_timur' => 'required|string',
            'tanaman_barat' => 'required|string',
            'bekas_bero' => 'required|string',
            'bekas_tanam' => 'required|string',
            'kesimpulan' => 'required|string',
            'catatan' => 'nullable|string',
            'id_varietas_sebelumnya' => 'required|exists:varietas,id',
            'id_kelas_benih_sebelumnya' => 'required|exists:kelas_benihs,id',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);
        $FasePendahuluanData = $request->all();

        if ($request->filled('id')) {
            $SertifikasiPendahuluan = SertifikasiPendahuluan::find($request->input('id'));
            if (!$SertifikasiPendahuluan) {
                return response()->json(['message' => 'fase pendahuluan not found'], 404);
            }

            $SertifikasiPendahuluan->update($FasePendahuluanData);
            $message = 'Fase pendahuluan berhasil diupdate..';
            return response()->json(['message' => $message]);
        } else {
            SertifikasiPendahuluan::create($FasePendahuluanData);
            $message = 'Fase pendahuluan berhasil diinput..';
            return response()->json(['message' => $message]);
        }
    }

    public function fase_vegetatif_store(Request $request)
    {
        $request->validate([
            'id_sertifikasi' => 'required|exists:sertifikasis,id',
            'sesuai_varietas' => 'required|string',
            'hama_penyakit' => 'required|string',
            'kemurnian' => 'required|string',
            'pemeriksaan' => 'required|string',
            'keadaan_rumput' => 'required|string',
            'taksiran_hasil' => 'nullable|numeric',
            'kesimpulan' => 'required|string',
            'no' => ['required', 'array'],
            'jumlah' => ['required', 'array'],
            'no.*' => ['required', 'numeric'],
            'jumlah.*' => ['required', 'numeric'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        // Menghapus id dari data yang dikumpulkan
        $FaseVegetatifData = $request->all();
        $campuranVarietas = [];

        // Mendapatkan nilai array 'no' dan 'jumlah' dari request
        $nos = $request->input('no');
        $jumlahs = $request->input('jumlah');

        // Memeriksa apakah kedua array memiliki panjang yang sama
        if (count($nos) === count($jumlahs)) {
            // Melakukan iterasi melalui elemen-elemen array 'no' dan 'jumlah'
            foreach ($nos as $key => $no) {
                // Mengonversi nilai 'no' dan 'jumlah' menjadi integer
                $no = (int) $no;
                $jumlah = (int) $jumlahs[$key];

                // Menggabungkan nilai 'no' dan 'jumlah' ke dalam satu array asosiatif
                $item = [
                    'no' => $no,
                    'jumlah' => $jumlah
                ];
                // Menambahkan array asosiatif ini ke dalam array campuranVarietas
                $campuranVarietas[] = $item;
            }
        }

        // Mengubah array campuranVarietas menjadi format JSON
        $FaseVegetatifData['campuran_varietas'] = json_encode($campuranVarietas);


        if ($request->filled('id')) {
            $SertifikasiVegetatif = SertifikasiVegetatif::find($request->input('id'));
            if (!$SertifikasiVegetatif) {
                return response()->json(['message' => 'fase vegetatif not found'], 404);
            }

            $SertifikasiVegetatif->update($FaseVegetatifData);
            $message = 'Fase vegetatif berhasil diupdate..';
        } else {
            SertifikasiVegetatif::create($FaseVegetatifData);
            $message = 'Fase vegetatif berhasil diinput..';
        }
        return response()->json(['message' => $message]);
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
