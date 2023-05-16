<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // View dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // view siswa
    public function siswa()
    {
        return view('admin.siswa');
    }

    // view guru
    public function guru()
    {
        return view('admin.guru');
    }

    // view pelajaran
    public function pelajaran()
    {
        return view('admin.pelajaran');
    }
    // view kelas
    public function kelas()
    {
        return view('admin.kelas');
    }
    // view nilai
    public function nilai()
    {
        return view('admin.nilai');
    }
    // view jadwal Pelajaran
    public function jadwal_pelajaran()
    {
        return view('admin.jadwal_pelajaran');
    }
    // view jadwal ujian
    public function jadwal_ujian()
    {
        return view('admin.jadwal_ujian');
    }
    // view pengumuman
    public function pengumuman()
    {
        return view('admin.pengumuman');
    }
}
