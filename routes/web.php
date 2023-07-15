<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Artisan;

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

    // ROUTE GURU
    Route::get('/guru', [AdminController::class, 'guru'])->name('guru');
    Route::post('/tambahguru', [AdminController::class, 'tambah_guru'])->name('gurupost');
    Route::post('/editguru/{id}', [AdminController::class, 'edit_guru'])->name('edit.guru');
    Route::delete('/hapusguru/{id}', [AdminController::class, 'hapusguru'])->name('hapus.guru');


    
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
    Route::get('get-siswa', [AdminController::class, 'getSiswa'])->name('get.siswa');
    Route::get('/export-nilai', [AdminController::class, 'exportNilai'])->name('exportNilai');
    
    
    // ROUTE JADWAL PELAJARAN
    Route::get('/jadwalpelajaran', [AdminController::class, 'jadwal_pelajaran'])->name('jadwal_pelajaran');
    Route::post('/editjadwalpelajaran/{id}', [AdminController::class, 'edit_jadwal_pelajaran'])->name('edit.jadwal_pelajaran');
    Route::post('/tambahjadwalpelajaran', [AdminController::class, 'tambah_jadwal_pelajaran'])->name('jadwal_pelajaran.post');
    Route::delete('/hapusjadwalpelajaran/{id}', [AdminController::class, 'hapus_jadwal_pelajaran'])->name('hapus.jadwal_pelajaran');
    
    // ROUTE KEHADIRAN
    Route::get('get-kehadiran', [AdminController::class, 'getKehadiran'])->name('get.kehadiran');
    Route::get('/kehadiran', [AdminController::class, 'kehadiran'])->name('kehadiran');
    Route::post('/tambahkehadiran', [AdminController::class, 'tambah_kehadiran'])->name('kehadiran.post');
    Route::post('/editkehadiran/{id}', [AdminController::class, 'edit_kehadiran'])->name('edit.kehadiran');
    Route::delete('/hapuskehadiran/{id}', [AdminController::class, 'hapus_kehadiran'])->name('hapus.kehadiran');
    Route::get('/export-kehadiran', [AdminController::class, 'exportKehadiran'])->name('export.Kehadiran');
    
    
    Route::get('/pengumuman', [AdminController::class, 'pengumuman'])->name('pengumuman');
    Route::post('/tambahpengumuman', [AdminController::class, 'tambah_pengumuman'])->name('pengumuman.post');
    Route::post('/editpengumuman/{id}', [AdminController::class, 'edit_pengumuman'])->name('edit.pengumuman');
    Route::delete('/hapuspengumuman/{id}', [AdminController::class, 'hapus_pengumuman'])->name('hapus.pengumuman');
});

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache cleared';
});
Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Routes cache cleared';
});
