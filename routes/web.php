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
Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ROUTE SISWA
    Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa');
    Route::post('/tambahsiswa', [AdminController::class, 'tambah_siswa'])->name('siswa.post');
    Route::post('/editsiswa/{id}', [AdminController::class, 'edit_siswa'])->name('edit.siswa');
    Route::delete('/hapussiswa/{id}', [AdminController::class, 'hapussiswa'])->name('hapus.siswa');

    Route::get('/guru', [AdminController::class, 'guru'])->name('guru');
    Route::post('/tambahguru', [AdminController::class, 'tambah_guru'])->name('gurupost');
    Route::post('/editguru/{id}', [AdminController::class, 'edit_guru'])->name('edit.guru');
    Route::delete('/hapusguru/{id}', [AdminController::class, 'hapusguru'])->name('hapus.guru');


    Route::get('/kehadiran', [AdminController::class, 'kehadiran'])->name('kehadiran');

    // ROUTE PELAJARAN
    Route::get('/pelajaran', [AdminController::class, 'pelajaran'])->name('pelajaran');
    Route::post('/tambahpelajaran', [AdminController::class, 'tambah_pelajaran'])->name('pelajaran.post');
    Route::post('/editpelajaran/{id}', [AdminController::class, 'edit_pelajaran'])->name('edit.pelajaran');
    Route::delete('hapuspelajaran/{id}', [AdminController::class, 'hapus_pelajaran'])->name('hapus.pelajaran');


    // ROUTE KELAS
    Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas');
    Route::post('/tambahkelas', [AdminController::class, 'tambah_kelas'])->name('kelas.post');
    Route::post('/editkelas/{id}', [AdminController::class, 'edit_kelas'])->name('edit.kelas');
    Route::delete('hapuskelas/{id}', [AdminController::class, 'hapus_kelas'])->name('hapus.kelas');

    // ROUTE NILAI
    Route::get('/nilai', [AdminController::class, 'nilai'])->name('nilai');
    Route::post('/tambahnilai', [AdminController::class, 'tambah_nilai'])->name('nilai.post');
    Route::post('/editnilai/{id}', [AdminController::class, 'edit_nilai'])->name('edit.nilai');
    Route::delete('/hapusnilai/{id}', [AdminController::class, 'hapus_nilai'])->name('hapus.nilai');

    // ROUTE JADWAL PELAJARAN
    Route::get('/jadwalpelajaran', [AdminController::class, 'jadwal_pelajaran'])->name('jadwal_pelajaran');
    Route::post('/tambahjadwalpelajaran', [AdminController::class, 'tambah_jadwal_pelajaran'])->name('jadwal_pelajaran.post');
    Route::post('/editjadwalpelajaran/{id}', [AdminController::class, 'edit_jadwal_pelajaran'])->name('edit.jadwal_pelajaran');
    Route::delete('/hapusjadwalpelajaran/{id}', [AdminController::class, 'hapus_jadwal_pelajaran'])->name('hapus.jadwal_pelajaran');

    Route::get('/jadwalujian', [AdminController::class, 'jadwal_ujian'])->name('jadwal_ujian');
    Route::get('/pengumuman', [AdminController::class, 'pengumuman'])->name('pengumuman');
});
