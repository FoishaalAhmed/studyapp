@extends('backend.layouts.app')

@section('title', __('System Settings'))

@section('css')
    <link rel="stylesheet" href="{{ asset('public/assets/backend/css/tagify.css') }}">
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('System Settings') }}</h4>
                        <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="app-name" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('App Name') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="text" name="name" id="app-name" class="form-control" placeholder="{{ __('App Name') }}" required="" value="{{ settings('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dark-logo"
                                    class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Dark Logo') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="file" id="dark-logo-input" class="form-control" name="dark_logo">
                                    <p class="font-13 text-muted mb-2 fw-bolder">
                                        {{ __('*Recommended Dimension: 98 px * 20 px') }}</p>
                                    <img src="{{ asset(darkLogo()) }}" alt="{{ __('Dark Logo') }}" class="large-logo"
                                        id="dark-logo-photo">
                                    @error('dark_logo')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="light-logo"
                                    class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Light Logo') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="file" id="light-logo-input" class="form-control" name="light_logo">
                                    <p class="font-13 text-muted mb-2 fw-bolder">
                                        {{ __('*Recommended Dimension: 98 px * 20 px') }}</p>
                                    <img src="{{ asset(lightLogo()) }}" alt="{{ __('Light Logo') }}" class="large-logo"
                                        id="light-logo-photo">
                                    @error('light_logo')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="small-logo" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Small Logo') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="file" id="small-logo-input" class="form-control" name="small_logo">
                                    <p class="font-13 text-muted mb-2 fw-bolder">{{ __('*Recommended Dimension: 22 px * 22 px') }}</p>
                                    <img src="{{ asset(smallLogo()) }}" alt="{{ __('Small Logo') }}" class="small-logo" id="small-logo-photo">
                                    @error('small_logo')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="favicon" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Favicon') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="file" id="favicon-input" class="form-control" name="favicon">
                                    <p class="font-13 text-muted mb-2 fw-bolder">{{ __('*Recommended Dimension: 22 px * 22 px') }}</p>

                                    <img src="{{ asset(getFavIcon()) }}" alt="{{ __('Favicon') }}" class="small-logo" id="favicon-photo">

                                    @error('favicon')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="row-per-page" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Row Per Page') }}</label>
                                <div class="col-8 col-xl-4">
                                    <select id="row-per-page" class="form-select" name="row_per_page" required="">
                                        <option value="10" {{ settings('row_per_page') == 10 ? 'selected' : '' }} >{{ __('10') }}</option>
                                        <option value="25" {{ settings('row_per_page') == 25 ? 'selected' : '' }} >{{ __('25') }}</option>
                                        <option value="50" {{ settings('row_per_page') == 50 ? 'selected' : '' }} >{{ __('50') }}</option>
                                        <option value="100" {{ settings('row_per_page') == 100 ? 'selected' : '' }} >{{ __('100') }}</option>
                                    </select>
                                    @error('row_per_page')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="max-file-size" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Max File Size') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="text" name="max_file_size" id="max-file-size" class="form-control" placeholder="{{ __('Max File Size') }}" required="" value="{{ old('max_file_size', settings('max_file_size')) }}">
                                    <p class="font-13 text-muted mb-2 fw-bolder">{{ __('*The value must be less than or equal to 20 MB') }}</p>
                                    @error('max_file_size')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="admin-security" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Admin Security') }}</label>
                                <div class="col-8 col-xl-4">
                                    <select id="admin-security" class="form-select" name="admin_security" required="">
                                        <option value="Off" {{ settings('admin_security') == 'Off' ? 'selected' : '' }} >{{ __('Off') }}</option>
                                        <option value="On" {{ settings('admin_security') == 'On' ? 'selected' : '' }} >{{ __('On') }}</option>
                                    </select>
                                    @error('admin_security')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ip-address" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Ip Address') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="text" name="ip_address" id="ip-address" class="form-control" required="" value="{{ settings('ip_address') }}">
                                    @error('ip_address')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.settings.create') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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

@section('js')
    <script src="{{ asset('public/assets/backend/libs/tagify/jQuery.tagify.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/tagify/tagify.min.js') }}"></script>
    <script src="{{ asset('Modules/Setting/Resources/assets/js/setting.js') }}"></script>
@endsection