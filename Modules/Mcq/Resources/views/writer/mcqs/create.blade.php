@extends('backend.layouts.app')

@section('title', __('New Model Test'))

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
                        <h4 class="header-title">{{ __('New Model Test') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.mcqs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Model Test') }}</a>
                        </p>
                        
                        <form action="{{ route('writer.mcqs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
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
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Year') }}</label>
                                            <input type="text" name="year" id="year" class="form-control" placeholder="{{ __('Year') }}" required="" value="{{ old('year') }}">
                                            @error('year')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Time') }}</label>
                                            <input type="text" name="time" id="time" class="form-control" placeholder="{{ __('Time') }}" required="" value="{{ old('time') }}">
                                            @error('time')
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
                                        <div class="col-lg-4 mb-3" id="price-div" style="display:{{  old('type') != 'Premium' ? 'none' : '' }}">
                                            <label class="form-label">{{ __('Price') }}</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price') }}">
                                            @error('price')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>
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
                                        <img class="card-img-top img-fluid" id="mcq-photo" src="{{ asset('public/images/dummy/mcq.jpg') }}" alt="{{ __('Mcq Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="mcq-photo-input">
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
                                    <a href="{{ route('writer.mcqs.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>

    <script>
        'use strict';
        let csrfToken = "{{ csrf_token() }}";
        let url = "{{ route('get.child-category-subject') }}";
    </script>

    <script src="{{ asset('Modules/Mcq/Resources/assets/js/mcq.js') }}"></script>
@endsection