@extends('admin.layout')
@section('title', 'User Manajemen')
@section('content')
    <div class="container-fluid px-2">
        <div class="card shadow border-5 mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- <h5 class="mb-0 text-black fw-bold">Management User</h5> --}}
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus-circle "></i> Tambah User
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Search & Filter Section -->
                <div class="row mt-4 mb-3">
                    <div class="col-md-5">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Cari username atau email...">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-mb-2">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="input-group">
                                <select name="filter" id="filter" class="form-select"
                                    style="border: 1px solid #ccc; box-shadow: none;">
                                    <option value="">-- Filter Role --</option>
                                    <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="user" {{ request('filter') == 'user' ? 'selected' : '' }}>User</option>
                                    </option>
                                </select>
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-filter me-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3 text-end">
                        <a href="{{ route('users.index') }}" class="btn btn-warning">
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

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 25%">Email</th>
                                <th style="width: 15%">Role</th>
                                <th style="width: 20%">Tanggal Dibuat</th>
                                <th class="text-center" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match ($user->role) {
                                                'admin' => 'primary',
                                                'staff' => 'info',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">{{ $user->role }}</span>
                                    </td>
                                    <td>{{ $user->created_at->isoFormat('D MMMM Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="users/{{ $user->id }}" method="POST" style="display:inline"
                                                id="delete-form-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $user->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <img src="{{ asset('images/no-data.png') }}" alt="No Data"
                                            style="width: 100px; opacity: 0.5">
                                        <p class="text-muted mt-2">Tidak ada data user</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari
                        {{ $data->total() }} data
                    </div>
                    <div>
                        {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
