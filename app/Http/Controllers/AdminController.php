<?php

namespace App\Http\Controllers;

use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redis;

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
        // $siswa = collect($data);
        $siswa = DB::select('SELECT users.*, siswa.id,siswa.id_users,siswa.hp,siswa.alamat, kelas.id,kelas.nama AS nama_kelas FROM users,siswa,kelas WHERE users.id=siswa.id_users and siswa.id_kelas=kelas.id;');
        $kelas = DB::table('kelas')->get();
        return view('admin.siswa',['kelas'=>$kelas],['siswa'=>$siswa]);
    }

    public function tambah_siswa(Request $request)
    {
        $data = [
            'username' => $request->nis,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 2,
        ];
        $data2 = [
            'id_kelas' => $request->id_kelas,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
        ];
        DB::table('users')->insert($data);
        DB::table('siswa')->insert($data2);
        return redirect()->route('siswa');
    }    

    public function edit_siswa(Request $request,$id)
    {
        DB::table('users')->where('id', $id)->update([
            'username' => $request->nis,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
        ]);
        DB::table('siswa')->where('id', $id)->update([
            'id_kelas' => $request->id_kelas,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('siswa');

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
        $kelompok = DB::table('kelompok')->get();
        $pelajaran = DB::select('SELECT pelajaran.*, kelompok.kelompok as nama_kelompok, kelompok.id FROM pelajaran, kelompok where pelajaran.id_kelompok=kelompok.id; ');
        return view('admin.pelajaran',['pelajaran'=>$pelajaran],['kelompok'=>$kelompok],$title);
    }

    public function tambah_pelajaran(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'kode' => $request->kode,
            'id_kelompok' => $request->id_kelompok,
        ];
        DB::table('pelajaran')->insert($data);
        return redirect()->route('pelajaran');
    }

    public function edit_pelajaran(Request $request,$id)
    {
        DB::table('pelajaran')->where('id', $id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'id_kelompok' => $request->id_kelompok,
        ]);
        return redirect()->route('pelajaran');
    }

    function hapus_pelajaran($id)
    {
        DB::table('pelajaran')->where('id', $id)->delete();
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('pelajaran');
    }

    // view kelas
    public function kelas()
    {
        $title = 'Menu Kelas';
        $kelas = DB::table('kelas')->get();
        return view('admin.kelas', ['title'=>$title],['kelas'=>$kelas]);
    }

    public function tambah_kelas(Request $request)
    {
        $data = [
            'nama' => $request->kelas,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];
        DB::table('kelas')->insert($data);
        return redirect()->route('kelas');
    }

    public function edit_kelas(Request $request, $id)
    {
        DB::table('kelas')->where('id', $id)->update([
            'nama' => $request->kelas,
            'update_created' => date('Y-m-d'),
        ]);
        return redirect()->route('kelas');
    }

    function hapus_kelas($id)
    {
        DB::table('kelas')->where('id', $id)->delete();
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('kelas');
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
