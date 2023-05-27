<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/backend/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('public/assets/backend/js/head.js') }}"></script>

    <!-- Bootstrap css -->
    <link href="{{ asset('public/assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{ asset('public/assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Style css -->
    <link href="{{ asset('public/assets/backend/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('public/assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/assets/backend/images/logo-dark.png') }}" alt="" height="22">
                                        </span>
                                    </a>

                                    <a href="{{ url('/') }}" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/assets/backend/images/logo-light.png') }}" alt="" height="22">
                                        </span>
                                    </a>
                                </div>
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
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="{{ __('Enter your password') }}">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
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
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        2015 -
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; UBold theme by <a href="#" class="text-white-50">Coderthemes</a>
    </footer>

</body>

</html>
