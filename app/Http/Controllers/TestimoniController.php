<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TestimoniController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data testimoni',
        ];
        return view('admin.testimoni.index', $data);
    }
    public function getall()
    {
        $Testimoni = Testimoni::all()->map(function ($testimoni) {
            $testimoni['imgsrc'] = Storage::url($testimoni->image);
            return $testimoni;
        });

        return response()->json($Testimoni);
    }
    public function getTestimoniDataTable()
    {
        $Testimoni = Testimoni::select(['id', 'nama', 'testimoni', 'sebagai', 'created_at', 'updated_at'])->orderByDesc('id');

        return DataTables::of($Testimoni)
            ->addColumn('action', function ($Testimoni) {
                return view('admin.testimoni.components.actions', compact('Testimoni'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'sebagai' => 'string|max:255',
            'testimoni' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // tambahkan validasi untuk file gambar
        ]);




        $TestimoniData = [
            'nama' => $request->input('nama'),
            'sebagai' => $request->input('sebagai'),
            'testimoni' => $request->input('testimoni'),
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $imagePath =  $image->storeAs('public/images', $imageName);

            $TestimoniData['image'] = $imagePath;
        }

        if ($request->filled('id')) {
            $Testimoni = Testimoni::find($request->input('id'));
            if (!$Testimoni) {
                return response()->json(['message' => 'Testimoni not found'], 404);
            }

            $Testimoni->update($TestimoniData);
            $message = 'Testimoni updated successfully';
        } else {
            Testimoni::create($TestimoniData);
            $message = 'Testimoni Berhasil dikirim..';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $Testimonis = Testimoni::find($id);

        if (!$Testimonis) {
            return response()->json(['message' => 'Testimoni not found'], 404);
        }

        $Testimonis->delete();

        return response()->json(['message' => 'Testimoni deleted successfully']);
    }
}
