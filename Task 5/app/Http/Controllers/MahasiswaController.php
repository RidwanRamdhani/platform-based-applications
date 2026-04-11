<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        // Simulasi data dari database 
        $data_mhs = [ ['nim' => '1011001', 'nama' => 'Faliq Rafi', 'jurusan' => 'Teknik Informatika'], ['nim' => '1011002', 'nama' => 'Budi Santoso', 'jurusan' => 'Sistem Informasi'], ]; 
        
        // Mengirim data ke view 'mahasiswa.index' 
        return view('mahasiswa.index', compact('data_mhs'));
    }
}
