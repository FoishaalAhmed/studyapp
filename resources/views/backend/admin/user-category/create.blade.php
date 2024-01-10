@extends('backend.layouts.app')

@section('title', __('App User Category'))

@section('css')
    <!-- Plugins css -->
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
                        <h4 class="header-title">{{ __('App User Category') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.app-user-categories.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Data') }}</a>
                        </p>
                        <form action="{{ route('admin.app-user-categories.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Category') }}</label>
                                    <select class="form-control" name="category_id" data-toggle="select2" data-width="100%" id="category" required="">
                                        <option value="">{{ __('Select A Category') }}</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="box-title">{{ __('MCQ Section') }}</h4>
                                <div class="col-lg-6 mb-3">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="{{ __('Title') }}" required="">
                                    <input type="hidden" name="type[]" value="MCQ">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="age" class="form-label">{{ __('MCQ Category') }}</label>
                                    <select class="form-control select2-multiple" name="MCQ[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select MCQ Categories') }}" id="mcq">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="box-title">{{ __('Ebook Section') }}</h4>
                                <div class="col-lg-6 mb-3">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="{{ __('Title') }}">
                                    <input type="hidden" name="type[]" value="Ebook">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="age" class="form-label">{{ __('Ebook Category') }}</label>
                                    <select class="form-control select2-multiple" name="Ebook[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select Ebook Categories') }}" id="ebook">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="box-title">{{ __('Lecture Sheet Section') }}</h4>
                                <div class="col-lg-6 mb-3">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="{{ __('Title') }}">
                                    <input type="hidden" name="type[]" value="Sheet">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="age" class="form-label">{{ __('Lecture Sheet Category') }}</label>
                                    <select class="form-control select2-multiple" name="Sheet[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select Lecture Sheet Categories') }}" id="lecture-sheet">
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.app-user-categories.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <!-- Init js-->
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>

    <script>
        'use strict';
        var csrfToken = "{{ csrf_token() }}";
        var url = "{{ route('get.sub-category-by-category') }}"
    </script>

    <script src="{{ asset('public/assets/backend/js/custom/user-category-create.js') }}"></script>
@endsection