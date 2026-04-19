<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.index');
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function edit($id)
    {
        return view('mahasiswa.edit', ['mahasiswaId' => $id]);
    }
}
