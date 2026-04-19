<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data_mhs = Mahasiswa::all();

        return response()->json($data_mhs);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return response()->json($mahasiswa);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|min:3',
            'jurusan' => 'nullable',
        ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json($mahasiswa, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,'.$id,
            'nama' => 'required|min:3',
            'jurusan' => 'nullable',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return response()->json($mahasiswa);
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();

        return response()->json(['message' => 'Mahasiswa berhasil dihapus']);
    }
}
