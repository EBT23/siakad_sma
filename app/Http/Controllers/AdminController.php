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

    // view guru
    public function pelajaran()
    {
        return view('admin.guru');
    }
}
