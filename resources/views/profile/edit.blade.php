@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Update Password Section -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">{{ __('Update Password') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        <form method="post" action="{{ route('password.update') }}" class="mt-4">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="update_password_current_password">{{ __('Current Password') }}</label>
                                <input type="password" id="update_password_current_password" name="current_password"
                                    class="form-control" autocomplete="current-password">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="update_password_password">{{ __('New Password') }}</label>
                                <input type="password" id="update_password_password" name="password" class="form-control"
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                                <input type="password" id="update_password_password_confirmation"
                                    name="password_confirmation" class="form-control" autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            @if (session('status') === 'password-updated')
                                <p class="text-success mt-2">{{ __('Password updated successfully.') }}</p>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">{{ __('Delete Account') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="form-group">
                                <label for="delete_password">{{ __('Password') }}</label>
                                <input type="password" id="delete_password" name="password" class="form-control"
                                    placeholder="{{ __('Password') }}">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
