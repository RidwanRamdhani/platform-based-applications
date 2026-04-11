@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-primary">Daftar Mahasiswa Aktif</h5>
        <button class="btn btn-primary btn-sm">+ Tambah Data</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%" class="text-center">NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Jurusan</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_mhs as $mhs)
                    <tr>
                        <td class="text-center align-middle">{{ $mhs['nim'] }}</td>
                        <td class="align-middle">{{ $mhs['nama'] }}</td>
                        <td class="align-middle">{{ $mhs['jurusan'] }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info text-white">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection