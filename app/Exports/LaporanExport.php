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

        return DB::table('pemesanan')
        ->join('barang','barang.id','=','pemesanan.id_barang')
        ->join('users','users.id','=','pemesanan.id_user')
        ->select('barang.nama_barang','pemesanan.jumlah_berat','barang.harga','users.name','pemesanan.status_pemesanan',
        'pemesanan.created_at','pemesanan.total_harga')
        ->where('pemesanan.status_pemesanan','=','Selesai')
        ->get();
    }

    public function headings(): array
    {
        return [
            ['NAMA BARANG', 
            'JUMLAH BERAT',
            'HARGA', 
            'NAMA PEMESAN', 
            'STATUS PEMBAYARAN',
            'TANGGAL PEMBELIAN',
            'TOTAL HARGA',
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