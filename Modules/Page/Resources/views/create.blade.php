@extends('backend.layouts.app')

@section('title', __('New Page'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Page') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Page') }}</a>
                        </p>
                        <form action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" required="" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="title" class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
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
                                        <img class="card-img-top img-fluid" id="page-photo" src="{{ asset('public\images\dummy\about.jpg') }}" alt="{{ __('Page Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" onchange="readPicture(this, 'page-photo')">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script>
        'use strict';

        $(function() {
            CKEDITOR.replace('editor')
        });
    </script>
@endsection