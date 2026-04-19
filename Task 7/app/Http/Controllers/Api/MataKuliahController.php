<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();

        return response()->json($mataKuliah);
    }

    public function show($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        return response()->json($mataKuliah);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliahs,kode',
            'nama' => 'required|min:3',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $mataKuliah = MataKuliah::create($request->all());

        return response()->json($mataKuliah, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliahs,kode,'.$id,
            'nama' => 'required|min:3',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->update($request->all());

        return response()->json($mataKuliah);
    }

    public function destroy($id)
    {
        MataKuliah::findOrFail($id)->delete();

        return response()->json(['message' => 'Mata kuliah berhasil dihapus']);
    }
}
