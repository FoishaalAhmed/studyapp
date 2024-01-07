@extends('backend.layouts.app')

@section('title', __('New Testimonial'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Testimonial') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.testimonials.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Testimonial') }}</a>
                        </p>
                        
                        <form action="{{ route('writer.testimonials.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" required="" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Position') }}</label>
                                            <input type="text" name="position" id="position" class="form-control" placeholder="{{ __('Position') }}" required="" value="{{ old('position') }}">
                                            @error('position')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Star') }}</label>
                                            <input type="text" name="star" id="star" class="form-control" required="" value="{{ old('star') }}">
                                            @error('star')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="message" class="form-label">{{ __('Message') }}</label>
                                            <textarea class="form-control" id="editor" name="message" placeholder="{{ __('Message') }}">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="testimonial-photo" src="{{ asset('Modules/Testimonial/Resources/assets/thumbnail.webp') }}" alt="{{ __('Testimonial Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="testimonial-photo-input">
                                            @error('photo')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('writer.testimonials.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="https://cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('Modules/Testimonial/Resources/assets/js/testimonial.js') }}"></script>
@endsection