<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
use App\Models\Sertifikasi;
use App\Models\SertifikasiBerbunga;
use App\Models\SertifikasiLab;
use App\Models\SertifikasiMasak;
use App\Models\SertifikasiPanen;
use App\Models\SertifikasiPendahuluan;
use App\Models\SertifikasiVegetatif;
use App\Models\StokBenih;
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
            ->with(['desa', 'kecamatan', 'kelas_benih_sebelumnya', 'kelas_benih_asal', 'varietas', 'varietas_sebelumnya', 'user', 'vegetatif', 'uji_lab'])
            ->get();

        foreach ($sertifikasi as $item) {
            $item->jumlahStok = StokBenih::getSertifikasi($item->id); // Panggil fungsi getSertifikasi untuk setiap item
        }
        return response()->json(['data' => $sertifikasi]);
    }
    public function getSertifikasisDataTable()
    {
        $Sertifikasi = Sertifikasi::with(['desa', 'kecamatan', 'kelas_benih_sebelumnya', 'kelas_benih_asal', 'varietas', 'varietas_sebelumnya', 'user'])->orderByDesc('id');

        return Datatables::of($Sertifikasi)
            ->addColumn('action', function ($Sertifikasi) {
                $penangkar = Penangkar::where('id_user', $Sertifikasi->id_user)->first();
                $pendahuluan = SertifikasiPendahuluan::where('id_sertifikasi', $Sertifikasi->id)->first();
                $vegetatif = SertifikasiVegetatif::where('id_sertifikasi', $Sertifikasi->id)->first();
                $masak = SertifikasiMasak::where('id_sertifikasi', $Sertifikasi->id)->first();
                $berbunga = SertifikasiBerbunga::where('id_sertifikasi', $Sertifikasi->id)->first();
                $panen = SertifikasiPanen::where('id_sertifikasi', $Sertifikasi->id)->first();
                $uji_lab = SertifikasiLab::where('id_sertifikasi', $Sertifikasi->id)->first();
                return view('admin.sertifikasi.components.actions', compact(['Sertifikasi', 'penangkar', 'pendahuluan', 'vegetatif', 'masak', 'berbunga', 'panen', 'uji_lab']));
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
            'id_kelas_benih' => 'required|exists:kelas_benihs,id',
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
            $sertifikasiData['status'] = 'Proses Permohonan Sertifikasi';
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
            if ($request->kesimpulan == 'Memenuhi') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Memenuhi syarat areal sertifikasi']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Tidak memenuhi syarat areal sertifikasi']);
            }

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
            'no.*' => ['required', 'numeric'],
            'jumlah.*' => ['required', 'numeric'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        // Menghapus id dari data yang dikumpulkan
        $FaseVegetatifData = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'sesuai_varietas' => $request->input('sesuai_varietas'),
            'hama_penyakit' => $request->input('hama_penyakit'),
            'kemurnian' => $request->input('kemurnian'),
            'pemeriksaan' => $request->input('pemeriksaan'),
            'keadaan_rumput' => $request->input('keadaan_rumput'),
            'taksiran_hasil' => $request->input('taksiran_hasil'),
            'kesimpulan' => $request->input('kesimpulan'),
        ];

        $campuranVarietas = [];

        // Mendapatkan nilai array 'no' dan 'jumlah' dari request
        if ($request->has('no')) {

            $nos =  $request->input('no');
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
        }



        if ($request->filled('id')) {
            $SertifikasiVegetatif = SertifikasiVegetatif::find($request->input('id'));
            if (!$SertifikasiVegetatif) {
                return response()->json(['message' => 'fase vegetatif not found'], 404);
            }

            $SertifikasiVegetatif->update($FaseVegetatifData);
            $message = 'Fase vegetatif berhasil diupdate..';
        } else {
            SertifikasiVegetatif::create($FaseVegetatifData);
            if ($request->kesimpulan == 'Lulus') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Lulus Fase Vegetatif']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Gagal Fase Vegetatif']);
            }
            $message = 'Fase vegetatif berhasil diinput..';
        }
        return response()->json(['message' => $message]);
    }
    public function fase_berbunga_store(Request $request)
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
            'no.*' => ['required', 'numeric'],
            'jumlah.*' => ['required', 'numeric'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        // Menghapus id dari data yang dikumpulkan
        $FaseBerbungaData = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'sesuai_varietas' => $request->input('sesuai_varietas'),
            'hama_penyakit' => $request->input('hama_penyakit'),
            'kemurnian' => $request->input('kemurnian'),
            'pemeriksaan' => $request->input('pemeriksaan'),
            'keadaan_rumput' => $request->input('keadaan_rumput'),
            'taksiran_hasil' => $request->input('taksiran_hasil'),
            'kesimpulan' => $request->input('kesimpulan'),
        ];

        $campuranVarietas = [];

        // Mendapatkan nilai array 'no' dan 'jumlah' dari request
        if ($request->has('no')) {

            $nos =  $request->input('no');
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
            $FaseBerbungaData['campuran_varietas'] = json_encode($campuranVarietas);
        }



        if ($request->filled('id')) {
            $SertifikasiBerbunga = SertifikasiBerbunga::find($request->input('id'));
            if (!$SertifikasiBerbunga) {
                return response()->json(['message' => 'fase Berbunga not found'], 404);
            }

            $SertifikasiBerbunga->update($FaseBerbungaData);
            $message = 'Fase Berbunga berhasil diupdate..';
        } else {
            SertifikasiBerbunga::create($FaseBerbungaData);
            if ($request->kesimpulan == 'Lulus') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Lulus Fase Berbunga']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Gagal Fase Berbunga']);
            }
            $message = 'Fase Berbunga berhasil diinput..';
        }
        return response()->json(['message' => $message]);
    }
    public function fase_masak_store(Request $request)
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
            'no.*' => ['required', 'numeric'],
            'jumlah.*' => ['required', 'numeric'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        // Menghapus id dari data yang dikumpulkan
        $FaseMasakData = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'sesuai_varietas' => $request->input('sesuai_varietas'),
            'hama_penyakit' => $request->input('hama_penyakit'),
            'kemurnian' => $request->input('kemurnian'),
            'pemeriksaan' => $request->input('pemeriksaan'),
            'keadaan_rumput' => $request->input('keadaan_rumput'),
            'taksiran_hasil' => $request->input('taksiran_hasil'),
            'kesimpulan' => $request->input('kesimpulan'),
        ];

        $campuranVarietas = [];

        // Mendapatkan nilai array 'no' dan 'jumlah' dari request
        if ($request->has('no')) {

            $nos =  $request->input('no');
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
            $FaseMasakData['campuran_varietas'] = json_encode($campuranVarietas);
        }



        if ($request->filled('id')) {
            $SertifikasiMasak = SertifikasiMasak::find($request->input('id'));
            if (!$SertifikasiMasak) {
                return response()->json(['message' => 'fase Masak not found'], 404);
            }

            $SertifikasiMasak->update($FaseMasakData);
            $message = 'Fase Masak berhasil diupdate..';
        } else {
            SertifikasiMasak::create($FaseMasakData);
            if ($request->kesimpulan == 'Lulus') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Lulus Fase Masak']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Gagal Fase Masak']);
            }
            $message = 'Fase Masak berhasil diinput..';
        }
        return response()->json(['message' => $message]);
    }
    public function fase_panen_store(Request $request)
    {
        $request->validate([
            'id_sertifikasi' => 'required|exists:sertifikasis,id',
            'luas_pemeriksaan' => 'required|string',
            'luas_panen' => 'required|string',
            'hasil_panen' => 'required|string',
            'campuran' => 'required|string',
            'kesimpulan' => 'required|string',
            'no.*' => ['required', 'numeric'],
            'jumlah.*' => ['required', 'numeric'],
            'jenis.*' => ['required', 'string'],
            'pemeriksaan.*' => ['required', 'string'],
            'keterangan.*' => ['required', 'string'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        // Menghapus id dari data yang dikumpulkan
        $PeralatanAlatPanen = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'luas_pemeriksaan' => $request->input('luas_pemeriksaan'),
            'luas_panen' => $request->input('luas_panen'),
            'hasil_panen' => $request->input('hasil_panen'),
            'campuran' => $request->input('campuran'),
            'kesimpulan' => $request->input('kesimpulan'),
        ];

        $alatPananen = [];

        // Mendapatkan nilai array 'no' dan 'jumlah' dari request
        if ($request->has('no')) {

            $nos =  $request->input('no');
            $jeniss = $request->input('jenis');
            $jumlahs = $request->input('jumlah');
            $pemeriksaans = $request->input('pemeriksaan');
            $keterangans = $request->input('keterangan');

            // Memeriksa apakah kedua array memiliki panjang yang sama
            if (count($nos) === count($jumlahs)) {
                // Melakukan iterasi melalui elemen-elemen array 'no' dan 'jumlah'
                foreach ($nos as $key => $no) {
                    // Mengonversi nilai 'no' dan 'jumlah' menjadi integer
                    $no = (int) $no;
                    $jumlah = (int) $jumlahs[$key];
                    $pemeriksaan =  $pemeriksaans[$key];
                    $keterangan = $keterangans[$key];
                    $jenis =  $jeniss[$key];

                    // Menggabungkan nilai 'no' dan 'jumlah' ke dalam satu array asosiatif
                    $item = [
                        'no' => $no,
                        'jumlah' => $jumlah,
                        'jenis' => $jenis,
                        'pemeriksaan' => $pemeriksaan,
                        'keterangan' => $keterangan,
                    ];
                    // Menambahkan array asosiatif ini ke dalam array alatPananen
                    $alatPananen[] = $item;
                }
            }
            // Mengubah array campuranVarietas menjadi format JSON
            $PeralatanAlatPanen['peralatan_panen'] = json_encode($alatPananen);
        }



        if ($request->filled('id')) {
            $SertifikasiPanen = SertifikasiPanen::find($request->input('id'));
            if (!$SertifikasiPanen) {
                return response()->json(['message' => 'Pemeriksaan alat panen not found'], 404);
            }

            $SertifikasiPanen->update($PeralatanAlatPanen);
            $message = 'Pemeriksaan alat panen berhasil diupdate..';
        } else {
            SertifikasiPanen::create($PeralatanAlatPanen);
            if ($request->kesimpulan == 'Lulus') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Lulus Pemeriksaan Peralatan Panen']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Gagal Pemeriksaan Peralatan Panen']);
            }
            $message = 'Pemeriksaan alat panen berhasil diinput..';
        }
        return response()->json(['message' => $message]);
    }
    public function uji_laboratorium(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_sertifikasi' => 'required|exists:sertifikasis,id',
            'nomor_induk' => 'required|string',
            'musim_tanam' => 'required|string',
            'nomor_kelompok' => 'required|string',
            'label' => 'required|string',
            'kesimpulan' => 'required|string',
            'tanggal_panen' => 'required|date',
            'tanggal_label' => 'required|date',
            'tanggal_selesai_pengujian' => 'required|date',
            'campuran_varietas_lain' => 'required|numeric',
            'volume' => 'required|numeric',
            'kadar_air' => 'required|numeric',
            'benih_murni' => 'required|numeric',
            'kotoran_benih' => 'required|numeric',
            'daya_berkecambah' => 'required|numeric',
            'kesehatan_benih' => 'required|numeric',
            'biji_gulma' => 'required|numeric',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal.',
        ]);

        // Collect the validated data into an array
        $UjiLaboratorium = [
            'id_sertifikasi' => $request->input('id_sertifikasi'),
            'nomor_induk' => $request->input('nomor_induk'),
            'musim_tanam' => $request->input('musim_tanam'),
            'nomor_kelompok' => $request->input('nomor_kelompok'),
            'tanggal_panen' => $request->input('tanggal_panen'),
            'tanggal_label' => $request->input('tanggal_label'),
            'tanggal_selesai_pengujian' => $request->input('tanggal_selesai_pengujian'),
            'campuran_varietas_lain' => $request->input('campuran_varietas_lain'),
            'volume' => $request->input('volume'),
            'kadar_air' => $request->input('kadar_air'),
            'benih_murni' => $request->input('benih_murni'),
            'kotoran_benih' => $request->input('kotoran_benih'),
            'daya_berkecambah' => $request->input('daya_berkecambah'),
            'kesehatan_benih' => $request->input('kesehatan_benih'),
            'biji_gulma' => $request->input('biji_gulma'),
            'label' => $request->input('label'),
            'kesimpulan' => $request->input('kesimpulan'),
        ];

        if ($request->filled('id')) {
            $SertifikasiLab = SertifikasiLab::find($request->input('id'));
            if (!$SertifikasiLab) {
                return response()->json(['message' => 'Pemeriksaan laboratorium not found'], 404);
            }

            $SertifikasiLab->update($UjiLaboratorium);
            $message = 'Pemeriksaan laboratorium berhasil diupdate..';
        } else {
            SertifikasiLab::create($UjiLaboratorium);
            if ($request->kesimpulan == 'Lulus') {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Lulus uji laboratorium']);
            } else {
                Sertifikasi::find($request->id_sertifikasi)->update(['status' => 'Gagal uji laboratorium']);
            }

            $message = 'Pemeriksaan laboratorium berhasil diinput..';
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
