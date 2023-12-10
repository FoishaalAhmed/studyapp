@extends('backend.layouts.app')

@section('title', __('Update Leature Sheet'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Update Leature Sheet') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.lecture_sheets.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Leature Sheet') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.lecture_sheets.update', $sheet->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Category') }}</label>
                                    <select class="form-control" name="child_category_id" id="child_category_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $sheet->child_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <select class="form-control" name="subject_id" id="subject_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($categories as $subject)
                                            <option value="{{ $subject->id }}" {{ $subject->id == $sheet->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Chapter') }}</label>
                                    <input type="text" name="chapter" id="chapter" class="form-control" placeholder="{{ __('Chapter') }}" required="" value="{{ old('chapter', $sheet->chapter) }}">
                                    @error('chapter')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Type') }}</label>
                                    <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                        <option value="Free" {{ 'Free' == old('type') || $sheet->type ? 'selected' : '' }}>{{ __('Free') }}</option>
                                        <option value="Premium" {{ 'Premium' == old('type') || $sheet->type ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3" id="price-div" style="display:{{  $sheet->type != 'Free' ? 'none' : '' }}">
                                    <label class="form-label">{{ __('Price') }}</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price', $sheet->price) }}">
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
                                        <img class="card-img-top img-fluid" id="thumb-photo" src="{{ file_exists($sheet->thumb) ?  asset($sheet->thumb) : asset('public/images/dummy/about.jpg') }}" alt="{{ __('Thumb') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="thumb-photo-input">
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
                                        <img class="card-img-top img-fluid" id="file-photo" src="{{ file_exists($sheet->file) ?  asset($sheet->file) : asset('public/images/dummy/about.jpg') }}" alt="{{ __('File') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="file-photo-input">
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
                                    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
        let url = "{{ route('get.get.child-category-subject') }}";
    </script>

    <script src="{{ asset('Modules/LectureSheet/Resources/assets/js/sheet.js') }}"></script>
@endsection