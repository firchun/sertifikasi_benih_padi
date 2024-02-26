<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

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
        $Testimoni = Testimoni::all();
        return response()->json($Testimoni);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'sebagai' => 'string|max:255',
            'testimoni' => 'string',
        ]);

        $TestimoniData = [
            'nama' => $request->input('nama'),
            'sebagai' => $request->input('sebagai'),
            'testimoni' => $request->input('testimoni'),
        ];

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
