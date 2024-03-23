<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Desa',
        ];
        return view('admin.desa.index', $data);
    }
    public function getall()
    {
        $Desa = Desa::select(['id', 'name', 'id_kecamatan', 'description', 'created_at', 'updated_at'])->with(['kecamatan'])->orderBy('name')->get();

        return response()->json($Desa);
    }
    public function getDesaDataTable()
    {
        $Desa = Desa::select(['id', 'name', 'id_kecamatan', 'description', 'created_at', 'updated_at'])->with(['kecamatan'])->orderByDesc('id');

        return Datatables::of($Desa)
            ->addColumn('action', function ($Desa) {
                return view('admin.desa.components.actions', compact('Desa'));
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
