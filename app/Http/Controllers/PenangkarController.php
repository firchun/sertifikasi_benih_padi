<?php

namespace App\Http\Controllers;

use App\Models\Penangkar;
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
    public function getPenangkarsDataTable()
    {
        $Penangkar = Penangkar::select(['id', 'id_user', 'nama', 'alamat', 'jumlah_anggota', 'jenis', 'luas_lahan', 'latitude', 'longitude', 'created_at', 'updated_at'])->with(['user'])->orderByDesc('id');

        return Datatables::of($Penangkar)
            ->addColumn('action', function ($Penangkar) {
                return view('admin.penangkar.components.actions', compact('Penangkar'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_kecamatan' => 'string|max:255',
            'description' => 'string|max:255',
        ]);

        $DesaData = [
            'name' => $request->input('name'),
            'id_kecamatan' => $request->input('id_kecamatan'),
            'description' => $request->input('description'),
        ];

        if ($request->filled('id')) {
            $Desa = Desa::find($request->input('id'));
            if (!$Desa) {
                return response()->json(['message' => 'Desa not found'], 404);
            }

            $Desa->update($DesaData);
            $message = 'Desa updated successfully';
        } else {
            Desa::create($DesaData);
            $message = 'Desa created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Desas = Desa::find($id);

        if (!$Desas) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        $Desas->delete();

        return response()->json(['message' => 'Desa deleted successfully']);
    }
    public function edit($id)
    {
        $Desa = Desa::find($id);

        if (!$Desa) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        return response()->json($Desa);
    }
}
