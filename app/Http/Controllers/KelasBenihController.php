<?php

namespace App\Http\Controllers;

use App\Models\kelasBenih;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasBenihController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kelas Benih',
        ];
        return view('admin.kelas_benih.index', $data);
    }
    public function getKelasBenihDataTable()
    {
        $kelasBenih = kelasBenih::select(['id', 'name', 'description', 'created_at', 'updated_at'])->orderByDesc('id');

        return Datatables::of($kelasBenih)
            ->addColumn('action', function ($kelasBenih) {
                return view('admin.kelas_benih.components.actions', compact('kelasBenih'));
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

        $KelasBenihData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];

        if ($request->filled('id')) {
            $KelasBenih = KelasBenih::find($request->input('id'));
            if (!$KelasBenih) {
                return response()->json(['message' => 'kelas benih not found'], 404);
            }

            $KelasBenih->update($KelasBenihData);
            $message = 'Kelas Benih updated successfully';
        } else {
            KelasBenih::create($KelasBenihData);
            $message = 'Kelas Benih created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $KelasBenihs = KelasBenih::find($id);

        if (!$KelasBenihs) {
            return response()->json(['message' => 'Kelas Benih not found'], 404);
        }

        $KelasBenihs->delete();

        return response()->json(['message' => 'Kelas Benih deleted successfully']);
    }
    public function edit($id)
    {
        $KelasBenih = KelasBenih::find($id);

        if (!$KelasBenih) {
            return response()->json(['message' => 'Kelas Benih not found'], 404);
        }

        return response()->json($KelasBenih);
    }
}
