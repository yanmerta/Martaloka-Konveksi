@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <div class="row row-cols-2">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="font-weight-bold d-inline">Bukti Pembayaran</h6>
                            <hr>
                            <div class="d-flex justify-content-center mt-3">
                                <img class="img-fluid" style="max-height: 400px; object-fit:fill;"
                                    src="{{ asset('bukti_pembayaran/' . $transaksi->bukti_pembayaran) }}"
                                    alt="Bukti pembayaran {{ $transaksi->bukti_pembayaran }}">
                            </div>

                        </div>

                    </div>



                </div>
                <div class="col">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Rincian Transaksi</h5> <br>
                            <hr>
                            <div class="row">
                                @foreach ($transaksi->detailTransaksi as $detailTransaksi)
                                    <div class="col-4 px-2">
                                        <div class="border d-flex justify-content-center mb-1">
                                            <img class="img-fluid" style="height: 100px; object-fit: contain;"
                                                src="{{ asset('produk/' . $detailTransaksi->produk->gambar_produk) }}"
                                                alt=" {{ $detailTransaksi->produk->gambar_produk }}">
                                        </div>

                                    </div>
                                    <div class="col-8">
                                        <h6 class="font-weight-bold">{{ $detailTransaksi->produk->nama_produk }}</h6>
                                        <span>{{ $detailTransaksi->qty }} Item</span> <br>
                                        <span>
                                            Rp.{{ number_format($detailTransaksi->produk->harga_produk) }}</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">ID Pesanan</label>
                        <input type="text" class="form-control" value="{{ $transaksi->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Metode Pembayaran</label>
                        <input type="text" class="form-control" value="{{ $transaksi->metode_pembayaran }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pemesan</label>
                        <input type="text" class="form-control" value="{{ $transaksi->user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Status Pembayaran</label>
                        <input type="text" class="form-control" value="{{ $transaksi->status_pembayaran }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="text" class="form-control" value="Rp.{{ number_format($transaksi->total_harga) }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Transaksi</label>
                        <input type="text" class="form-control"
                            value="{{ $transaksi->created_at->isoFormat('dddd, D MMMM Y') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="" class="form-control" cols="30" rows="2" readonly>{{ $transaksi->catatan }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 card mt-4 px-3 py-5">
            <div class="row row-cols-2">
                <div class="col ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-weight-bold">Progress terakhir</h4>
                            <hr>
                            <ul>
                                @foreach ($transaksi->progress as $index => $item)
                                    <li class="mb-3">
                                        <h6 class="font-weight-bold">{{ $item->nama_progress }} {!! $index == 0 ? '<span class="badge badge-success"> Status terakhir </span>' : '' !!}
                                        </h6>

                                        {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss') }}
                                        <br>
                                        <a href="{{ route('progress-pembelian.show', ['transaksi' => $transaksi, 'progress' => $item->id]) }}"
                                            class="btn btn-primary btn-sm ">Detail</a>
                                        <a href="{{ route('progress-pembelian.edit', ['transaksi' => $transaksi, 'progress' => $item->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('progress-pembelian.destroy', ['transaksi' => $transaksi, 'progress' => $item->id]) }}"
                                            class="btn btn-danger btn-sm btn-outline">Hapus</a>

                                    </li>
                                @endforeach

                            </ul>


                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('progress-pembelian.store', $transaksi) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Progress</label>
                                    <input type="text" name="nama_progress" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Progress</label>
                                    <textarea rows="3" cols="30" name="deskripsi_progress" class="form-control">  </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Gambar Progress</label>
                                    <input type="file" class="form-control" accept="image/*" name="gambar_progress">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Tambahkan progress
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
