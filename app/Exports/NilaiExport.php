<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NilaiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_users')
        ->join('pelajaran', 'pelajaran.kode', '=', 'nilai.kd_pelajaran')
        ->select(
            'users.nama',
            'pelajaran.kode',
            'nilai.rph',
            'nilai.pts',
            'nilai.pat',
            'nilai.jumlah',
            'nilai.rata_rata'
        )
        ->whereColumn('nilai.kd_pelajaran', '=', 'pelajaran.kode')
        ->whereColumn('nilai.id_users', '=', 'users.id')
        ->get();
}

public function headings(): array
{
    return [
        'NAMA SISWA',
        'KODE PELAJARAN',
        'RPH',
        'PTS',
        'PAT',
        'JUMLAH',
        'RATA-RATA',
    ];
}

public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:G1')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => 'center'],
    ]);
}
}

