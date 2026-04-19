@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-900">Daftar Mata Kuliah</h1>
        <a href="{{ route('matakuliah.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            + Tambah Data
        </a>
    </div>
    <div class="px-6 py-4">
        <div id="status-message" class="hidden px-4 py-3 rounded mb-4" role="alert"></div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">Kode MK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="matakuliah-tbody" class="bg-white divide-y divide-gray-200"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const tbody = document.getElementById('matakuliah-tbody');
    const status = document.getElementById('status-message');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const setStatus = (message, isError = false) => {
        status.className = `px-4 py-3 rounded mb-4 ${isError ? 'bg-red-100 border border-red-400 text-red-700' : 'bg-green-100 border border-green-400 text-green-700'}`;
        status.textContent = message;
        status.classList.remove('hidden');
    };

    const renderRows = (data) => {
        if (!Array.isArray(data) || data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data mata kuliah.</td></tr>';
            return;
        }

        tbody.innerHTML = data.map((mk) => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">${mk.kode ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mk.nama ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">${mk.sks ?? ''}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <a href="/matakuliah/${mk.id}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-2 inline-block">Edit</a>
                    <button type="button" data-id="${mk.id}" class="delete-btn bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                </td>
            </tr>
        `).join('');
    };

    const loadData = async () => {
        try {
            const response = await fetch('/api/matakuliah', {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Gagal memuat data mata kuliah.');
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
        if (!confirm('Yakin hapus mata kuliah ini?')) {
            return;
        }

        try {
            const response = await fetch(`/api/matakuliah/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Gagal menghapus data mata kuliah.');
            }

            setStatus('Mata kuliah berhasil dihapus.');
            await loadData();
        } catch (error) {
            setStatus(error.message, true);
        }
    });

    await loadData();
});
</script>
@endsection
