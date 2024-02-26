<?php

namespace App\Http\Controllers;

use App\Models\varietas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class VarietasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Varietas',
        ];
        return view('admin.varietas.index', $data);
    }
    public function getall()
    {
        $varietas = Varietas::select([
            'id',
            'name',
            'description',
            'umur',
            'potensi_hasil',
            'ketahanan_hama',
            'ketahanan_penyakit',
            'ketahanan_abiotik',
            'anjuran_tanam',
            'created_at',
            'updated_at'
        ])
            ->when(request()->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);

        return response()->json($varietas);
    }
    public function getVarietasDataTable()
    {
        $varietas = varietas::select([
            'id',
            'name',
            'description',
            'umur',
            'potensi_hasil',
            'ketahanan_hama',
            'ketahanan_penyakit',
            'ketahanan_abiotik',
            'anjuran_tanam',
            'created_at',
            'updated_at'
        ])->orderByDesc('id');

        return Datatables::of($varietas)
            ->addColumn('action', function ($varietas) {
                return view('admin.varietas.components.actions', compact('varietas'));
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

        $varietasData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'umur' => $request->input('umur'),
            'potensi_hasil' => $request->input('potensi_hasil'),
            'ketahanan_hama' => $request->input('ketahanan_hama'),
            'ketahanan_abiotik' => $request->input('ketahanan_abiotik'),
            'ketahanan_penyakit' => $request->input('ketahanan_penyakit'),
            'anjuran_tanam' => $request->input('anjuran_tanam'),
        ];

        if ($request->filled('id')) {
            $varietas = varietas::find($request->input('id'));
            if (!$varietas) {
                return response()->json(['message' => 'varietas not found'], 404);
            }

            $varietas->update($varietasData);
            $message = 'varietas updated successfully';
        } else {
            varietas::create($varietasData);
            $message = 'varietas created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $varietass = varietas::find($id);

        if (!$varietass) {
            return response()->json(['message' => 'varietas not found'], 404);
        }

        $varietass->delete();

        return response()->json(['message' => 'varietas deleted successfully']);
    }
    public function edit($id)
    {
        $varietas = varietas::find($id);

        if (!$varietas) {
            return response()->json(['message' => 'varietas not found'], 404);
        }

        return response()->json($varietas);
    }
}
