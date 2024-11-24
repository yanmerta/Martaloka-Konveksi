@extends('admin.layout')
@section('title', 'Progress Pembelian')
@section('content')

    <div class="table-responsive mt-5 ">
        <table class="table table-striped table-bordered shadow">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Produk - Qty - Harga</th>
                    <th scope="col">Status Transaksi</th>
                    <th scope="col">Gambar Progress Terakhir</th>
                    <th scope="col">progress Terakhir</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($transaksi as $data)
                    <tr class="">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->user->name }}</td>
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
                        <td>
                            @if ($data->status_pembayaran == 'Dalam Transaksi')
                                <button class="btn btn-secondary">Menunggu Pembayaran</button>
                            @elseif($data->status_pembayaran == 'Dibayar')
                                <button class="btn btn-success">Sudah Dibayar</button>
                            @elseif($data->status_pembayaran == 'Belum Dibayar')
                                <button class="btn btn-primary">Diterima</button>
                            @elseif($data->status_pembayaran == 'Ditolak')
                                <button class="btn btn-danger">Batal</button>
                            @elseif($data->status_pembayaran == 'Selesai')
                                <button class="btn btn-success">Selesai</button>
                            @else
                                <button class="btn btn-info">Status Tidak Valid</button>
                            @endif
                        </td>
                        <td>
                            @if ($data->progress->isNotEmpty() && isset($data->progress->first()->gambar_progress))
                                <img src="{{ asset('progress_pembelian/' . $data->progress->first()->gambar_progress) }}"
                                    width="200" alt="">
                            @else
                                <span>Tidak ada gambar progress</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->progress->isNotEmpty())
                                <span class="btn btn-sm btn-default">{{ $data->progress->first()->nama_progress }}</span>
                            @else
                                <span class="btn btn-sm btn-secondary">Progress belum tersedia</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('progress-pembelian.create', ['transaksi' => $data]) }}"
                                class="btn btn-info">Tambah progress</a>
                            {{-- <a href="{{ route('produk.destroy', $data->id) }}" class="btn btn-danger">Hapus</a> --}}

                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
