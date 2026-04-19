@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-900">Tambah Mahasiswa</h1>
        </div>
        <div class="px-6 py-4">
            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert"></div>
            <form id="create-form">
                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="nim" name="nim" required>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="nama" name="nama" required minlength="3">
                </div>
                <div class="mb-4">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="jurusan" name="jurusan">
                </div>
                <div class="flex justify-between">
                    <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('create-form');
    const errorBox = document.getElementById('error-message');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const setError = (message) => {
        errorBox.textContent = message;
        errorBox.classList.remove('hidden');
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        errorBox.classList.add('hidden');

        const payload = {
            nim: form.nim.value,
            nama: form.nama.value,
            jurusan: form.jurusan.value
        };

        try {
            const response = await fetch('/api/mahasiswa', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                const err = await response.json();
                const message = err?.message || 'Gagal menambahkan mahasiswa.';
                throw new Error(message);
            }

            window.location.href = "{{ route('mahasiswa.index') }}";
        } catch (error) {
            setError(error.message);
        }
    });
});
</script>
@endsection
