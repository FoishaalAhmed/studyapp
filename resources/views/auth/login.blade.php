@extends('auth.layouts.app')

@section('title', __('Log in'))
@section('content')
    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card bg-pattern">

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">
                    @include('auth.layouts.logo')
                    <p class="text-muted mb-4 mt-3">{{ __('Enter your email address and password to access admin
                        panel.') }}</p>
                </div>

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">{{ __('Email address') }}</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="emailaddress" required="" placeholder="{{ __('Enter your email') }}">
                        @error('email')
                            <div class="invalid-feedback error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" required="" class="form-control" placeholder="{{ __('Enter your password') }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                            <label class="form-check-label" for="checkbox-signin">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> {{ __('Log In') }} </button>
                    </div>

                </form>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                @if (Route::has('password.request'))
                <p> 
                    <a href="{{ route('password.request') }}" class="text-white-50 ms-1">{{ __('Forgot your password?') }}</a>
                </p>
                @endif

                <p class="text-white-50">{{ __("Don't have an account?") }} 
                    <a href="{{ route('register') }}" class="text-white ms-1"><b>{{ __('Sign Up') }}</b></a>
                </p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end col -->
@endsection



                
            