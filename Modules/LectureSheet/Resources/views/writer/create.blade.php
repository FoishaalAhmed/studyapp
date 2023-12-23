@extends('backend.layouts.app')

@section('title', __('New Leature Sheet'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Modules/LectureSheet/Resources/assets/css/sheet.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Leature Sheet') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.lecture-sheets.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Leature Sheet') }}</a>
                        </p>
                        
                        <form action="{{ route('writer.lecture-sheets.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Category') }}</label>
                                    <select class="form-control" name="child_category_id" id="child_category_id" data-toggle="select2" data-width="100%" required="">
                                        <option value="">{{ __('Select One') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('child_category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                        <option value="">{{ __('Select Category First') }}</option>
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Chapter') }}</label>
                                    <input type="text" name="chapter" id="chapter" class="form-control" placeholder="{{ __('Chapter') }}" required="" value="{{ old('chapter') }}">
                                    @error('chapter')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Type') }}</label>
                                    <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                        <option value="Free" {{ 'Free' == old('type') ? 'selected' : '' }}>{{ __('Free') }}</option>
                                        <option value="Premium" {{ 'Premium' == old('type') ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3" id="price-div" style="display:{{  old('type') == 'Premium' ? '' : 'none' }}">
                                    <label class="form-label">{{ __('Price') }}</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price') }}">
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
                                        <img class="card-img-top sheet-file" id="thumb-photo" src="{{ asset('public/images/dummy/sheet.png') }}" alt="{{ __('Thumb') }}">
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
                                         <h5 class="card-title text-center mt-2 text-strong">{{ __('Lecture Sheet File') }}</h5>
                                        <img class="card-img-top sheet-file" src="{{ asset('public/images/dummy/sheet.png') }}" alt="{{ __('File') }}">
                                        <div class="card-body">
                                            <input type="file" name="file" class="form-control">
                                            @error('file')
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
                                    <a href="{{ route('writer.lecture-sheets.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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

    <script src="{{ asset('Modules/LectureSheet/Resources/assets/js/sheet.js') }}"></script>
@endsection