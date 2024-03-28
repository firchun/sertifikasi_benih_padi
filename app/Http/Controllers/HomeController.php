<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Sertifikasi;
use App\Models\SertifikasiLab;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\varietas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'penangkars' => User::where('role', 'Penangkar')->count(),
            'varietas' => varietas::count(),
            'Kecamatan' => Kecamatan::count(),
            'Desa' => Desa::count(),
            'Sertifikasi' => Sertifikasi::count(),
            'terSertifikasi' => SertifikasiLab::where('kesimpulan', 'Lulus')->count(),
            'Testimoni' => Testimoni::count(),
        ];
        return view('admin.dashboard', $data);
    }
    public function chart()
    {
        // Ambil data sertifikasi dan sertifikasi lab dari database
        $sertifikasi = Sertifikasi::selectRaw('YEAR(tanggal_tanam) as tahun, COUNT(*) as jumlah')->groupBy('tahun')->get();
        $lulus = SertifikasiLab::selectRaw('YEAR(tanggal_panen) as tahun, COUNT(*) as jumlah')->groupBy('tahun')->get();

        // Susun data dalam format yang diinginkan
        $labels = [];
        $certifiedValues = [];
        $failedValues = [];
        $passedValues = []; // Data lulus

        // Inisialisasi array untuk setiap tahun
        foreach (range(date('Y') - 2, date('Y')) as $year) {
            $labels[] = strval($year);
            $certifiedValues[$year] = 0;
            $failedValues[$year] = 0;
            $passedValues[$year] = 0; // Inisialisasi data lulus
        }

        // Isi data sertifikasi
        foreach ($sertifikasi as $sert) {
            $certifiedValues[$sert->tahun] = $sert->jumlah;
        }

        // Isi data sertifikasi lab (gagal)
        foreach ($lulus as $lul) {
            $failedValues[$lul->tahun] = $lul->jumlah;
        }

        // Hitung data lulus sebagai selisih antara sertifikasi dan gagal
        foreach ($certifiedValues as $tahun => $jumlahSertifikasi) {
            $jumlahGagal = isset($failedValues[$tahun]) ? $failedValues[$tahun] : 0;
            $passedValues[$tahun] = $jumlahSertifikasi - $jumlahGagal;
        }

        // Ambil nilai dari array asosiatif
        $certifiedValues = array_values($certifiedValues);
        $failedValues = array_values($failedValues);
        $passedValues = array_values($passedValues); // Ambil nilai data lulus

        // Format data sesuai kebutuhan
        $newData = [
            'labels' => $labels,
            'certified' => $certifiedValues,
            'failed' => $failedValues,
            'passed' => $passedValues, // Sertakan data lulus dalam respons
        ];

        return response()->json($newData);
    }
}
