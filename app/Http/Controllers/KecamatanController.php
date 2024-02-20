<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kecamatan',
        ];
        return view('admin.kecamatan.index', $data);
    }
    public function getAll()
    {
        $kecamatan = Kecamatan::all();
        return response()->json($kecamatan);
    }
    public function getKecamatanDataTable()
    {
        $Kecamatan = Kecamatan::select(['id', 'name', 'description', 'created_at', 'updated_at'])->orderByDesc('id');

        return Datatables::of($Kecamatan)
            ->addColumn('action', function ($Kecamatan) {
                return view('admin.kecamatan.components.actions', compact('Kecamatan'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
        ]);

        $KecamatanData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];

        if ($request->filled('id')) {
            $Kecamatan = Kecamatan::find($request->input('id'));
            if (!$Kecamatan) {
                return response()->json(['message' => 'Kecamatan not found'], 404);
            }

            $Kecamatan->update($KecamatanData);
            $message = 'Kecamatan updated successfully';
        } else {
            Kecamatan::create($KecamatanData);
            $message = 'Kecamatan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Kecamatans = Kecamatan::find($id);

        if (!$Kecamatans) {
            return response()->json(['message' => 'Kecamatan not found'], 404);
        }

        $Kecamatans->delete();

        return response()->json(['message' => 'Kecamatan deleted successfully']);
    }
    public function edit($id)
    {
        $Kecamatan = Kecamatan::find($id);

        if (!$Kecamatan) {
            return response()->json(['message' => 'Kecamatan not found'], 404);
        }

        return response()->json($Kecamatan);
    }
}
