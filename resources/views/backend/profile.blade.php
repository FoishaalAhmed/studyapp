@extends('backend.layouts.app')

@section('title', __('Profile'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ __('Profile') }}</h4>
                    @include('alert')
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <form action="{{ route('profile.photo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card text-center">
                        <div class="card-body">
                            @if (file_exists(auth()->user()->photo))
                                <img src="{{ asset(auth()->user()->photo) }}" class="rounded-circle avatar-lg img-thumbnail"
                                    alt="profile-image" id="profile-photo">
                            @else
                                <img src="{{ asset('public/images/dummy/user.png') }}"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" id="profile-photo">
                            @endif
                            <p class="text-muted">{{ auth()->user()->name }}</p>

                            <div class="mb-3">
                                <input class="form-control" name="photo" type="file" onchange="readPicture(this)">
                            </div>

                            <button type="submit"
                                class="btn btn-success btn-xs waves-effect mb-2 waves-light">{{ __('Update Photo') }}</button>
                        </div>
                    </div>
                </form>
                <!-- end card -->
            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-fill navtab-bg">
                            <li class="nav-item">
                                <a href="#persional-info" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link active">
                                    {{ __('Persional Info') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#password" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    {{ __('Password') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="persional-info">
                                <form action="{{ route('profile.info') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="name" class="form-label">{{ __('Full Name') }}</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="{{ __('Full Name') }}" value="{{ auth()->user()->name }}"
                                                required="">
                                            @error('name')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Email -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="{{ __('Email') }}" value="{{ auth()->user()->email }}"
                                                required="">
                                            @error('email')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Phone -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                placeholder="{{ __('Phone') }}" value="{{ auth()->user()->phone }}"
                                                required="">
                                            @error('phone')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Age -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="age" class="form-label">{{ __('Age') }}</label>
                                            <input type="text" id="age" name="age" class="form-control"
                                                placeholder="{{ __('Age') }}" value="{{ auth()->user()->age }}"
                                                required="">
                                            @error('age')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Gender -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="gender" class="form-label">{{ __('Gender') }}</label>
                                            <select class="form-select" id="gender" name="gender" required="">
                                                <option value="Male"
                                                    {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>
                                                    {{ __('Male') }}</option>
                                                <option value="Female"
                                                    {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>
                                                    {{ __('Female') }}</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Present Address -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="present_address"
                                                class="form-label">{{ __('Present Address') }}</label>
                                            <textarea class="form-control" name="present_address" placeholder="{{ __('Present Address') }}"
                                                id="present_address">{{ auth()->user()->present_address }}</textarea>
                                            @error('present_address')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Permanent Address -->
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <label for="permanent_address"
                                                class="form-label">{{ __('Permanent Address') }}</label>
                                            <textarea class="form-control" name="permanent_address" placeholder="{{ __('Permanent Address') }}"
                                                id="permanent_address">{{ auth()->user()->permanent_address }}</textarea>
                                            @error('permanent_address')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="reset"
                                                class="btn btn-outline-danger waves-effect waves-light">{{ __('Reset') }}</button>
                                            <button type="submit"
                                                class="btn btn-outline-success waves-effect waves-light">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end persional-info section content -->

                            <div class="tab-pane" id="password">
                                <form action="{{ route('profile.password') }}" class="comment-area-box mt-2 mb-3"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <label for="old_password" class="form-label">{{ __('Old Password') }}</label>
                                            <input type="password" id="old_password" name="old_password" class="form-control"
                                                placeholder="{{ __('Old Password') }}"
                                                required="">
                                            @error('old_password')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="password" class="form-label">{{ __('New Password') }}</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="{{ __('New Password') }}"
                                                required="">
                                            @error('password')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="password_confirmation" class="form-label">{{ __('Retype New Password') }}</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                                placeholder="{{ __('Retype New Password') }}"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="reset"
                                                class="btn btn-outline-danger waves-effect waves-light">{{ __('Reset') }}</button>
                                            <button type="submit"
                                                class="btn btn-outline-success waves-effect waves-light">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end password content-->

                        </div> <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->
@endsection

@section('js')
    <script src="{{ asset('public/assets/backend/js/custom/profile.js') }}"></script>
@endsection
