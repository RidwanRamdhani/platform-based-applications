@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 fw-bold text-primary">Dashboard</h2>
    
    <div class="row g-4">
        <!-- Card Mahasiswa -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Total Mahasiswa</h5>
                    <h2 class="fw-bold text-primary">{{ $summary['total_mahasiswa'] }}</h2>
                    <a href="/mahasiswa" class="btn btn-outline-primary btn-sm mt-3">Lihat Detail →</a>
                </div>
            </div>
        </div>
        
        <!-- Card Dosen -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Total Dosen</h5>
                    <h2 class="fw-bold text-success">{{ $summary['total_dosen'] }}</h2>
                    <a href="/dosen" class="btn btn-outline-success btn-sm mt-3">Lihat Detail →</a>
                </div>
            </div>
        </div>
        
        <!-- Card Mata Kuliah -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Total Mata Kuliah</h5>
                    <h2 class="fw-bold text-warning">{{ $summary['total_makul'] }}</h2>
                    <a href="/matakuliah" class="btn btn-outline-warning btn-sm mt-3">Lihat Detail →</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Welcome Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title fw-bold">Selamat Datang di SIAKAD Universitas</h4>
                    <p class="card-text text-muted">Sistem Informasi Akademik untuk mengelola data mahasiswa, dosen, dan mata kuliah.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
