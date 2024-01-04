@extends('auth.layouts.app')

@section('title', __('Forgot Password'))
@section('content')

    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card bg-pattern">

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">
                    @include('auth.layouts.logo')
                    <p class="text-muted mb-4 mt-3">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </p>

                    @if (session('status'))
                        <div class="invalid-feedback error">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">{{ __('Email address') }}</label>
                        <input class="form-control" type="email" id="emailaddress" required=""
                            placeholder="Enter your email" name="email">
                        @error('email')
                            <div class="invalid-feedback error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> {{ __('Email Password Reset Link') }} </button>
                    </div>

                </form>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-white-50">{{ __('Back to') }} <a href="{{ route('login') }}" class="text-white ms-1"><b>{{ __('Log in') }}</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->

@endsection

