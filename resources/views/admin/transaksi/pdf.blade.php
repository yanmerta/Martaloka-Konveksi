<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Transaksi Produk</title>
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
            width: 25%;
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
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .empty-row td {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        tfoot td {
            font-weight: bold;
            background-color: #f1f1f1;
            border-top: 2px solid #4a90e2;
            padding: 15px 10px;
        }

        .text-right {
            text-align: right;
        }

        .status-badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            min-width: 80px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }

        .product-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .product-item {
            margin-bottom: 5px;
            padding: 5px 0;
            border-bottom: 1px dashed #eee;
            font-size: 12px;
        }

        .product-qty {
            display: inline-block;
            background: #e9ecef;
            padding: 2px 6px;
            border-radius: 4px;
            margin: 0 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="main-title">Laporan Data Transaksi Produk</h1>
        <p class="sub-title">
            Periode: {{ $dateRange ?? date('01/m/Y') . ' - ' . date('t/m/Y') }}
        </p>
    </div>

    <div class="filter-info">
        @if ($filter)
            <strong>Status Pembayaran:</strong> {{ $filter }}<br>
        @endif
        <strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i') }}
    </div>

    <div class="stats-container">
        <div class="stats-box">
            <div class="stats-label">Total Transaksi</div>
            <div class="stats-value">{{ $transaksi->count() }}</div>
        </div>
        <div class="stats-box">
            <div class="stats-label">Total Pendapatan</div>
            <div class="stats-value">Rp {{ number_format($transaksi->sum('total_harga'), 0, ',', '.') }}</div>
        </div>
        <div class="stats-box">
            <div class="stats-label">Rata-rata Transaksi</div>
            <div class="stats-value">Rp
                {{ $transaksi->count() > 0 ? number_format($transaksi->sum('total_harga') / $transaksi->count(), 0, ',', '.') : 0 }}
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Detail Produk</th>
                <th>Status Pembayaran</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalKeseluruhan = 0;
            @endphp
            @forelse ($transaksi as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>
                        <ul class="product-list">
                            @foreach ($data->detailTransaksi as $detail)
                                <li class="product-item">
                                    <div class="product-info">
                                        <span class="product-name">{{ $detail->produk->nama_produk }}</span>
                                        <span class="product-qty">{{ $detail->qty }}</span>
                                    </div>
                                    <span class="product-price">Rp
                                        {{ number_format($detail->produk->harga_produk, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <span class="status-badge">
                            {{ $data->status_pembayaran }}
                        </span>
                    </td>
                    <td class="text-right">Rp {{ number_format($data->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @php
                    $totalKeseluruhan += $data->total_harga;
                @endphp
            @empty
                <tr class="empty-row">
                    <td colspan="6">Tidak ada data transaksi untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Keseluruhan:</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }}</p>
        <p>© {{ date('Y') }} Martaloka Konveksi</p>
    </div>

</body>

</html>
