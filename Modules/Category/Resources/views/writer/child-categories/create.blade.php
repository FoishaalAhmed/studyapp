@extends('backend.layouts.app')

@section('title', __('New Child Category'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Child Category') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.child-categories.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Child Category') }}</a>
                        </p>
                        <form action="{{ route('writer.child-categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <label for="title" class="col-4 col-xl-3 col-form-label text-end">{{ __('Type') }}</label>
                                        <div class="col-8 col-xl-8">
                                            <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}" {{ $type->id == old('type') ? 'selected' : '' }}>{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="title" class="col-4 col-xl-3 col-form-label text-end">{{ __('Category') }}</label>
                                        <div class="col-8 col-xl-8">
                                            <select class="form-control" name="sub_category_id" id="sub_category_id" data-toggle="select2" data-width="100%" required="">
                                                <option value="">{{ __('Select Type First') }}</option>
                                            </select>
                                            @error('sub_category_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label for="name" class="col-4 col-xl-3 col-form-label text-end">{{ __('Name') }}</label>
                                        <div class="col-8 col-xl-8">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" required="" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="category-photo" src="{{ asset('public/images/dummy/about.jpg') }}" alt="{{ __('Category Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="category-photo-input">
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
                                    <a href="{{ route('writer.child-categories.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/sweet-alerts.init.js') }}"></script>

    <script>
        'use strict';
        let getSubCategoryRoute = "{{ route('get.sub-category') }}";
        let csrfToken = "{{ csrf_token() }}";
    </script>

<script src="{{ asset('Modules/Category/Resources/assets/js/child-category.js') }}"></script>
@endsection