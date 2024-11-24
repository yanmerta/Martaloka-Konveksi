@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <img class="img-fluid" src="{{ asset('bukti_Pembayaran/' . $transaksi->bukti_pembayaran) }}"
                alt="Bukti pembayaran {{ $transaksi->bukti_pembayaran }}">

            <div class="d-gap mt-5">

                @if ($transaksi->status_pembayaran == 'Dibayar')
                    <a href="{{ route('transaksiCustom.terima', $transaksi->id) }}" class="btn btn-block btn-primary"> Terima
                        transaksi</a>
                    <a href="{{ route('transaksiCustom.tolak', $transaksi->id) }}" class="btn btn-block btn-danger"> Tolak
                        transaksi</a>
                @else
                    <button disabled class="btn btn-block btn-dark"> {{ $transaksi->status_pembayaran }}</button>
                @endif
            </div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
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
                        <label for="">Email Pemesan</label>
                        <input type="text" class="form-control" value="{{ $transaksi->email_pemesan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor HP Pemesan</label>
                        <input type="text" class="form-control" value="{{ $transaksi->nomor_hp_pemesan }}" readonly>
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
    </div>
@endsection
