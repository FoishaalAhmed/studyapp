<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ __('Registration') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/backend/images/favicon.ico') }}">

    <!-- Plugins css -->
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

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
                <div class="col-xl-9">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
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
                            </div>
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="row">
                                    <h4 class="mt-0 text-center">{{ __('Free Sign Up') }}</h4>
                                    <p class="text-muted mb-4 text-center">{{ __("Don't have an account? Create your account, it takes less than a minute") }}</p>
                                    <div class="col-lg-6">
                                        <div class="p-sm-3">
                                            <!-- Name-->
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">{{ __('Full Name') }}</label>
                                                <input class="form-control" name="name" type="text" id="fullname" placeholder="{{ __('Enter your name') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- Email-->
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">{{ __('Email address') }}</label>
                                                <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="{{ __('Enter your email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- Phone-->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                                <input class="form-control" name="phone" type="text" id="phone" required="" placeholder="{{ __('Enter phone number') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- Age-->
                                            <div class="mb-3">
                                                <label for="age" class="form-label">{{ __('Age') }}</label>
                                                <input class="form-control" name="age" type="number" id="age" required="" placeholder="{{ __('Enter your age') }}">
                                                @error('age')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="p-sm-3">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">{{ __('Gender') }}</label>
                                                <select class="form-select" id="gender" name="gender" required="">
                                                    <option value="Male">{{ __('Male') }}</option>
                                                    <option value="Female">{{ __('Female') }}</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="categories" class="form-label">{{ __('Categories') }}</label>
                                                <select class="form-control select2-multiple" name="category[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Choose Prefered Categories') }}">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="{{ __('Enter your password') }}">
                                                @error('password')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">{{ __('Password') }}</label>
                                                <input class="form-control" name="password_confirmation" type="password" required="" id="password_confirmation" placeholder="{{ __('Retype your password') }}">
                                            </div>
                                            <div class="mb-0">
                                                <button class="btn btn-success btn-sm float-sm-end" type="submit"> Sign Up </button>
                                                <div class="form-check pt-1">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end col -->
                                </div>
                            </form>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
       
        <script>document.write(new Date().getFullYear())</script> &copy; {{ __('UBold theme by') }} <a href="#" class="text-white-50">{{ __('Coderthemes') }}</a>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('public/assets/backend/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/assets/backend/js/app.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>

</body>

</html>
