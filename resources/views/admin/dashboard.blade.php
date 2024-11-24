@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlah_produk }}</h3>
                    <p>Jumlah Produk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('produk.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlah_pengguna }}</h3>
                    <p>Jumlah Pengguna</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-person-add"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlah_transaksiproduk }}</h3>
                    <p>Transaksi Produk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-cart"></i>
                </div>
                <a href="{{ route('transaksi.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlah_transaksicostum }}</h3>
                    <p>Transaksi Costum Design</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-cart"></i>
                </div>
                <a href="{{ route('transaksiCustom.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
        <div class="form-group">
            <label for="year">Pilih Tahun:</label>
            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                @for ($i = 2024; $i <= now()->year + 5; $i++)
                    <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </form>

    <!-- Grafik Transaksi -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Jumlah Transaksi Bulanan ({{ $selectedYear }})</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distribusi Transaksi ({{ $selectedYear }})</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pendapatan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Pendapatan Bulanan ({{ $selectedYear }})</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:400px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="info-box" style="border: 0.5px solid #1d98b4; background-color: transparent;">
                                <div class="info-box-content text-center py-2">
                                    <span class="info-box-text">Total Pendapatan Transaksi Produk</span>
                                    <span class="info-box-number">
                                        Rp. {{ number_format($totalRevenue) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box" style="border: 0.5px solid #00ffb7; background-color: transparent;">
                                <div class="info-box-content text-center py-2">
                                    <span class="info-box-text">Total Pendapatan Transaksi Custom</span>
                                    <span class="info-box-number">
                                        Rp. {{ number_format($totalCustomRevenue) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box" style="border: 0.5px solid #fa0808; background-color: transparent;">
                                <div class="info-box-content text-center py-2">
                                    <span class="info-box-text">Total Pendapatan Keseluruhan</span>
                                    <span class="info-box-number">
                                        Rp. {{ number_format($totalRevenue + $totalCustomRevenue) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Terbaru</h3>
                    <div class="card-tools">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Pemesan</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksi_terbaru as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $transaksi->user->name }}</td>
                                        <td>
                                            @if ($transaksi->status_pembayaran == 'Pending')
                                                <span class="badge bg-secondary">Menunggu Pembayaran</span>
                                            @elseif($transaksi->status_pembayaran == 'Dibayar')
                                                <span class="badge bg-success">Sudah Dibayar</span>
                                            @elseif($transaksi->status_pembayaran == 'Diterima')
                                                <span class="badge bg-primary">Diterima</span>
                                            @elseif($transaksi->status_pembayaran == 'Ditolak')
                                                <span class="badge bg-danger">Batal</span>
                                            @elseif($transaksi->status_pembayaran == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-secondary">Belum Dibayar</span>
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($transaksi->total_harga) }}</td>
                                        <td>
                                            <ul class="list-unstyled m-0">
                                                @foreach ($transaksi->detailTransaksi as $detail)
                                                    <li>{{ $detail->produk->nama_produk }} ({{ $detail->qty }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada transaksi terbaru</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Load Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1"></script>

        <script>
            $(document).ready(function() {
                // Data untuk grafik
                const labels = @json($labels);
                const produkData = @json($produkData);
                const customData = @json($customData);
                const totalProduk = @json($totalProduk);
                const totalCustom = @json($totalCustom);

                console.log("Initializing charts...");

                // Mengecek apakah data sudah benar
                console.log('Labels:', labels);
                console.log('Produk Data:', produkData);
                console.log('Custom Data:', customData);

                // Bar Chart
                const barCtx = document.getElementById('barChart').getContext('2d');
                if (barCtx) {
                    new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Transaksi Produk',
                                data: produkData,
                                backgroundColor: 'rgba(60, 141, 188, 0.7)',
                                borderColor: 'rgba(60, 141, 188, 1)',
                                borderWidth: 1
                            }, {
                                label: 'Transaksi Custom',
                                data: customData,
                                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            }
                        }
                    });
                } else {
                    console.error("Canvas element for barChart not found!");
                }

                // Pie Chart
                const pieCtx = document.getElementById('pieChart').getContext('2d');
                if (pieCtx) {
                    new Chart(pieCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Transaksi Produk', 'Transaksi Custom'],
                            datasets: [{
                                data: [totalProduk, totalCustom],
                                backgroundColor: [
                                    'rgba(60, 141, 188, 0.7)',
                                    'rgba(40, 167, 69, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(60, 141, 188, 1)',
                                    'rgba(40, 167, 69, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            }
                        }
                    });
                } else {
                    console.error("Canvas element for pieChart not found!");
                }
            });

            // Add this after your existing chart initializations
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'Pendapatan Produk',
                            data: @json($revenueData),
                            backgroundColor: 'rgba(60, 141, 188, 0.7)',
                            borderColor: 'rgba(60, 141, 188, 1)',
                            borderWidth: 1,
                            borderRadius: 0, // Menghilangkan lengkungan
                            pointStyle: 'rect' // Mengubah bentuk point menjadi kotak
                        }, {
                            label: 'Pendapatan Custom',
                            data: @json($customRevenueData),
                            backgroundColor: 'rgba(40, 167, 69, 0.7)',
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 1,
                            borderRadius: 0, // Menghilangkan lengkungan
                            pointStyle: 'rect' // Mengubah bentuk point menjadi kotak
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(value);
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'rect' // Mengubah bentuk legend menjadi kotak
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(context.raw);
                                        return label;
                                    }
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        barPercentage: 0.8, // Mengatur lebar bar
                        categoryPercentage: 0.9 // Mengatur jarak antar grup bar
                    }
                });
            } else {
                console.error("Canvas element for revenueChart not found!");
            }
        </script>
    @endpush
@endsection
