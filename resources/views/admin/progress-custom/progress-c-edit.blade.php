@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <img id="image-preview" class="img-fluid" src="{{ asset('progress_pembelian/' . $progress->gambar_progress) }}"
                alt="{{ $progress->nama_progress }}">

            <div class="d-gap mt-5"></div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ route('progress-custom.update', ['transaksi' => $transaksi, 'progress' => $progress]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Progress</label>
                            <input type="text" class="form-control" name="nama_progress"
                                value="{{ $progress->nama_progress }}">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Progress</label>
                            <input type="text" class="form-control" name="deskripsi_progress"
                                value="{{ $progress->deskripsi_progress }}">
                        </div>
                        <div class="form-group">
                            <label for="">Gambar Progress</label>
                            <input id="gambar_progress" type="file" class="form-control" accept="image/*"
                                name="gambar_progress">
                        </div>

                        <button class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }} " class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('gambar_progress').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

@endsection

