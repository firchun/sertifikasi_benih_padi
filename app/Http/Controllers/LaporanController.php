<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan_sertifikasi()
    {
        $data = [
            'title' => 'Data Laporan Sertifikasi Benih'
        ];
        return view('admin.laporan.sertifikasi', $data);
    }
    public function laporan_penangkaran()
    {
        $data = [
            'title' => 'Data Laporan Penangkaran Benih'
        ];
        return view('admin.laporan.penangkaran', $data);
    }
    public function laporan_stok()
    {
        $data = [
            'title' => 'Data Laporan Stok Benih tersertifikasi'
        ];
        return view('admin.laporan.stok', $data);
    }
}
