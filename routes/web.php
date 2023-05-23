<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa');


Route::get('/guru', [AdminController::class, 'guru'])->name('guru');
Route::get('/pelajaran', [AdminController::class, 'pelajaran'])->name('pelajaran');
Route::get('/kehadiran', [AdminController::class, 'kehadiran'])->name('kehadiran');
Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas');
Route::get('/nilai', [AdminController::class, 'nilai'])->name('nilai');
Route::get('/jadwalpelajaran', [AdminController::class, 'jadwal_pelajaran'])->name('jadwal_pelajaran');
Route::get('/jadwalujian', [AdminController::class, 'jadwal_ujian'])->name('jadwal_ujian');
Route::get('/pengumuman', [AdminController::class, 'pengumuman'])->name('pengumuman');
