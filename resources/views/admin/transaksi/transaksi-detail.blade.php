@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <img class="img-fluid" src="{{ asset('bukti_Pembayaran/' . $transaksi->bukti_pembayaran) }}"
                alt="Bukti pembayaran {{ $transaksi->bukti_pembayaran }}">

            <div class="d-gap mt-5">

                @if ($transaksi->status_pembayaran == 'Belum Dibayar')
                    <button href="#" class="btn btn-block btn-info" id="terimaTransaksi" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-transaksi-id="{{ $transaksi->id }}">Terima transaksi</button>
                    <a href="{{ route('transaksi.tolak', $transaksi->id) }}" class="btn btn-block btn-danger"> Tolak
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



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Nomor Resi</h3>
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
                            <input type="text" class="form-control" id="no_resi" name="no_resi" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#terimaTransaksi').on('click', function() {
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
                    // Tambahkan pengisian nilai untuk input lainnya sesuai kebutuhan
                    $('#status_pembayaran').val(response.status_pembayaran);
                    // ...
                }
            });
        });
    });
</script>

