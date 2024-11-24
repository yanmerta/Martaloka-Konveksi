@extends('admin.layout')
@section('content')
    <!-- Tabel Transaksi -->
    <div class="table-responsive mt-3">

        <a href="{{ route('transaksi.exportPdf', ['search' => request('search'), 'filter' => request('filter'), 'date_range' => request('date_range')]) }}"
            class="btn btn-danger btn-sm me-2">
            <i class="fas fa-file-pdf"></i> Export To PDF
        </a>
        <a href="{{ route('transaksi.exportExcel', ['search' => request('search'), 'filter' => request('filter'), 'date_range' => request('date_range')]) }}"
            class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export To Excel
        </a>
        <!-- Form Pencarian, Filter Status, dan Filter Tanggal -->
        <div class="row mt-4 mb-8">
            <!-- Existing search column -->
            <div class="col-md-4">
                <form action="{{ route('transaksi.index') }}" method="GET" id="searchForm">
                    <div class="input-group">
                        <input name="search" type="text" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari berdasarkan nama pemesan..." aria-label="Search">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Existing status filter -->
            <div class="col-md-3">
                <form action="{{ route('transaksi.index') }}" method="GET" id="statusForm">
                    <div class="input-group">
                        <select name="filter" id="filter" class="form-select"
                            style="border: 1px solid #ccc; box-shadow: none;">
                            <option value="">--Filter status pembayaran--</option>
                            <option value="Selesai" {{ request('filter') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ request('filter') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                            <option value="Dalam Transaksi" {{ request('filter') == 'Dalam Transaksi' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="Dibayar" {{ request('filter') == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="Belum Dibayar" {{ request('filter') == 'Belum Dibayar' ? 'selected' : '' }}>
                                Diterima</option>
                        </select>

                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Calendar date filter -->
            <div class="col-md-3">
                <form action="{{ route('transaksi.index') }}" method="GET" id="dateForm">
                    <div class="input-group">
                        <input type="text" name="date_range" id="date_range" class="form-control"
                            value="{{ request('date_range') }}" placeholder="Pilih Tanggal">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-calendar"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reset button -->
            <div class="col-md-2 text-end">
                <a href="{{ route('transaksi.index') }}" class="btn btn-warning">
                    <i class="fas fa-retweet"></i> Reset
                </a>
            </div>
        </div>

        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Status Transaksi</th>
                    <th scope="col" class="w-25">Produk - Qty - Harga</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Bukti Pembayaran</th>
                    <th>Delivery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_pemesan }}</td>
                        <td>
                            @switch($data->status_pembayaran)
                                @case('Dalam Transaksi')
                                    <button class="btn btn-secondary">Menunggu Pembayaran</button>
                                @break

                                @case('Dibayar')
                                    <button class="btn btn-info">Sudah Dibayar</button>
                                @break

                                @case('Belum Dibayar')
                                    <button class="btn btn-warning">Belum Dibayar</button>
                                @break

                                @case('Ditolak')
                                    <button class="btn btn-danger">Ditolak</button>
                                @break

                                @case('Dibatalkan')
                                    <button class="btn btn-outline-danger">Dibatalkan</button>
                                @break

                                @case('Selesai')
                                    <button class="btn btn-success">Selesai</button>
                                @break

                                @case('Diterima')
                                    <button class="btn btn-primary">Diterima</button>
                                @break

                                @default
                                    <button class="btn btn-outline-secondary">Status Tidak Valid</button>
                            @endswitch
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach ($data->detailTransaksi as $detailTransaksi)
                                    <li> <b>{{ $detailTransaksi->produk->nama_produk }}</b> <b>-</b>
                                        <button class="btn btn-sm p-0 px-1 btn-info">{{ $detailTransaksi->qty }}</button>
                                        <span> <b>-</b>
                                            Rp.{{ number_format($detailTransaksi->produk->harga_produk) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td> Rp. {{ number_format($data->total_harga) }}</td>
                        <td>
                            @if ($data->bukti_pembayaran == null)
                                Belum ada
                            @else
                                <a href="{{ asset('bukti_Pembayaran/' . $data->bukti_pembayaran) }}"
                                    class="btn btn-info btn-lg">
                                    <i class="fa fa-image" aria-hidden="true"></i></a>
                            @endif
                        </td>

                        <td>
                            @if ($data->delivery == 'Diantar Ke Tempat Pemesan')
                                <button class="btn btn-light shadow border">Diantar Ke Tempat Pemesan</button>
                            @else
                                <button class="btn btn-dark">Ambil Di Martaloka</button>
                            @endif
                        </td>

                        <td>
                            @switch($data->status_pembayaran)
                                @case('Dalam Transaksi')
                                    <button class="btn btn-block btn-secondary">Menunggu menyelesaikan pesanan</button>
                                @break

                                @case('Dibayar')
                                    <button href="#" class="btn btn-block btn-info terimaTransaksi"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-transaksi-id="{{ $data->id }}">Terima transaksi</button>
                                    <button href="#" class="btn btn-block btn-danger" id="tolakTransaksi"
                                        data-bs-toggle="modal" data-bs-target="#tolakModal"
                                        data-transaksi-id="{{ $data->id }}">Tolak
                                        transaksi</button>
                                @break
                                @case('Diterima')
                                    <a href="{{ route('transaksi.selesaikan', $data->id) }}"
                                        class="btn btn-block btn-success">Selesaikan Transaksi</a>
                                @break
                            @endswitch
                            <a href="{{ route('transaksi.show', $data->id) }}"
                                class="btn btn-block btn-light border border-5">Detail Transaksi</a>
                            <a href="https://wa.me/+62{{ $data->nomor_hp_pemesan ?? 85847728414 }}"
                                class="btn btn-block btn-outline-warning text-dark">
                                <i class="fa fa-phone" aria-hidden="true"></i> Hubungi Pemesan
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-3">
        {{ $transaksi->links('pagination::bootstrap-5') }}
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="transaksiModalTitle">Tambahkan Nomor Resi</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.terima') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id" value="">
                        <div class="mb-3">
                            <label for="">Nama Pemesan</label>
                            <input type="text" class="form-control" value="" id="nama_pemesan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Status Transaksi</label>
                            <input type="text" class="form-control" value="" id="status_pembayaran" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="">Delivery</label>
                            <input type="text" class="form-control" value="" id="delivery" readonly>
                        </div>


                        <div class="kirim d-none" id="kirim">
                            <div class="mb-3">
                                <label for="kurir" class="form-label">Kurir</label>
                                <select class="form-control" aria-label="Default select example" id="kurir"
                                    name="kurir" required>
                                    <option selected>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="jnt">J&T</option>
                                    <option value="sicepat">Sicepat</option>
                                    <option value="anteraja">AnterAja</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_resi" class="form-label">Nomor Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi">
                            </div>
                            <div class="mb-3">
                                <label for="tujuan_antar" class="form-label">Tujuan Antar</label>
                                <input type="text" class="form-control" id="tujuan_antar" name="tujuan_antar">
                            </div>
                        </div>

                        <div class="pick-up d-none" id="pick-up">

                            <div class="mb-3">
                                <label  class="form-label">Alamat Martaloka Konveksi</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="3" readonly>Jalan Banteng, Banjar, Kec. Banjar, Kabupaten Buleleng, Bali 81152</textarea>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Tanggal dan Jam Ambil</label>
                                <input type="datetime-local" class="form-control" id="tanggal_ambil" name="tanggal_ambil">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" onclick="preventDefault()" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('transaksi.tolak') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="tolak_id" value="">
                        <div class="mb-3">
                            <label for="">Nama Pemesan</label>
                            <input type="text" class="form-control" value="" id="tolak_nama_pemesan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Status Transaksi</label>
                            <input type="text" class="form-control" value="" id="tolak_status_pembayaran"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan Ditolak</label>
                            <input type="text" class="form-control" name="keterangan_tambahan" value=""
                                id="tolak_keterangan_tambahan">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" onclick="preventDefault()" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Include Required Scripts -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script>
    $(document).ready(function() {
        // Initialize DateRangePicker
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'Pilih',
                cancelLabel: 'Batal',
                fromLabel: 'Dari',
                toLabel: 'Sampai',
                customRangeLabel: 'Pilih Rentang',
                weekLabel: 'M',
                daysOfWeek: [
                    'Min',
                    'Sen',
                    'Sel',
                    'Rab',
                    'Kam',
                    'Jum',
                    'Sab'
                ],
                monthNames: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ],
                firstDay: 1
            },
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],
                'Tahun Lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1,
                    'year').endOf('year')]
            },
            showDropdowns: true,
            minYear: 2020,
            maxYear: parseInt(moment().format('YYYY')),
            opens: 'right'
        });

        // Handle date range selection
        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });

        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // Preserve other filters when submitting date form
        $('#dateForm').on('submit', function(e) {
            e.preventDefault();
            const searchValue = $('input[name="search"]').val();
            const filterValue = $('#filter').val();
            const dateRange = $('#date_range').val();

            window.location.href =
                `{{ route('transaksi.index') }}?search=${searchValue}&filter=${filterValue}&date_range=${dateRange}`;
        });

        // Preserve date range when submitting other filters
        $('#searchForm, #statusForm').on('submit', function(e) {
            e.preventDefault();
            const searchValue = $('input[name="search"]').val();
            const filterValue = $('#filter').val();
            const dateRange = $('#date_range').val();

            window.location.href =
                `{{ route('transaksi.index') }}?search=${searchValue}&filter=${filterValue}&date_range=${dateRange}`;
        });


        // Fungsi untuk menangani klik tombol "Terima Transaksi"
        $('.terimaTransaksi').on('click', function() {
            var transaksiId = $(this).data('transaksi-id');

            // Lakukan AJAX request untuk mendapatkan detail transaksi
            $.ajax({
                url: '{{ route('response.detailTransaksi', ':id') }}'.replace(':id',
                    transaksiId),
                method: 'GET',
                success: function(response) {
                    // Isi nilai input pada modal
                    $('#id').val(transaksiId);
                    $('#nama_pemesan').val(response.nama_pemesan);
                    $('#status_pembayaran').val(response.status_pembayaran);
                    $('#delivery').val(response.delivery);
                    if (response.delivery === 'Diantar Ke Tempat Pemesan') {
                        $('#transaksiModalTitle').text('Diantar Ke Tempat Pemesan');
                        $('#kirim').removeClass('d-none');
                        $('#pick-up').addClass('d-none');
                    } else {
                        $('#transaksiModalTitle').text('Ambil Di Martaloka');
                        $('#pick-up').removeClass('d-none');
                        $('#kirim').addClass('d-none');
                    }
                }
            });
        });

        // Menghapus data saat modal ditutup
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#id').val('');
            $('#nama_pemesan').val('');
            $('#status_pembayaran').val('');
            $('#kurir').val('Pilih Kurir');
            $('#no_resi').val('');
            $('#tujuan_antar').val('');
            $('#kirim').addClass('d-none');
            $('#pick-up').addClass('d-none');
        });


        $('#tolakTransaksi').on('click', function() {
            var transaksiId = $(this).data('transaksi-id');

            // Lakukan AJAX request untuk mendapatkan detail transaksi
            $.ajax({
                url: '{{ route('response.detailTransaksi', ':id') }}'.replace(
                    ':id',
                    transaksiId),
                method: 'GET',
                success: function(response) {
                    $('#tolak_id').val(transaksiId);
                    $('#tolak_nama_pemesan').val(response.nama_pemesan);
                    $('#tolak_status_pembayaran').val(response.status_pembayaran);
                    // ...
                }
            });
        });
    });
</script>