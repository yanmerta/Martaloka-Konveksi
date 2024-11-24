@extends('admin.layout')
@section('title', 'Kategori')
@section('content')

    <!-- Tombol Tambah Kategori -->
    <a href="{{ route('kategori.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus-circle "></i> Tambah Kategori
    </a>

    <!-- Form Pencarian dan Filter -->
    <div class="row mt-4 mb-3">
        <div class="col-md-5">
            <form action="{{ route('kategori.index') }}" method="GET">
                <div class="input-group">
                    <input name="search" type="text" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari kategori..." aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="col-mb-2">
            <form action="{{ route('kategori.index') }}" method="GET">
                <div class="input-group">
                    <select name="filter" id="filter" class="form-select"
                        style="border: 1px solid #ccc; box-shadow: none;">
                        <option value="">--Filter kategori--</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat->nama_kategori }}"
                                {{ request('filter') == $kat->nama_kategori ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-5 text-end">
            <a href="{{ route('kategori.index') }}" class="btn btn-warning">
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

    <!-- Tabel Kategori -->
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered shadow">
            <thead>
                <tr>
                    <th scope="col" style="width: 70px">#</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            {{-- <a href="{{ route('kategori.destroy', $data->id) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </a> --}}
                            <form action="{{ route('kategori.destroy', $data->id) }}" method="POST"
                                style="display: inline;" id="delete-form-{{ $data->id }}">
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
    </div>

@endsection
