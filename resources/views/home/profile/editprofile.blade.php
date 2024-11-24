@extends('home.home-layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Profile Update Section -->
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between"
                        style="background: #2A303C; color: white; padding: 1.5rem;">
                        <div>
                            <h4 class="mb-1">Update Profile</h4>
                            <p class="mb-0 text-light-50 small">Update your account's profile information</p>
                        </div>
                        <i class="bi bi-person-circle fs-3"></i>
                    </div>

                    <div class="card-body p-4">
                        <form method="post" action="{{ route('profileuser.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <!-- Name Input -->
                                <div class="col-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email Input -->
                                <div class="col-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Address Input -->
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-geo-alt"></i>
                                        </span>
                                        <input type="text" name="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror"
                                            value="{{ old('alamat', $user->alamat) }}" required>
                                    </div>
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Phone Input -->
                                <div class="col-12 mb-4">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-phone"></i>
                                        </span>
                                        <input type="tel" name="nomor_hp"
                                            class="form-control @error('nomor_hp') is-invalid @enderror"
                                            value="{{ old('nomor_hp', $user->nomor_hp) }}" required>
                                    </div>
                                    @error('nomor_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Changes
                                </button>
                                @if (session('status') === 'profile-updated')
                                    <div class="ms-3 text-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Profile updated successfully
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white d-flex align-items-center justify-content-between"
                        style="padding: 1.5rem;">
                        <h4 class="mb-0">Delete Account</h4>
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div class="card-body p-4">
                        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                Once your account is deleted, all of its resources and data will be permanently deleted.
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="mb-3">
                                <label class="form-label">Password Confirmation</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password to confirm" required>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i>
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        .input-group-text {
            border: none;
        }

        .form-control {
            border: 1px solid #e5e5e5;
            padding: 0.6rem 0.75rem;
        }

        .form-control:focus {
            border-color: #2A303C;
            box-shadow: 0 0 0 0.2rem rgba(42, 48, 60, 0.15);
        }

        .btn-primary {
            background-color: #2A303C;
            border-color: #2A303C;
        }

        .btn-primary:hover {
            background-color: #1a1f28;
            border-color: #1a1f28;
        }

        .border-danger {
            border: 1px solid #dc3545 !important;
        }

        .alert {
            border: none;
            border-radius: 8px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Animation for success message */
        .text-success {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Add Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
