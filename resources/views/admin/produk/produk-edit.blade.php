@extends('admin.layout')
@section('title', 'Edit produk')
@section('content')
    <div class="px-3">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="">Kategori</label>
                <select name="kategori_id" id="" class="form-control">
                    @foreach ($kategori as $select)
                        <option value="{{ $select->id }}" {{ $select->id == $produk->id ? 'selected' : '' }}>
                            {{ $select->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">Nama Produk</label>
                <input id="" class="form-control" type="text" name="nama_produk"
                    value="{{ $produk->nama_produk }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Deskripsi</label>
                <textarea id="" class="form-control" name="deskripsi" rows="4">{{ $produk->deskripsi }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="">Harga Produk</label>
                <input id="" class="form-control" type="number" name="harga_produk"
                    value="{{ $produk->harga_produk }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Stok</label>
                <input id="" class="form-control" type="number" name="stok" value="{{ $produk->stok }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Gambar Produk</label>
                <input id="" class="form-control" type="file" name="gambar_produk" accept="image/*">
            </div>
            <button class="btn btn-primary mt-3" type="submit">Update</button>
        </form>
    </div>

@endsection
