@extends('backend.layouts.app')

@section('title', __('Update Ebook'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Modules/Ebook/Resources/assets/css/ebook.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Update Ebook') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.ebooks.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Ebook') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.ebooks.update', $ebook->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Category') }}</label>
                                    <select class="form-control" name="child_category_id" id="child_category_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $ebook->child_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('child_category_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Subject') }}</label>
                                    <select class="form-control" name="subject_id" id="subject_id" data-toggle="select2" data-width="100%">
                                        <option value="">{{ __('Select One') }}</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ $subject->id == $ebook->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $ebook->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Type') }}</label>
                                    <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                        <option value="Free" {{ 'Free' == old('type') || $ebook->type ? 'selected' : '' }}>{{ __('Free') }}</option>
                                        <option value="Premium" {{ 'Premium' == old('type') || $ebook->type ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3" id="price-div" style="display:{{  $ebook->type == 'Free' ? 'none' : '' }}">
                                    <label class="form-label">{{ __('Price') }}</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price', $ebook->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="card card-border">
                                        <h5 class="card-title text-center mt-2 text-strong">{{ __('Thumb Image') }}</h5>
                                        <img class="card-img-top ebook-file" id="thumb-photo" src="{{ file_exists($ebook->thumb) ?  asset($ebook->thumb) : asset('public/images/dummy/about.jpg') }}" alt="{{ __('Thumb') }}">
                                        <div class="card-body">
                                            <input type="file" name="thumb" class="form-control" id="thumb-photo-input">
                                            @error('thumb')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="card card-border">
                                         <h5 class="card-title text-center mt-2 text-strong">{{ __('Ebook File') }}</h5>
                                        <img class="card-img-top ebook-file" src="{{ asset('public/images/dummy/about.jpg') }}" alt="{{ __('File') }}">
                                        <div class="card-body">
                                            <input type="file" name="book" class="form-control">
                                            @error('book')
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
                                    <a href="{{ route('admin.ebooks.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>

    <script>
        'use strict';
        let csrfToken = "{{ csrf_token() }}";
        let url = "{{ route('get.child-category-subject') }}";
    </script>

    <script src="{{ asset('Modules/Ebook/Resources/assets/js/ebook.js') }}"></script>
@endsection