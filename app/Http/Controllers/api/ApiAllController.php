<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ApiAllController extends Controller
{
    public function jadwal_mengajar($id)
    {
        $jadwal_mengajar = DB::select("SELECT users.nama, pelajaran.nama, kelas.nama, jadwal_pelajaran.jam_mengajar, jadwal_pelajaran.banyak_kelas, jadwal_pelajaran.jumlah_jam, jadwal_pelajaran.tugas_tambahan
                                            FROM users, pelajaran, kelas, jadwal_pelajaran
                                            WHERE users.id = jadwal_pelajaran.id_guru
                                            AND pelajaran.id = jadwal_pelajaran.id_pelajaran
                                            AND kelas.id = jadwal_pelajaran.id_kelas
                                            AND users.role = 3
                                            AND users.id = $id");

        if ($jadwal_mengajar != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $jadwal_mengajar
            ], Response::HTTP_OK);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $jadwal_mengajar
            ], Response::HTTP_OK);
        }
    }
    public function jadwal_pelajaran($id)
    {
        $jadwal_pelajaran = DB::select("SELECT users.nama, pelajaran.nama, kelas.nama, jadwal_pelajaran.jam_mengajar, jadwal_pelajaran.banyak_kelas, jadwal_pelajaran.jumlah_jam, jadwal_pelajaran.tugas_tambahan
                                            FROM users, pelajaran, kelas, jadwal_pelajaran
                                            WHERE users.id = jadwal_pelajaran.id_guru
                                            AND pelajaran.id = jadwal_pelajaran.id_pelajaran
                                            AND kelas.id = jadwal_pelajaran.id_kelas
                                            AND users.role = 3
                                            AND kelas.id = $id");

        if ($jadwal_pelajaran != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $jadwal_pelajaran
            ], Response::HTTP_OK);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $jadwal_pelajaran
            ], Response::HTTP_OK);
        }
    }
    public function nilai_by_guru($id)
    {
        $nilai = DB::select("SELECT users.nama, pelajaran.nama, nilai.rph, nilai.pts, nilai.pat, nilai.jumlah, nilai.rata_rata
                                    FROM users as guruku, users,nilai, pelajaran, jadwal_pelajaran
                                    WHERE users.id = nilai.id_users
                                    AND pelajaran.kode = nilai.kd_pelajaran
                                    AND guruku.id = jadwal_pelajaran.id_guru
                                    AND jadwal_pelajaran.id_pelajaran = pelajaran.id
                                    AND guruku.id = $id");

        if ($nilai != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $nilai
            ], Response::HTTP_OK);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $nilai
            ], Response::HTTP_OK);
        }
    }
    public function nilai_by_siswa($id)
    {
        $nilai = DB::select("SELECT siswaku.nama, pelajaran.nama, nilai.rph, nilai.pts, nilai.pat, nilai.jumlah, nilai.rata_rata
                                    FROM users as siswaku, nilai, pelajaran
                                    WHERE siswaku.id = nilai.id_users
                                    AND pelajaran.kode = nilai.kd_pelajaran
                                    AND siswaku.id = $id
                                    AND siswaku.role = 2");

        if ($nilai != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $nilai
            ], Response::HTTP_OK);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $nilai
            ], Response::HTTP_OK);
        }
    }
    public function jadwal_ujian()
    {
        $jadwal_ujian = DB::select("SELECT jadwal_ujian.tanggal, jadwal_ujian.jam, jadwal_ujian.keterangan, pelajaran.nama as nama_mapel, kelas.nama
                                        FROM jadwal_ujian, kelas, pelajaran
                                        WHERE jadwal_ujian.id_pelajaran = pelajaran.id
                                        AND jadwal_ujian.id_kelas = kelas.id");

            if ($jadwal_ujian != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $jadwal_ujian
            ], Response::HTTP_OK);
            } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $jadwal_ujian
            ], Response::HTTP_OK);
            }
    }
    public function pengumuman()
    {
        $pengumuman = DB::select("SELECT * FROM pengumuman");

            if ($pengumuman != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $pengumuman
            ], Response::HTTP_OK);
            } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $pengumuman
            ], Response::HTTP_OK);
            }
    }
    public function siswa()
    {
        $siswa = DB::select("SELECT * FROM users WHERE users.role = 2");

            if ($siswa != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $siswa
            ], Response::HTTP_OK);
            } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $siswa
            ], Response::HTTP_OK);
            }
    }
    public function pelajaran()
    {
        $siswa = DB::select("SELECT * FROM pelajaran WHERE users.role = 2");

            if ($siswa != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $siswa
            ], Response::HTTP_OK);
            } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $siswa
            ], Response::HTTP_OK);
            }
    }
    public function kehadiran()
    {
        $kehadiran = DB::select("SELECT users.nama, kehadiran.status_kehadiran FROM users, kehadiran WHERE users.id = kehadiran.id_siswa AND users.id = 2");

            if ($kehadiran != false) {
            return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $kehadiran
            ], Response::HTTP_OK);
            } else {
            return response()->json([
            'success' => false,
            'message' => 'Data tidak tersedia',
            'data' => $kehadiran
            ], Response::HTTP_OK);
            }
    }

    public function getSiswa_by_kelas($id_kelas)
    {
        // $siswa = Nilai::whereHas('siswa', function ($query) use ($id_kelas) {
        //     $query->where('id_kelas', $id_kelas);
        // })->get();

        $kelas = Kelas::findOrFail($id_kelas);
        $siswa = $kelas->siswa;
        
        return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil ditampilkan',
                'data' => $siswa
            ],Response::HTTP_OK);

    }

    public function getPelajaran()
    {
        $pelajaran = Pelajaran::pluck('kode');
        
        return response()
            ->json([
                'success' => true,
                'message' => 'Data siswa berhasil ditampilkan',
                'data' => $pelajaran
            ],Response::HTTP_OK);
    }

    public function nilai(Request $request)
    {
        $validatedData = $request->validate([
            'id_users' => 'required',
            'kd_pelajaran' => 'required',
            'rph' => 'required',
            'pts' => 'required',
            'pat' => 'required',
        ]);

        $nilai = new Nilai;
        $nilai->id_users = $request->id_users;
        $nilai->kd_pelajaran = $request->kd_pelajaran;
        $nilai->rph = $request->rph;
        $nilai->pts = $request->pts;
        $nilai->pat = $request->pat;
        $nilai->jumlah = $request->rph + $request->pts + $request->pat;
        $nilai->rata_rata = ($request->rph + $request->pts + $request->pat) / 3;
        $nilai->created_at = now();
        $nilai->save();
    
        return response()->json([
                'success' => true,
                'message' => 'Data nilai berhasil dimasukan',
                'data' => $nilai, 201
            ]);
    }
}
