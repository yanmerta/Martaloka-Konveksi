@extends('admin.layout')
@section('title', 'Edit User')
@section('content')
    <div class="card">
        <div class="card-header">
            Edit Pengguna
        </div>
        <div class="card-body">
            <div class="container py-8">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-between">
                    </div>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST" class="my-3">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="name">Nama:</label>
                        <input type="text" name="name" value="{{ $user->name }}" placeholder="Nama Pengguna"
                            class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat:</label>
                        <input type="text" name="alamat" value="{{ $user->alamat }}" placeholder="Alamat Pengguna"
                            class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nomor_hp">Nomor HP:</label>
                        <input type="text" name="nomor_hp" value="{{ $user->nomor_hp }}" placeholder="Nomor HP Pengguna"
                            class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" placeholder="Email Pengguna"
                            class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm-password">Konfirmasi Password:</label>
                        <input type="password" name="confirm-password" placeholder="Konfirmasi Password"
                            class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="role">Jabatan:</label>
                        <select name="role" class="livesearch form-control">
                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                        </select>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-primary mx-1">Submit</button>
                        <a class="btn btn-secondary mx-1" href="{{ route('users.index') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $('.livesearch').select2();

        $('#dataTable').DataTable({
            language: {
                paginate: {
                    previous: '<span class="fa fa-chevron-left"></span>',
                    next: '<span class="fa fa-chevron-right"></span>' // or '→'
                }
            }
        });
    });
</script>
