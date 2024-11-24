@extends('admin.layout')
@section('title', 'Edit kategori')
@section('content')
    <form action="{{ route('kategori.update', $kategori) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="">Nama Kategori</label>
            <input id="" class="form-control" type="text" name="nama_kategori"
                value="{{ $kategori->nama_kategori }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

    </form>
@endsection
