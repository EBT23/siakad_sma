<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // View dashboard
    public function dashboard()
    {
        $title = 'Dashboard Admin';
        return view('admin.dashboard',['title'=>$title]);
    }

    // view siswa
    public function siswa()
    {
        $title = 'Menu Siswa';
        return view('admin.siswa',['title'=>$title]);
    }

    // view guru
    public function guru()
    {
        $title = 'Menu Guru';
        return view('admin.guru', ['title'=>$title]);
    }

    // view pelajaran
    public function pelajaran()
    {
        $title = 'Menu Pelajaran';
        return view('admin.pelajaran', ['title'=>$title]);
    }
    // view kelas
    public function kelas()
    {
        $title = 'Menu Kelas';
        return view('admin.kelas', ['title'=>$title]);
    }
    // view nilai
    public function nilai()
    {
        $title = 'Menu Nilai';
        return view('admin.nilai', ['title'=>$title]);
    }
    // view jadwal Pelajaran
    public function jadwal_pelajaran()
    {
        $title = 'Menu Jadwal Pelajaran';
        return view('admin.jadwal_pelajaran', ['title'=>$title]);
    }
    // view jadwal ujian
    public function jadwal_ujian()
    {
        $title = 'Menu Jadwal Ujian';
        return view('admin.jadwal_ujian', ['title'=>$title]);
    }
    // view jadwal kehadiran
    public function kehadiran()
    {
        $title = 'Menu Jadwal Ujian';
        return view('admin.kehadiran', ['title'=>$title]);
    }
    // view pengumuman
    public function pengumuman()
    {
        $title = 'Menu Pengumuman';
        return view('admin.pengumuman', ['title'=>$title]);
    }
}
