<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(){
        // Simulasi data dari database 
        $data_makul = [ 
            ['kode' => 'TI101', 'nama' => 'Algoritma Pemrograman', 'sks' => 3], 
            ['kode' => 'TI102', 'nama' => 'Basis Data', 'sks' => 4], 
        ]; 
        
        // Mengirim data ke view 'matakuliah.index' 
        return view('matakuliah.index', compact('data_makul'));
    }
}
