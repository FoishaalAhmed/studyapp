@extends('backend.layouts.app')

@section('title', __('New Blog'))

@section('css')
    <link rel="stylesheet" href="{{ asset('public/assets/backend/css/tagify.css') }}">
    <link href="{{ asset('public/assets/backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Blog') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.blogs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Blog') }}</a>
                        </p>
                        
                        <form action="{{ route('writer.blogs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Date') }}</label>
                                            <input type="text" name="date" id="date" class="form-control" placeholder="{{ __('Date') }}" required="" value="{{ old('date') }}" data-provide="datepicker" autocomplete="off">
                                            @error('date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">{{ __('Tag') }}</label>
                                            <input type="text" name="tag" id="tag" class="form-control" required="" value="{{ old('tag') }}">
                                            @error('tag')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="content" class="form-label">{{ __('Content') }}</label>
                                            <textarea class="form-control" id="editor" name="content" placeholder="{{ __('Content') }}">{{ old('content') }}</textarea>
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="blog-photo" src="{{ asset('public/images/dummy/blog.jpg') }}" alt="{{ __('Blog Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="blog-photo-input">
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
                                    <a href="{{ route('writer.blogs.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/tagify/jQuery.tagify.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/tagify/tagify.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('Modules/Blog/Resources/assets/js/blog.js') }}"></script>
@endsection