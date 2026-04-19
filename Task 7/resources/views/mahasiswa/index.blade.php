@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-900">Daftar Mahasiswa Aktif</h1>
        <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            + Tambah Data
        </a>
    </div>
    <div class="px-6 py-4">
        <div id="status-message" class="hidden px-4 py-3 rounded mb-4" role="alert"></div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mahasiswa-tbody" class="bg-white divide-y divide-gray-200"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const tbody = document.getElementById('mahasiswa-tbody');
    const status = document.getElementById('status-message');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const setStatus = (message, isError = false) => {
        status.className = `px-4 py-3 rounded mb-4 ${isError ? 'bg-red-100 border border-red-400 text-red-700' : 'bg-green-100 border border-green-400 text-green-700'}`;
        status.textContent = message;
        status.classList.remove('hidden');
    };

    const renderRows = (data) => {
        if (!Array.isArray(data) || data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data mahasiswa.</td></tr>';
            return;
        }

        tbody.innerHTML = data.map((mhs) => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">${mhs.nim ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.nama ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.jurusan ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <a href="/mahasiswa/${mhs.id}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-2 inline-block">Edit</a>
                    <button type="button" data-id="${mhs.id}" class="delete-btn bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                </td>
            </tr>
        `).join('');
    };

    const loadData = async () => {
        try {
            const response = await fetch('/api/mahasiswa', {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Gagal memuat data mahasiswa.');
            }

            const data = await response.json();
            renderRows(data);
        } catch (error) {
            setStatus(error.message, true);
        }
    };

    tbody.addEventListener('click', async (event) => {
        if (!event.target.classList.contains('delete-btn')) {
            return;
        }

        const id = event.target.getAttribute('data-id');
        if (!confirm('Yakin hapus mahasiswa ini?')) {
            return;
        }

        try {
            const response = await fetch(`/api/mahasiswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Gagal menghapus data mahasiswa.');
            }

            setStatus('Mahasiswa berhasil dihapus.');
            await loadData();
        } catch (error) {
            setStatus(error.message, true);
        }
    });

    await loadData();
});
</script>
@endsection
