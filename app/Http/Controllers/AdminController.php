<?php


namespace App\Http\Controllers;

use App\Exports\nilaiExport;
use App\Models\Siswa;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Console\View\Components\Alert;
    
    class AdminController extends Controller
    {
        // View dashboard
        public function dashboard()
        {
            $title = 'Dashboard Admin';
            $siswa = count(DB::select('SELECT * FROM users WHERE role=2'));
            $guru = count(DB::select('SELECT * FROM users WHERE role=3'));
            $kelas = count(DB::select('SELECT * FROM kelas '));
            return view('admin.dashboard',compact('title', 'siswa', 'guru','kelas'));
        }
    
        // view siswa
        public function siswa()
        {
            
            $title = 'Siswa';
            $kelompok = DB::table('kelas')->get();
            $siswa = DB::select('SELECT users.*,siswa.id_users,siswa.hp,siswa.alamat,siswa.id_kelas, siswa.id as id_s, kelas.id as id_k,kelas.nama AS nama_kelas 
                                FROM users,siswa,kelas WHERE users.id=siswa.id_users and siswa.id_kelas=kelas.id AND users.role=2;');
            $kelas = DB::table('kelas')->get();
            return view('admin.siswa',compact('title','siswa','kelompok','kelas'));
        }
    
        public function tambah_siswa(Request $request)
        {
            $data = DB::table('users')->insertGetId([
            'username' => $request->nis,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 2,
                ]);
    
        // $query = DB::select('SELECT * FROM users ORDER BY id DESC limit 1');
        // $query = $query[0]->id;
        $data1 = DB::table('siswa')->insert([
            'id_users' => $data,
            'id_kelas' => $request->id_kelas,
            'hp' => $request->hp,
            'alamat' => $request->alamat
        ]);
            return redirect()->route('siswa');
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


        public function exportNilai(Request $request)
        {
            

            $nilai = DB::table('nilai')
            ->join('users', 'nilai.id_users', '=', 'users.id')
            ->select( 'users.nama','nilai.kd_pelajaran', 'nilai.rph', 'nilai.pts', 'nilai.pat', 'nilai.jumlah', 'nilai.rata_rata')->get();
    
            return Excel::download(new nilaiExport($nilai), 'nilai.xlsx');
        }
    
        // view guru
        public function guru()
        {
            $title = 'Menu Guru';
            $guru = DB::select('SELECT users.id, users.nama, users.username, guru.id AS id_g, 
            guru.id_users,guru.tempat,guru.tgl_lahir,guru.tempat,guru.pendidikan,guru.tmk,guru.jabatan,
            guru.alamat,guru.tgs_tam 
            FROM users, guru 
            WHERE users.id=guru.id_users AND users.role=3');
            // dd($guru);
            return view('admin.guru', compact('title','guru'));
        }
    
        public function tambah_guru(Request $request)
        {
            $data = DB::table('users')->insertGetId([
                'username' => $request->nip,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'role' => 3,
            ]);
    
        // $query = DB::select('SELECT * FROM users ORDER BY id DESC limit 1');
        // $query = $query[0]->id;
        $data1 = DB::table('guru')->insert([
            'id_users' => $data,
            'tempat' => $request->tempat,
            'tgl_lahir' => $request->tgl_lahir,
            'pendidikan' => $request->pendidikan,
            'jabatan' => $request->jabatan,
            'tmk' => $request->tmk,
            'tgs_tam' => $request->tgs_tam,
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
        $tgs_tam = $request->tgs_tam;
    
            DB::select("UPDATE users, guru
            SET users.nama = '$nama', users.username = '$username', guru.tempat = '$tempat', guru.tgl_lahir = '$tgl_lahir', guru.tgl_lahir = '$tgl_lahir', guru.pendidikan = '$pendidikan', guru.tmk = '$tmk', guru.jabatan = '$jabatan', guru.alamat = '$alamat', guru.tgs_tam = '$tgs_tam'
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
            $title = 'Pelajaran';
            $pelajaran = DB::table('pelajaran')->get();
            return view('admin.pelajaran',compact('title','pelajaran'));
        }
    
        public function tambah_pelajaran(Request $request)
        {
            $data = [
                'nama' => $request->nama,
                'kode' => $request->kode,
                'kelompok' => $request->kelompok,
            ];
            DB::table('pelajaran')->insert($data);
            return redirect()->route('pelajaran');
        }
    
        public function edit_pelajaran(Request $request,$id)
        {
            DB::table('pelajaran')->where('id', $id)->update([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'kelompok' => $request->kelompok,
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
        public function getSiswa(Request $request)
        {
            $kelasId = $request->input('id_kelas');
    
            // Ambil data siswa berdasarkan kelas yang dipilih
            $siswa = DB::select("SELECT users.id, users.nama FROM users, siswa WHERE siswa.id_users = users.id AND users.role=2 AND siswa.id_kelas = $kelasId");
    
            // Kembalikan data dalam format JSON
            return response()->json($siswa);
        }

        public function nilai()
        {
            $title = 'Menu Nilai';
            $siswa = DB::select('SELECT * FROM users WHERE role=2');
            $pelajaran = DB::table('pelajaran')->get();
            $kelas = DB::table('kelas')->get();
            $nilai = DB::select('SELECT nilai.*, pelajaran.id as id_p,pelajaran.nama as nama_p,pelajaran.kode,users.id as id_u,users.nama from nilai,pelajaran,users WHERE nilai.kd_pelajaran=pelajaran.kode AND users.id=nilai.id_users; ');
            return view('admin.nilai',compact('siswa','title','pelajaran','nilai', 'kelas'));
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
                'updated_at' => now()
                
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
            $jadwal_pelajaran = DB::select('SELECT jadwal_pelajaran.*, users.id as id_u,users.role, users.nama as nama_guru, pelajaran.id as id_p, pelajaran.nama as nama_pelajaran,pelajaran.kode, kelas.nama as nama_kelas 
            from jadwal_pelajaran, users, pelajaran, kelas where jadwal_pelajaran.id_guru=users.id 
            and pelajaran.id=jadwal_pelajaran.id_pelajaran and kelas.id=jadwal_pelajaran.id_kelas;   ');
            return view('admin.jadwal_pelajaran', compact('title','guru','pelajaran','kelas','jadwal_pelajaran'));
        }
    
        public function tambah_jadwal_pelajaran(Request $request)
        {
            // dd($request);
            $data = [
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_pelajaran' => $request->id_pelajaran,
                'jam_mengajar' => $request->jam_mengajar,
                'jumlah_jam' => $request->jumlah_jam,
                'jam_mengajar' => $request->jam_mengajar,
                'hari' => $request->hari,
            ];
            DB::table('jadwal_pelajaran')->insert($data);
            return redirect()->route('jadwal_pelajaran');
        }
    
        public function edit_jadwal_pelajaran(Request $request, $id)
        {
            // dd($id);
            DB::table('jadwal_pelajaran')->where('id', $id)->update([
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_pelajaran' => $request->id_pelajaran,
                'jam_mengajar' => $request->jam_mengajar,
                'jumlah_jam' => $request->jumlah_jam,
                'hari' => $request->hari,
            ]);
            return redirect()->route('jadwal_pelajaran');
        }
        
    
        public function hapus_jadwal_pelajaran($id)
        {
            DB::table('jadwal_pelajaran')->where('id', $id)->delete();
            // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
            return redirect()->route('jadwal_pelajaran');
        }
        
        // view jadwal kehadiran
        public function getKehadiran(Request $request)
        {
            $kelasId = $request->input('id_kelas');
    
            // Ambil data siswa berdasarkan kelas yang dipilih
            $siswa = DB::select("SELECT users.id, users.nama FROM users, siswa WHERE siswa.id_users = users.id AND users.role=2 AND siswa.id_kelas = $kelasId");
    
            // Kembalikan data dalam format JSON
            return response()->json($siswa);
        }
        public function kehadiran()
        {
            $title = 'Kehadiran';
    
            $siswa = DB::select('SELECT * FROM users WHERE role=2');
            $kelas = DB::table('kelas')->get();
            $pelajaran = DB::table('pelajaran')->get();
            $kehadiran = DB::select('SELECT jadwal_pelajaran.*, users.id as id_u, users.nama, pelajaran.id as id_p, pelajaran.nama,pelajaran.kode, kelas.nama, kelas.id as id_k from kelas, jadwal_pelajaran, users, pelajaran where jadwal_pelajaran.id_guru=users.id and pelajaran.id=jadwal_pelajaran.id_pelajaran and jadwal_pelajaran.id_kelas=kelas.id; ');
    
            return view('admin.kehadiran', compact('siswa','kelas','title','pelajaran','kehadiran'));
        }
    
        public function tambah_kehadiran(Request $request)
        {
            $data  = [
                'id_siswa' => $request->id_siswa,
                'id_pelajaran' => $request->id_pelajaran,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
            ];
    
            DB::table('kehadiran')->insert($data);
            return redirect()->route('kehadiran');
        }
    
    public function edit_kehadiran(Request $request,$id)
    {
        DB::table('kehadiran')->where('id', $id)->update([
            'id_siswa' => $request->id_siswa,
            'id_pelajaran' => $request->id_pelajaran,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            
        ]);
        return redirect()->route('kehadiran');
    }
    
        public function hapus_kehadiran($id)
        {
            DB::table('kehadiran')->where('id', $id)->delete();
            // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!'); 
            return redirect()->route('kehadiran');
        }
    
        // view pengumuman
        public function pengumuman()
        {
    
            $title = 'Pengumuman';
            $pengumuman = DB::table('pengumuman')->get();
            return view('admin.pengumuman', compact('title','pengumuman'));
        }
    
        public function tambah_pengumuman(Request $request)
        {
    
            $request->validate([
                'tanggal' => 'required|max:255',
                'judul' => 'required|email|unique:customers,email',
                'isi_pengumuman' => 'required',
              ], [
                'customer.name.required' => 'A customer name is required.',
                'customer.email.required' => 'A customer email is required',
             
              ]);
            
    
            $data  = [
                'tanggal' => $request->tanggal,
                'judul' => $request->judul,
                'isi_pengumuman' => $request->isi_pengumuman,
            ];
    
            DB::table('pengumuman')->insert($data);
            return redirect()->route('pengumuman');
        }
    
        public function edit_pengumuman(Request $request,$id)
    {
        DB::table('pengumuman')->where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
        ]);
        return redirect()->route('pengumuman');
    }
    
        public function hapus_pengumuman($id)
        {
            DB::table('pengumuman')->where('id', $id)->delete();
            // Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!'); 
            return redirect()->route('pengumuman');
        }
    }
    
