<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //

        return DB::table('nilai')
        ->join('users','users.id','=','nilai.id_users')
        ->join('pelajaran','pelajaran.kode','=','nilai.kd_pelajaran')
        ->select('users.nama','pelajaran.kode','barang.harga','users.name','nilai.rph', 
        'nilai.pts', 'nilai.pat', 'nilai.jumlah', 'nilai.rata_rata')
        ->where('nilai.kd_pelajaran','=','pelajaran.kode')
        ->AND('nilai.id_users','=','users.id')
        ->get();
    }

    public function headings(): array
    {
        return [
            ['NAMA SISWA', 
            'KODE PELAJARAN',
            'RPH', 
            'PTS', 
            'PAT',
            'JUMLAH',
            'RATA-RATA',
        ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya sel heading yang digabungkan
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
    }
}