<!-- resources/views/admin/exports/revenue-pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Pendapatan</h2>
        <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    </div>

    <h3>Transaksi Produk Regular</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Detail Produk</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regularTransactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>
                        @foreach ($transaction->detailTransaksi as $detail)
                            {{ $detail->produk->nama_produk }} ({{ $detail->qty }})<br>
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Transaksi Custom Design</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Deskripsi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customTransactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->deskripsi }}</td>
                    <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Ringkasan Pendapatan</h3>
        <p>Total Pendapatan Produk Regular: Rp {{ number_format($totalRegularRevenue, 0, ',', '.') }}</p>
        <p>Total Pendapatan Custom Design: Rp {{ number_format($totalCustomRevenue, 0, ',', '.') }}</p>
        <p>Total Keseluruhan: Rp {{ number_format($totalRegularRevenue + $totalCustomRevenue, 0, ',', '.') }}</p>
    </div>
</body>

</html>
