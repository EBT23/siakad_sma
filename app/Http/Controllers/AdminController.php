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
        $siswa = DB::select('SELECT users.*,siswa.id_users,siswa.hp,siswa.alamat,siswa.id_kelas, siswa.id as id_s, kelas.id as id_k,kelas.nama AS nama_kelas FROM users,siswa,kelas WHERE users.id=siswa.id_users and siswa.id_kelas=kelas.id AND users.role=2;');
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
        $nama = $request->nama;
        $username = $request->nis;
        $id_kelas = $request->id_kelas;
        $hp = $request->hp;
        $alamat = $request->alamat;
        DB::select("UPDATE users, siswa, kelas
        SET users.nama = '$nama', users.username = '$username', siswa.id_kelas = $id_kelas, siswa.hp = '$hp', siswa.alamat = '$alamat'
        WHERE users.id = siswa.id_users
        AND kelas.id = siswa.id_kelas
        AND users.id = $id");
        return redirect()->route('siswa');
        
    }

    function hapussiswa($id)
    {

        DB::select("DELETE users, siswa FROM users, siswa WHERE users.id = siswa.id_users AND users.id = $id");
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('siswa');
    }

    // view guru
    public function guru()
    {
        $title = 'Menu Guru';
        $guru = DB::select('SELECT users.id, users.nama, users.username, guru.id AS id_g, 
        guru.id_users,guru.tempat,guru.tgl_lahir,guru.tempat,guru.pendidikan,guru.tmk,guru.jabatan,
        guru.alamat,guru.ket 
        FROM users, guru 
        WHERE users.id=guru.id_users AND users.role=3');
        // dd($guru);
        return view('admin.guru', compact('title','guru'));
    }

    public function tambah_guru(Request $request)
    {
        $data = DB::table('users')->insert([
            'username' => $request->nip,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 3,
        ]);

    $query = DB::select('SELECT * FROM users ORDER BY id DESC limit 1');
    $query = $query[0]->id;
    $data1 = DB::table('guru')->insert([
        'id_users' => $query,
        'tempat' => $request->tempat,
        'tgl_lahir' => $request->tgl_lahir,
        'pendidikan' => $request->pendidikan,
        'jabatan' => $request->jabatan,
        'tmk' => $request->tmk,
        'ket' => $request->ket,
        'alamat' => $request->alamat
    ]);
    return redirect()->route('guru');
    }

public function edit_guru(Request $request,$id)
{
    $username = $request->nip;
    $nama = $request->nama;
    $tempat = $request->tempat;
    $tgl_lahir = $request->tgl_lahir;
    $pendidikan = $request->pendidikan;
    $tmk = $request->tmk;
    $jabatan = $request->jabatan;
    $alamat = $request->alamat;
    $ket = $request->ket;

        DB::select("UPDATE users, guru
        SET users.nama = '$nama', users.username = '$username', guru.tempat = '$tempat', guru.tgl_lahir = '$tgl_lahir', guru.tgl_lahir = '$tgl_lahir', guru.pendidikan = '$pendidikan', guru.tmk = '$tmk', guru.jabatan = '$jabatan', guru.alamat = '$alamat', guru.ket = '$ket'
        WHERE users.id = guru.id_users
        AND users.id = $id");
    return redirect()->route('guru');
}

public function hapusguru($id)
{
    DB::select("DELETE users, guru FROM users, guru WHERE users.id = guru.id_users AND users.id = $id");
    // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
    return redirect()->route('guru');
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
        $guru = DB::select('SELECT * FROM users Where role=3');
        $pelajaran = DB::table('pelajaran')->get();
        $kelas = DB::table('kelas')->get();
        $jadwal_pelajaran = DB::select('SELECT jadwal_pelajaran.*, kelas.id AS id_k, 
        kelas.nama as nama_kelas, 
        pelajaran.id as id_p, pelajaran.nama AS nama_pelajaran, 
        users.id AS id_g, users.nama FROM users, pelajaran,kelas,jadwal_pelajaran 
        WHERE jadwal_pelajaran.id_guru=users.id 
        AND pelajaran.id=jadwal_pelajaran.id_pelajaran AND kelas.id=jadwal_pelajaran.id_kelas; ');
        return view('admin.jadwal_pelajaran', compact('title','guru','pelajaran','kelas','jadwal_pelajaran'));
    }

    public function tambah_jadwal_pelajaran(Request $request)
    {
        $request->validate([

        ]);
        $data = [
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_pelajaran' => $request->id_pelajaran,
            'jam_mengajar' => $request->jam_mengajar,
            'jumlah_jam' => $request->jumlah_jam,
            'jam_mengajar' => $request->jam_mengajar,
            'tugas_tambahan' => $request->tugas_tambahan,
        ];
        DB::table('jadwal_pelajaran')->insert($data);
        return redirect()->route('jadwal_pelajaran');
    }

    public function edit_jadwal_pelajaran(Request $request,$id)
    {
        DB::table('jadwal_pelajaran')->where('id', $id)->update([
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_pelajaran' => $request->id_pelajaran,
            'jam_mengajar' => $request->jam_mengajar,
            'jumlah_jam' => $request->jumlah_jam,
            'tugas_tambahan' => $request->tugas_tambahan,
        ]);
        return redirect()->route('jadwal_pelajaran');
    }
    

    public function hapus_jadwal_pelajaran($id)
    {
        DB::table('jadwal_pelajaran')->where('id', $id)->delete();
        // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('jadwal_pelajaran');
    }
    // view jadwal ujian
    public function jadwal_ujian()
    {
        $title = 'Jadwal Ujian';
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
