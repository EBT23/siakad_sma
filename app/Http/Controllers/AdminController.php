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
        $kelompok = DB::table('kelas')->get();
        $siswa = DB::select('SELECT users.*,siswa.id_users,siswa.hp,siswa.alamat,siswa.id_kelas, siswa.id, kelas.id,kelas.nama AS nama_kelas FROM users,siswa,kelas WHERE users.id=siswa.id_users and siswa.id_kelas=kelas.id AND users.role=2;');
        $kelas = DB::table('kelas')->get();
        return view('admin.siswa',['kelas'=>$kelas],['siswa'=>$siswa]);
    }

    public function tambah_siswa(Request $request)
    {
        $data = DB::table('users')->insert([
        'username' => $request->nis,
        'nama' => $request->nama,
        'password' => Hash::make($request->password),
        'role' => 2,
    ]);

    $query = DB::select('SELECT * FROM users ORDER BY id DESC limit 1');
    $query = $query[0]->id;
    $data1 = DB::table('siswa')->insert([
        'id_users' => $query,
        'id_kelas' => $request->id_kelas,
        'hp' => $request->hp,
        'alamat' => $request->alamat
    ]);

        return   redirect()->route('siswa');
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

    function hapus_siswa($id)
    {
        DB::table('kelas')->where('id', $id)->delete();
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('kelas');
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
        $pelajaran = DB::select('SELECT pelajaran.nama,pelajaran.kode,pelajaran.id as kp,pelajaran.id_kelompok, kelompok.kelompok , kelompok.id FROM pelajaran, kelompok where pelajaran.id_kelompok=kelompok.id;');
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
        $siswa = DB::select('SELECT * FROM users WHERE role=2');
        $pelajaran = DB::table('pelajaran')->get();
        $nilai = DB::select('SELECT nilai.*, pelajaran.id as id_p,pelajaran.nama as nama_p,pelajaran.kode,users.id as id_u,users.nama from nilai,pelajaran,users WHERE nilai.kd_pelajaran=pelajaran.kode AND users.id=nilai.id_users; ');
        return view('admin.nilai',compact('siswa','title','pelajaran','nilai'));
    }

    public function tambah_nilai(Request $request)
    {
        $rph = $request->rph;
        $pts = $request->pts;
        $pat = $request->pat;
        $jumlah = (int)$rph+(int)$pts+(int)$pat;
        $rata_rata = $jumlah/3;
        $data = [
            'id_users' => $request->id_users,
            'kd_pelajaran' => $request->kd_pelajaran,
            'rph' => $request->rph,
            'pts' => $request->pts,
            'pat' => $request->pat,
            'jumlah'=>$jumlah,
            'rata_rata'=>$rata_rata,
            
        ];

        DB::table('nilai')->insert($data);
        return redirect()->route('nilai');
    }

    public function edit_nilai(Request $request, $id)
    {
        $rph = $request->rph;                                                   
        $pts = $request->pts;
        $pat = $request->pat;
        $jumlah = (int)$rph+(int)$pts+(int)$pat;
        $rata_rata = $jumlah/3;
        DB::table('nilai')->where('id', $id)->update([
            'id_users' => $request->id_users,
            'kd_pelajaran' => $request->kd_pelajaran,
            'rph' => $request->rph,
            'pts' => $request->pts,
            'pat' => $request->pat,
            'jumlah'=>$jumlah,
            'rata_rata'=>$rata_rata

        ]);
        return redirect()->route('nilai');
    }
    

    function hapus_nilai($id)
    {
        DB::table('nilai')->where('id', $id)->delete();
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('nilai');
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
