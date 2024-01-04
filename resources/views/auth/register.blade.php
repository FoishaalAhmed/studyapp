@extends('auth.layouts.app')

@section('title', __('Registration'))
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="col-xl-9">
        <div class="card bg-pattern">

            <div class="card-body p-4">

                <div class="text-center mb-4">
                    @include('auth.layouts.logo')
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
@endsection           

@section('js')
    <!-- Vendor js -->
    <script src="{{ asset('public/assets/backend/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/assets/backend/js/app.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
@endsection
