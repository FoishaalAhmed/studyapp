@extends('auth.layouts.app')

@section('title', __('Reset Password'))
@section('content')

<div class="col-md-8 col-lg-6 col-xl-4">
    <div class="card bg-pattern">

        <div class="card-body p-4">
            
            <div class="text-center w-75 m-auto">
                @include('auth.layouts.logo')
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="emailaddress" class="form-label">{{ __('Email') }}</label>
                    <input class="form-control" type="email" id="emailaddress" required="" placeholder="{{ __('Enter your email') }}" name="email" value="{{ old('email', $request->email) }}">
                    @error('email')
                        <div class="invalid-feedback error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input class="form-control" type="password" id="password" required="" placeholder="{{ __('Enter new password') }}" name="password">
                    @error('password')
                        <div class="invalid-feedback error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input class="form-control" type="password" id="password_confirmation" required="" placeholder="{{ __('Retype new password') }}" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-center d-grid">
                    <button class="btn btn-primary" type="submit"> {{ __('Reset Password') }} </button>
                </div>
            </form>

        </div> <!-- end card-body -->
    </div>
    <!-- end card -->
</div> <!-- end col -->

@endsection

