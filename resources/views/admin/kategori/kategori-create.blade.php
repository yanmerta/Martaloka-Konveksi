@extends('admin.layout')
@section('title', 'Tambah kategori')
@section('content')

    <div class="card">
        <div class="card-header">
            Tambah Kategori Baru
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Nama Kategori</label>
                    <input id="" class="form-control" type="text" name="nama_kategori">
                </div>
                <button type="submit" class="btn btn-primary">
                    Tambahkan
                </button>

            </form>
        </div>
    </div>

@endsection
