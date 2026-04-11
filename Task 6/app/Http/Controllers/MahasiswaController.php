<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $data_mhs = Mahasiswa::all();
        
        // Mengirim data ke view 'mahasiswa.index' 
        return view('mahasiswa.index', compact('data_mhs'));
    }

    public function create(){
        return view('mahasiswa.create');
    }

    public function store(Request $request){
        $request->validate([
            'nim' => 'required|unique:mahasiswas', // harus diisi
            'nama' => 'required|min:3',  // min 3 char
            'jurusan' => 'nullable', // opsional
        ]);

        Mahasiswa::create($request->all());
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit($id){
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nim' => 'required|unique:mahasiswas', // harus diisi
            'nama' => 'requrired|min:3',  // min 3 char
            'jurusan' => 'nullable', // opsional
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function destroy($id){
        Mahasiswa::findOrFail($id)->delete();
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
