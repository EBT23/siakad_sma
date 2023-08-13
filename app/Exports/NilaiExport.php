<?php

namespace App\Exports;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class nilaiExport implements  FromCollection, WithHeadings, WithStyles
{
 protected $id;
 protected $id_thn_ajaran;
 protected $nama_ta;
 protected $id_siswa;
 protected $nama_siswa;
 protected $nama_kelas;
 protected $nis_siswa;
 function __construct($id_kelas, $id_thn_ajaran, $nama_ta, $id_siswa, $nama_siswa, $nama_kelas, $nis_siswa) {
        $this->id = $id_kelas;
        $this->id_thn_ajaran = $id_thn_ajaran;
        $this->nama_ta = $nama_ta;
        $this->id_siswa = $id_siswa;
        $this->nama_siswa = $nama_siswa;
        $this->nama_kelas = $nama_kelas;
        $this->nis_siswa = $nis_siswa;
 }
    
    public function collection()
    {
        // $nilai = DB::select("SELECT pelajaran.nama,nilai.rata_rata
        //         FROM `users`, kelas, thn_ajaran, nilai, pelajaran, siswa
        //         WHERE users.id = nilai.id_users
        //         AND nilai.id_thn_ajaran = thn_ajaran.id
        //         AND nilai.kd_pelajaran = pelajaran.kode
        //         AND users.id = siswa.id_users
        //         AND kelas.id = siswa.id_kelas
        //         AND kelas.id = $this->id
        //         AND users.id = $this->id_siswa
        //         AND thn_ajaran.id = $this->id_thn_ajaran");
      $nilai =  DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_users')
        ->join('thn_ajaran', 'nilai.id_thn_ajaran', '=', 'thn_ajaran.id')
        ->join('siswa', 'siswa.id_users', '=', 'users.id')
        ->join('kelas', 'kelas.id', '=', 'siswa.id_kelas')
        ->join('pelajaran', 'nilai.kd_pelajaran', '=', 'pelajaran.kode')
        ->where('kelas.id', '=', $this->id)
        ->where('users.id', '=', $this->id_siswa)
        ->where('thn_ajaran.id', '=', $this->id_thn_ajaran)
        ->select(DB::raw('ROW_NUMBER() OVER (ORDER BY pelajaran.nama) AS no'),'pelajaran.nama', 'nilai.rata_rata')
        ->get();
        return $nilai;

}


    public function headings(): array
    {
        $nama_ta = $this->nama_ta;
        $nama_siswa = $this->nama_siswa;
        $nama_kelas = $this->nama_kelas;
        $nis_siswa = $this->nis_siswa;

        return  [
            ["Nama", '', ": $nama_siswa", '','','Kelas',": $nama_kelas"],
            ["NISN", '', ": $nis_siswa", '','','Tahun Ajaran',": $nama_ta"],
            ["Sekolah", '', ': SMA AL FUSHA', '','','',''],
            ["Alamat", '', ': Jalan Raya Rowocacing-Pakisputih Km.1, Rowocacing Cilik', '','','',''],
            ['', '', '', '','','',''],
            [
            'No',
            'Mata Pelajaran',
            '',
            '',
            '',
            'Nilai',
            '',
            ]
        ];

    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya sel heading yang digabungkan
        $sheet->mergeCells('A1:B1'); 
        $sheet->mergeCells('C1:E1'); 
        $sheet->mergeCells('A2:B2'); 
        $sheet->mergeCells('C2:E2'); 
        $sheet->mergeCells('A3:B3'); 
        $sheet->mergeCells('C3:E3'); 
        $sheet->mergeCells('A4:B4'); 
        $sheet->mergeCells('C4:E4'); 
        $sheet->mergeCells('B6:E6'); 
        $sheet->mergeCells('F6:G6'); 
        $sheet->getStyle('A1:G5')->getFont()->setBold(true);
        $sheet->getStyle('A1:G4')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('A6:G6')->getAlignment()->setHorizontal('center');

        $baris = 6;
        $kolom = 6;
        $sheet->getStyle('A' . $baris . ':G' . $kolom)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => StyleBorder::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Warna border (hitam)
                ],
            ],
        ]);

        $rowIndex = 7; // Mulai dari baris ke-2 untuk data

        $data =  DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_users')
        ->join('thn_ajaran', 'nilai.id_thn_ajaran', '=', 'thn_ajaran.id')
        ->join('siswa', 'siswa.id_users', '=', 'users.id')
        ->join('kelas', 'kelas.id', '=', 'siswa.id_kelas')
        ->join('pelajaran', 'nilai.kd_pelajaran', '=', 'pelajaran.kode')
        ->where('kelas.id', '=', $this->id)
        ->where('users.id', '=', $this->id_siswa)
        ->where('thn_ajaran.id', '=', $this->id_thn_ajaran)
        ->select(DB::raw('ROW_NUMBER() OVER (ORDER BY pelajaran.nama) AS no'),'pelajaran.nama', 'nilai.rata_rata')
        ->get();
        
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowIndex, $row->no);
            $sheet->mergeCells('B' . $rowIndex . ':E' . $rowIndex);
            $sheet->setCellValue('B' . $rowIndex, $row->nama);
            $sheet->mergeCells('F' . $rowIndex . ':G' . $rowIndex);
            $sheet->setCellValue('F' . $rowIndex, $row->rata_rata);

            $sheet->getStyle('A' . $rowIndex . ':G' . $rowIndex)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => StyleBorder::BORDER_THIN,
                        'color' => ['rgb' => '000000'], // Warna border (hitam)
                    ],
                ],
            ]);
        
            $rowIndex++;
        }

    }
}