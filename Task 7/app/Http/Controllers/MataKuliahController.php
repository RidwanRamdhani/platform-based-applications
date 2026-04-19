<?php

namespace App\Http\Controllers;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('matakuliah.index');
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function edit($id)
    {
        return view('matakuliah.edit', ['matakuliahId' => $id]);
    }
}
