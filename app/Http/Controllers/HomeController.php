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
}
