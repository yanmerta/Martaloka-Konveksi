<?php

namespace App\Models;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RevenueExport implements FromCollection, WithHeadings, WithStyles
{
    private $regularTransactions;
    private $customTransactions;
    private $year;
    private $month;
    private $day;

    public function __construct($regularTransactions, $customTransactions, $year, $month, $day)
    {
        $this->regularTransactions = $regularTransactions;
        $this->customTransactions = $customTransactions;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    public function collection()
    {
        $data = collect();

        foreach ($this->regularTransactions as $transaction) {
            $data->push([
                'Type' => 'Produk',
                'Month' => $transaction->month,
                'Count' => $transaction->count,
                'Revenue' => $transaction->revenue,
            ]);
        }

        foreach ($this->customTransactions as $transaction) {
            $data->push([
                'Type' => 'Custom',
                'Month' => $transaction->month,
                'Count' => $transaction->count,
                'Revenue' => $transaction->revenue,
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Type', 'Month', 'Count', 'Revenue'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
    }
}