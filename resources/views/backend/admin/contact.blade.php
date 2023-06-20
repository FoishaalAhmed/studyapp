@extends('backend.layouts.app')

@section('title', __('Contact'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{ __('Contact') }}</h4>
                        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="{{ __('Email') }}" required="" value="{{ old('email', $contact->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('Phone') }}" required="" value="{{ old('phone', $contact->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="linkedin" class="form-label">{{ __('Linkedin') }}</label>
                                    <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="{{ __('Linkedin') }}" required="" value="{{ old('linkedin', $contact->linkedin) }}">
                                    @error('linkedin')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="facebook" class="form-label">{{ __('Facebook') }}</label>
                                    <input type="text" name="facebook" id="facebook" class="form-control" placeholder="{{ __('Facebook') }}" required="" value="{{ old('facebook', $contact->facebook) }}">
                                    @error('facebook')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="pinterest" class="form-label">{{ __('Pinterest') }}</label>
                                    <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="{{ __('Pinterest') }}" required="" value="{{ old('pinterest', $contact->pinterest) }}">
                                    @error('pinterest')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Address -->
                                <div class="col-lg-6 mb-3">
                                    <label for="address"
                                        class="form-label">{{ __('Address') }}</label>
                                    <textarea class="form-control" name="address" placeholder="{{ __('Address') }}"
                                        id="address">{{ old('address', $contact->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Google Map -->
                                <div class="col-lg-6 mb-3">
                                    <label for="map"
                                        class="form-label">{{ __('Google Map') }}</label>
                                    <textarea class="form-control" name="map" placeholder="{{ __('Google Map') }}"
                                        id="map">{{ old('map', $contact->map) }}</textarea>
                                    @error('map')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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