<?php

namespace App\Models;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TransaksiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithMapping
{
    protected $transaksi;
    protected $totalHarga = 0;

    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function collection()
    {
        return $this->transaksi;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Transaksi',
            'Nama Pelanggan',
            'Produk',
            'Jumlah',
            'Total Harga',
            'Status Pembayaran',
            'Kurir',
            'No. Resi'
        ];
    }

    public function map($transaksi): array
    {
        static $no = 0;
        $no++;
    
        // Mengumpulkan nama produk dan jumlah
        $products = [];
        $quantities = [];
        foreach ($transaksi->detailTransaksi as $detail) {
            $products[] = $detail->produk->nama_produk ?? '-';
            $quantities[] = $detail->qty ?? '1'; // Menggunakan qty sesuai dengan data
        }
    
        // Menambahkan total harga ke variable total
        if ($transaksi->status_pembayaran !== 'Batal') {
            $this->totalHarga += $transaksi->total_harga;
        }
    
        return [
            $no,
            $transaksi->created_at->format('d-m-Y'),
            $transaksi->user->name ?? '-',
            implode("\n", $products) ?: '-',
            implode("\n", $quantities) ?: '1',
            'Rp ' . number_format($transaksi->total_harga, 0, ',', '.'),
            $transaksi->status_pembayaran ?? '-',
            $transaksi->kurir ?: '-',
            $transaksi->no_resi ?: '-'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,  // No
            'B' => 18, // Tanggal
            'C' => 25, // Nama Pelanggan
            'D' => 30, // Produk
            'E' => 10, // Jumlah
            'F' => 20, // Total Harga
            'G' => 15, // Status
            'H' => 15, // Kurir
            'I' => 20, // No Resi
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $lastColumn . $lastRow;

        // Style untuk seluruh content
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style untuk header
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'], // Gray-600
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Tambahkan baris total
        $totalRow = $lastRow + 2;
        $sheet->setCellValue('E' . $totalRow, 'TOTAL:');
        $sheet->setCellValue('F' . $totalRow, 'Rp ' . number_format($this->totalHarga, 0, ',', '.'));
        
        // Style untuk baris total
        $sheet->getStyle('E' . $totalRow . ':F' . $totalRow)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'], // Gray-200
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Auto-height untuk semua baris
        for ($i = 1; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        // Alignment untuk kolom spesifik
        $sheet->getStyle('A1:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E1:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F1:F' . $totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('G1:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H1:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I1:I' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Mengaktifkan text wrapping untuk kolom produk
        $sheet->getStyle('D1:D' . $lastRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('E1:E' . $lastRow)->getAlignment()->setWrapText(true);

        // Memberikan warna alternatif untuk baris
        for ($i = 2; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':' . $lastColumn . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F3F4F6'], // Gray-100
                    ],
                ]);
            }
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}