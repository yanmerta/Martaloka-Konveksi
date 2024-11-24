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

class TransaksiCustomExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithMapping
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
    
        $products = [];
        $quantities = [];
        
        // Pastikan detailTransaksi ada dan merupakan koleksi sebelum di-loop
        if (!empty($transaksi->detailTransaksi) && is_iterable($transaksi->detailTransaksi)) {
            foreach ($transaksi->detailTransaksi as $detail) {
                $quantities[] = $detail->qty ?? '1';
            }
        } else {
            // Nilai default jika detailTransaksi tidak ada
            $products[] = '-';
            $quantities[] = '1';
        }
    
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
            'A' => 5,
            'B' => 18,
            'C' => 25,
            'D' => 30,
            'E' => 10,
            'F' => 20,
            'G' => 15,
            'H' => 15,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $lastColumn . $lastRow;

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

        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $totalRow = $lastRow + 2;
        $sheet->setCellValue('E' . $totalRow, 'TOTAL:');
        $sheet->setCellValue('F' . $totalRow, 'Rp ' . number_format($this->totalHarga, 0, ',', '.'));

        $sheet->getStyle('E' . $totalRow . ':F' . $totalRow)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        for ($i = 1; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        $sheet->getStyle('A1:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E1:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F1:F' . $totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('G1:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H1:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I1:I' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('D1:D' . $lastRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('E1:E' . $lastRow)->getAlignment()->setWrapText(true);

        for ($i = 2; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':' . $lastColumn . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F3F4F6'],
                    ],
                ]);
            }
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}