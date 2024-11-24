<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Revenue Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            margin-top: 0;
        }

        .summary {
            margin-bottom: 30px;
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            width: 33.33%;
        }

        .summary .label {
            font-weight: bold;
            color: #666;
            font-size: 14px;
        }

        .summary .value {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        .details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details th,
        .details td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .details th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }

        .details td {
            color: #666;
        }

        .details tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .total-row {
            background-color: #f0f0f0 !important;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PENDAPATAN</h1>
        <p>Periode:
            {{ isset($selectedMonth) ? DateTime::createFromFormat('!m', $selectedMonth)->format('F') . ' ' : '' }}{{ $selectedYear }}
        </p>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="label">Total Pendapatan Produk</div>
                <div class="value">Rp {{ number_format($totalRevenue) }}</div>
            </td>
            <td>
                <div class="label">Total Pendapatan Custom</div>
                <div class="value">Rp {{ number_format($totalCustomRevenue) }}</div>
            </td>
            <td>
                <div class="label">Total Keseluruhan</div>
                <div class="value">Rp {{ number_format($totalRevenue + $totalCustomRevenue) }}</div>
            </td>
        </tr>
    </table>

    <table class="details">
        <thead>
            <tr>
                <th>Bulan</th>
                <th class="text-right">Pendapatan Produk</th>
                <th class="text-right">Pendapatan Custom</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $index => $month)
                <tr>
                    <td>{{ $month }}</td>
                    <td class="text-right">Rp {{ number_format($revenueData[$index]) }}</td>
                    <td class="text-right">Rp {{ number_format($customRevenueData[$index]) }}</td>
                    <td class="text-right">Rp {{ number_format($revenueData[$index] + $customRevenueData[$index]) }}
                    </td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td><strong>Total</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalRevenue) }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalCustomRevenue) }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalRevenue + $totalCustomRevenue) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dibuat otomatis pada {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>
