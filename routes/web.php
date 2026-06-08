<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NfcController;

Route::get('/', [NfcController::class, 'index']);
Route::post('/daftar-kartu', [NfcController::class, 'daftarKartu']);
Route::post('/scan-absensi', [NfcController::class, 'scanAbsensi']);
Route::get('/data-absensi', [NfcController::class, 'dataAbsensi']);

/*
|--------------------------------------------------------------------------
| Route Testing Sementara
|--------------------------------------------------------------------------
| Route ini hanya dipakai untuk mengetes backend absensi tanpa scan NFC asli.
|
| Cara pakai:
| 1. Pastikan ada data di tabel kartu_nfc
| 2. Sesuaikan serial_number di bawah dengan data pada database
| 3. Buka: http://127.0.0.1:8000/test-absensi
|--------------------------------------------------------------------------
*/

// Route::get('/test-absensi', function () {
//     $request = new \Illuminate\Http\Request([
//         'serial_number' => '04:AB:CD:EF:12:34:56'
//     ]);

//     return app(\App\Http\Controllers\NfcController::class)->scanAbsensi($request);
// });