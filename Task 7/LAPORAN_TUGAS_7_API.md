# Laporan Tugas 7 - REST API Laravel (Mahasiswa & Mata Kuliah)

## Identitas Tugas
- **Mata kuliah/topik**: Pengembangan REST API dengan Laravel
- **Project**: Task 7
- **Tujuan**: Membuat API daftar mahasiswa dan API daftar mata kuliah dengan output JSON

## Soal Tugas
1. Membuat REST API sederhana menggunakan Laravel dengan endpoint:
   - `GET /api/mahasiswa` : menampilkan daftar seluruh mahasiswa.
   - `POST /api/mahasiswa` : menambahkan satu data mahasiswa baru.
   - `GET /api/matakuliah` : menampilkan daftar mata kuliah.
2. Memastikan semua response API berformat JSON.
3. Melakukan pengujian ketiga endpoint menggunakan Postman.
4. Mengumpulkan:
   - Screenshot source code (bagian routes dan controller).
   - Screenshot hasil pengujian Postman yang menampilkan request dan response JSON.

## Implementasi pada Project

### 1) Routing API
Endpoint didefinisikan pada file:
- `routes/api.php`

Cuplikan route yang relevan:

```php
Route::apiResource('mahasiswa', MahasiswaController::class)->names('api.mahasiswa');
Route::apiResource('matakuliah', MataKuliahController::class)->names('api.matakuliah');
```

> Pada project ini, route berada dalam group middleware `auth:sanctum`, sehingga request pengujian di Postman perlu menyertakan **Bearer Token**.

### 2) Controller API
Controller yang digunakan:
- `app/Http/Controllers/Api/MahasiswaController.php`
- `app/Http/Controllers/Api/MataKuliahController.php`

Kedua controller sudah mengembalikan response JSON menggunakan:

```php
return response()->json(...);
```

Implementasi yang memenuhi soal:
- `MahasiswaController@index` untuk `GET /api/mahasiswa`
- `MahasiswaController@store` untuk `POST /api/mahasiswa`
- `MataKuliahController@index` untuk `GET /api/matakuliah`

## Spesifikasi Endpoint

### A. GET `/api/mahasiswa`
- **Fungsi**: Menampilkan seluruh data mahasiswa.
- **Method**: `GET`
- **Auth**: Bearer Token (karena middleware project)
- **Contoh response (200)**:

```json
[
  {
    "id": 1,
    "nim": "2211001",
    "nama": "Budi Santoso",
    "jurusan": "Informatika",
    "created_at": "2026-04-19T00:10:00.000000Z",
    "updated_at": "2026-04-19T00:10:00.000000Z"
  }
]
```

### B. POST `/api/mahasiswa`
- **Fungsi**: Menambahkan data mahasiswa baru.
- **Method**: `POST`
- **Auth**: Bearer Token
- **Header**: `Content-Type: application/json`
- **Body (JSON)**:

```json
{
  "nim": "2211002",
  "nama": "Siti Aminah",
  "jurusan": "Sistem Informasi"
}
```

- **Contoh response sukses (201)**:

```json
{
  "id": 2,
  "nim": "2211002",
  "nama": "Siti Aminah",
  "jurusan": "Sistem Informasi",
  "created_at": "2026-04-19T00:15:00.000000Z",
  "updated_at": "2026-04-19T00:15:00.000000Z"
}
```

### C. GET `/api/matakuliah`
- **Fungsi**: Menampilkan seluruh data mata kuliah.
- **Method**: `GET`
- **Auth**: Bearer Token
- **Contoh response (200)**:

```json
[
  {
    "id": 1,
    "kode": "IF201",
    "nama": "Pemrograman Web",
    "sks": 3,
    "created_at": "2026-04-19T00:20:00.000000Z",
    "updated_at": "2026-04-19T00:20:00.000000Z"
  }
]
```

## Pengujian dengan Postman

Langkah pengujian:
1. Jalankan Laravel:

```bash
php artisan serve
```

2. Siapkan token login (jika endpoint dilindungi middleware).
3. Uji tiga endpoint berikut di Postman:
   - `GET http://127.0.0.1:8000/api/mahasiswa`
   - `POST http://127.0.0.1:8000/api/mahasiswa`
   - `GET http://127.0.0.1:8000/api/matakuliah`
4. Pastikan tab **Body** menampilkan response dalam format JSON.

## Daftar Screenshot yang Dikumpulkan

### 1) Screenshot Source Code
- [ ] `routes/api.php` (menampilkan route `mahasiswa` dan `matakuliah`)
- [ ] `app/Http/Controllers/Api/MahasiswaController.php` (method `index` dan `store`)
- [ ] `app/Http/Controllers/Api/MataKuliahController.php` (method `index`)

### 2) Screenshot Pengujian Postman
- [ ] Request + response JSON `GET /api/mahasiswa`
- [ ] Request body + response JSON `POST /api/mahasiswa`
- [ ] Request + response JSON `GET /api/matakuliah`

## Kesimpulan
API pada project sudah memenuhi ketentuan tugas:
- Endpoint yang diminta tersedia.
- Response API menggunakan format JSON.
- Pengujian dapat dilakukan di Postman untuk ketiga endpoint.
- Bukti implementasi dan pengujian dapat dilampirkan melalui screenshot routes, controller, serta hasil request-response JSON.
