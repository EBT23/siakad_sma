<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class kehadiranExport implements FromCollection, WithHeadings,WithStyles
{
    protected $id;
 function __construct($id_kelas) {
        $this->id = $id_kelas;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('kehadiran')
        ->join('users', 'kehadiran.id_siswa', '=', 'users.id')
        ->join('siswa', 'users.id', '=', 'siswa.id_users')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
        ->join('pelajaran', 'kehadiran.id_pelajaran', '=', 'pelajaran.id')
        ->select( 'users.nama as nama_siswa','pelajaran.nama','kelas.nama as nama_kelas', 'kehadiran.tanggal', 'kehadiran.status_kehadiran')
        ->where('kelas.id',$this->id )
        ->get();
    }

    public function headings(): array
    {
        return [
            ['DATA KEHADIRAN SMA AL FUSHA', '', '', '',''],
            [
            'Nama Siswa',
            'Nama Pelajaran',
            'Kelas',
            'Tanggal',
            'Status Kehadiran',
            ]
        ];

    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya sel heading yang digabungkan
        $sheet->mergeCells('A1:E1'); 
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');

    }
}
