<?php

use App\Http\Controllers\api\ApiAllController;
use App\Http\Controllers\api\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/jadwal_mengajar/{id}', [ApiAllController::class, 'jadwal_mengajar']);
    Route::get('/jadwal_pelajaran/{id}/{hari}', [ApiAllController::class, 'jadwal_pelajaran']);
    Route::get('/jadwal_ujian', [ApiAllController::class, 'jadwal_ujian']);
    Route::get('/nilai_by_guru/{id}', [ApiAllController::class, 'nilai_by_guru']);
    Route::get('/nilai_by_siswa/{id}', [ApiAllController::class, 'nilai_by_siswa']);
    Route::get('/pengumuman', [ApiAllController::class, 'pengumuman']);
    Route::get('/guru', [ApiAllController::class, 'guru']);
    Route::get('/siswa', [ApiAllController::class, 'siswa']);
    Route::get('/pelajaran', [ApiAllController::class, 'pelajaran']);
    Route::get('/kehadiran', [ApiAllController::class, 'kehadiran']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::get('/getSiswa_by_kelas/{id_kelas}', [ApiAllController::class,'getSiswa_by_kelas']);
    Route::get('/getPelajaran', [ApiAllController::class,'getPelajaran']);
    Route::post('/nilai', [ApiAllController::class,'nilai']);



});
