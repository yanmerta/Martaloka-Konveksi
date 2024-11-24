@extends('admin.layout')
@section('title', 'Produk')
@section('content')
    <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus-circle "></i> Tambah Produk
    </a>

    <div class="table-responsive mt-4">
        <div class="row mb-3">
            <div class="col-md-5">
                <form action="{{ route('produk.index') }}" method="GET">
                    <div class="input-group">
                        <input name="search" type="text" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari..." aria-label="Search">
                        <button class="btn btn-secondary" type="submit" id="button-addon2">
                            <i class="fas fa-search"></i> Cari
                        </button>

                    </div>
                </form>
            </div>
            <div class="col-mb-3">
                <form action="{{ route('produk.index') }}" method="GET">
                    <div class="input-group">
                        <select name="filter" id="filter" class="form-select"
                            style="border: 1px solid #ccc; box-shadow: none;">
                            <option value="">--Filter kategori--</option>
                            <option value="polo" {{ request('filter') == 'polo' ? 'selected' : '' }}>Polo</option>
                            <option value="kemeja" {{ request('filter') == 'kemeja' ? 'selected' : '' }}>Kemeja</option>
                            <option value="jersey" {{ request('filter') == 'jersey' ? 'selected' : '' }}>Jersey</option>
                        </select>
                        <button class="btn btn-secondary" type="submit" id="button-addon2">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-end">
                <a href="{{ route('produk.index') }}" class="btn btn-warning">
                    <i class="fas fa-retweet"></i> Reset
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success bg-success text-white border-0 shadow-sm" role="alert">
                {{ session('success') }}
            </div>

            <style>
                .alert-success {
                    background-color: # d3e7d4 !important;
                    opacity: 0.8;
                }
            </style>
        @endif

        <table class="table table-striped table-bordered shadow">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center" style="width: 170px;">Kategori Produk</th>
                    <th scope="col" class="text-center" style="width: 200px;">Gambar Produk</th>
                    <th scope="col" class="text-center">Harga</th>
                    <th scope="col" class="text-center">Stok</th>
                    <th scope="col" class="text-center" style="width: 280px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_produk }}</td>
                        <td>{{ $data->kategori->nama_kategori }}</td>
                        <td>
                            <img src="{{ asset('produk/' . $data->gambar_produk) }}" width="200" alt="Gambar Produk">
                        </td>
                        <td>{{ number_format($data->harga_produk) }}</td>
                        <td class="text-center">{{ $data->stok }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-detail" data-id="{{ $data->id }}"
                                data-nama="{{ $data->nama_produk }}" data-kategori="{{ $data->kategori->nama_kategori }}"
                                data-harga="{{ $data->harga_produk }}" data-stok="{{ $data->stok }}"
                                data-deskripsi="{{ $data->deskripsi }}"
                                data-gambar="{{ asset('produk/' . $data->gambar_produk) }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <a href="{{ route('produk.edit', $data->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('produk.destroy', $data->id) }}" method="POST" style="display: inline;"
                                id="delete-form-{{ $data->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Detail Product Modal --}}
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="detail-gambar" src="" class="img-fluid rounded" alt="Gambar Produk"
                                    style="max-width: 400px; max-height: 400px; object-fit: contain;">
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th style="width: 150px;">Nama Produk</th>
                                        <td><span id="detail-nama" class="font-weight-bold"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><span id="detail-kategori"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>Rp. <span id="detail-harga"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td><span id="detail-stok"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td><span id="detail-deskripsi" class="detail-description"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $produk->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <style>
        /* Batasi ukuran gambar dalam modal */
        #detail-gambar {
            max-width: 200p%;
            max-height: 300px;
            object-fit: contain;
        }

        .detail-description {
            white-space: pre-wrap;
            word-break: break-word;
            max-height: 150px;
            overflow: auto;
        }
    </style>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function() {
                // Get data from button attributes
                const data = {
                    nama_produk: $(this).data('nama'),
                    kategori: {
                        nama_kategori: $(this).data('kategori')
                    },
                    harga_produk: $(this).data('harga'),
                    stok: $(this).data('stok'),
                    deskripsi: $(this).data('deskripsi'),
                    gambar_produk: $(this).data('gambar')
                };

                // Update modal content
                $('#detail-nama').text(data.nama_produk);
                $('#detail-kategori').text(data.kategori.nama_kategori);
                $('#detail-harga').text(new Intl.NumberFormat('id-ID').format(data.harga_produk));
                $('#detail-stok').text(data.stok);
                $('#detail-deskripsi').text(data.deskripsi || '-');
                $('#detail-gambar').attr('src', data.gambar_produk);

                // Show modal
                $('#detailModal').modal('show');
            });
        });
    </script>
@endpush
