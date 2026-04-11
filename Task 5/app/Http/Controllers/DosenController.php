<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(){
        // Simulasi data dari database 
        $data_dosen = [ 
            ['nidn' => '0011001', 'nama' => 'Dr. Ahmad Fauzi', 'prodi' => 'Teknik Informatika'], 
            ['nidn' => '0011002', 'nama' => 'Siti Nurhaliza, M.Kom', 'prodi' => 'Sistem Informasi'], 
        ]; 
        
        // Mengirim data ke view 'dosen.index' 
        return view('dosen.index', compact('data_dosen'));
    }
}
