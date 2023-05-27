@extends('backend.layouts.app')

@section('title', __('New Writer'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('All Writer') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.writers.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Writer') }}</a>
                        </p>
                        <form action="{{ route('admin.writers.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Full Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Full Name') }}" required="" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="{{ __('Email Address') }}" required="" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('Phone') }}" required="" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="age" class="form-label">{{ __('Age') }}</label>
                                    <input type="text" name="age" id="age" class="form-control" placeholder="{{ __('Age') }}" required="" value="{{ old('age') }}">
                                    @error('age')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
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
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input class="form-control" name="password" type="password" required="" id="password" placeholder="{{ __('Enter your password') }}">
                                    @error('password')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="password_confirmation" class="form-label">{{ __('Password') }}</label>
                                    <input class="form-control" name="password_confirmation" type="password" required="" id="password_confirmation" placeholder="{{ __('Retype your password') }}">
                                </div>
                            </div>
                            <div class="row">
                                <!-- Present Address -->
                                <div class="col-lg-6 mb-3">
                                    <label for="present_address"
                                        class="form-label">{{ __('Present Address') }}</label>
                                    <textarea class="form-control" name="present_address" placeholder="{{ __('Present Address') }}"
                                        id="present_address">{{ old('present_address') }}</textarea>
                                    @error('present_address')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Permanent Address -->
                                <div class="col-lg-6 mb-3">
                                    <label for="permanent_address"
                                        class="form-label">{{ __('Permanent Address') }}</label>
                                    <textarea class="form-control" name="permanent_address" placeholder="{{ __('Permanent Address') }}"
                                        id="permanent_address">{{ old('permanent_address') }}</textarea>
                                    @error('permanent_address')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.writers.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection
