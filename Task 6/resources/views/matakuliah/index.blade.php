@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-primary">Daftar Mata Kuliah</h5>
        <button class="btn btn-primary btn-sm">+ Tambah Data</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%" class="text-center">Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th width="10%" class="text-center">SKS</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_makul as $makul)
                    <tr>
                        <td class="text-center align-middle">{{ $makul['kode'] }}</td>
                        <td class="align-middle">{{ $makul['nama'] }}</td>
                        <td class="text-center align-middle">{{ $makul['sks'] }}</td>
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
