<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, #4a90e2, #64b5f6, #4a90e2);
        }

        .main-title {
            font-size: 24px;
            color: #2c3e50;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sub-title {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .filter-info {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 4px solid #4a90e2;
            font-size: 13px;
        }

        .stats-container {
            display: table;
            width: 100%;
            margin: 20px 0;
            border-collapse: separate;
            border-spacing: 10px;
        }

        .stats-box {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            text-align: center;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .stats-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #4d5660;
            color: white;
            padding: 12px 8px;
            font-weight: bold;
            text-align: left;
            font-size: 14px;
            border-top: 1px solid #4d5660;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
            vertical-align: top;
            text-align: right;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tfoot td {
            font-weight: bold;
            background-color: #f1f1f1;
            border-top: 2px solid #4a90e2;
            padding: 15px 10px;
        }

        .text-center {
            text-align: center !important;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="main-title">Laporan Pendapatan Dashboard</h1>
        <p class="sub-title">
            Periode: {{ $selectedYear }}
        </p>
    </div>

    <div class="filter-info">
        <strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i') }}
    </div>

    <div class="stats-container">
        <div class="stats-box">
            <div class="stats-label">Total Pendapatan Produk</div>
            <div class="stats-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="stats-box">
            <div class="stats-label">Total Pendapatan Custom</div>
            <div class="stats-value">Rp {{ number_format($totalCustomRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="stats-box">
            <div class="stats-label">Total Pendapatan Keseluruhan</div>
            <div class="stats-value">Rp {{ number_format($totalRevenue + $totalCustomRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">Bulan</th>
                <th>Pendapatan Produk</th>
                <th>Pendapatan Custom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $index => $month)
                <tr>
                    <td class="text-center">{{ $month }}</td>
                    <td>Rp {{ number_format($revenueData[$index], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($customRevenueData[$index], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong></td>
                <td><strong>Rp {{ number_format($totalCustomRevenue, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }}</p>
        <p>© {{ date('Y') }} Martaloka Konveksi</p>
    </div>
</body>

</html>
