<?php

namespace App\Exports;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class nilaiExport implements  FromCollection, WithHeadings, WithStyles
{
 protected $id;
 function __construct($id_kelas) {
        $this->id = $id_kelas;
 }
    
    public function collection()
    {
        return DB::table('nilai')
    //         ->join('users', 'nilai.id_users', '=', 'users.id')
    //         ->select( 'users.nama','nilai.kd_pelajaran', 'nilai.rph', 'nilai.pts', 'nilai.pat', 'nilai.jumlah', 'nilai.rata_rata')->get();
    // 
    ->join('users', 'nilai.id_users', '=', 'users.id')
    ->join('siswa', 'users.id', '=', 'siswa.id_users')
    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
    ->join('pelajaran', 'nilai.kd_pelajaran', '=', 'pelajaran.kode')
    ->select( 'users.nama','nilai.kd_pelajaran', 'nilai.rph', 'nilai.pts', 'nilai.pat', 'nilai.jumlah', 'nilai.rata_rata')
    ->where('kelas.id',$this->id )
    ->get();
}


    public function headings(): array
    {
        return [
            ['DATA NILAI SMA AL FUSHA', '', '', '','','',''],
            [
            'Nama Siswa',
            'Kode Pelajaran',
            'RPH',
            'PTS',
            'PAT',
            'Jumlah',
            'Rata-rata',
            ]
        ];

    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya sel heading yang digabungkan
        $sheet->mergeCells('A1:G1'); 
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');

    }
}
