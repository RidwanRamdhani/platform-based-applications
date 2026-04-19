<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Simulasi data ringkasan
        $summary = [
            'total_mahasiswa' => 1250,
            'total_dosen' => 85,
            'total_makul' => 120,
        ];
        
        // Mengirim data ke view 'dashboard.index'
        return view('dashboard.index', compact('summary'));
    }
}
