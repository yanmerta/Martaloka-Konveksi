@extends('admin.layout')
@section('title', 'Kontak')
@section('content')
    {{-- <a href="{{ route('kontak.create') }}" class="btn btn-info">
        <i class="fas fa-plus-circle"></i> Tambah Kontak
    </a> --}}

    <div class="table-responsive mt-4">
        <div class="row mt-4 mb-3">
            <div class="col-md-5">
                <form action="{{ route('kontak.index') }}" method="GET">
                    <div class="input-group">
                        <input name="search" type="text" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari kontak..." aria-label="Search">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-mb-3">
                <form action="{{ route('kontak.index') }}" method="GET">
                    <div class="input-group">
                        <select name="filter" id="filter" class="form-select"
                            style="border: 1px solid #ccc; box-shadow: none;">
                            <option value="">--Filter Jenis Kelamin--</option>
                            <option value="L" {{ request('filter') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('filter') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <button class="btn btn-secondary" type="submit" style="border: 1px solid #6c757d;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-2 text-end">
                <a href="{{ route('kontak.index') }}" class="btn btn-warning">
                    <i class="fas fa-retweet"></i> Reset
                </a>
            </div>
        </div>

        <table class="table table-striped table-bordered shadow">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Telepon</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center" style="width: 130px;">Jenis Kelamin</th>
                    <th scope="col" class="text-center"style="width: 300px;">Pesan</th>
                    <th scope="col" class="text-center" style="width: 280px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kontaks as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->telepon }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $data->pesan }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-5">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $data->id }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('kontak.destroy', $data->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                                <a href="https://wa.me/+62{{ $data->telepon ?? 85847728414 }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fa fa-phone" aria-hidden="true"></i> Hubungi
                                </a>
                            </div>
                        </td>

                    </tr>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 30px;">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">
                                        Detail Kontak
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Nama</div>
                                        <div class="col-md-8">: {{ $data->nama }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Telepon</div>
                                        <div class="col-md-8">: {{ $data->telepon }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Email</div>
                                        <div class="col-md-8">: {{ $data->email }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Jenis Kelamin</div>
                                        <div class="col-md-8">:
                                            {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Pesan</div>
                                        <div class="col-md-8">: {{ $data->pesan }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Dibuat pada</div>
                                        <div class="col-md-8">: {{ $data->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $kontaks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengatur posisi modal ke atas
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    let modalDialog = this.querySelector('.modal-dialog');
                    modalDialog.style.marginTop = '30px';
                    modalDialog.style.marginBottom = '0';
                });
            });
        });
    </script>

    <style>
        .modal-dialog {
            margin-top: 30px !important;
        }

        /* Memastikan modal muncul dari atas */
        .modal.fade .modal-dialog {
            transform: translate(0, -10px);
        }

        .modal.show .modal-dialog {
            transform: translate(0, 0);
        }
    </style>
@endpush
