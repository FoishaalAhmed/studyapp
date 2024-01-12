@extends('backend.layouts.app')

@section('title', __('App User Child Category'))

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
                        <h4 class="header-title">{{ __('Update App User Child Category') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.app-user-child-categories.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Data') }}</a>
                        </p>
                        <form action="{{ route('admin.app-user-child-categories.update', $appUserChildCategory->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <h4 class="box-title">{{ __(':x Section', ['x' => $appUserChildCategory->type]) }}</h4>
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Common For') }}</label>
                                    <select class="form-control" name="sub_category_id" data-toggle="select2" data-width="100%" id="category" required="">
                                         @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $appUserChildCategory->sub_category_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-lg-6 mb-3">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" name="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $appUserChildCategory->title) }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="age" class="form-label">{{ __(':x Common Category', ['x' => $appUserChildCategory->type]) }}</label>
                                    <select class="form-control select2-multiple" name="categories[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select :x Categories', ['x' => $appUserChildCategory->type]) }}" id="home-category">
                                        @php
                                            $categoryIds = explode(',', $appUserChildCategory->categories);
                                        @endphp

                                        @foreach ($subCategories as $item)
                                            <option value="{{ $item->id }}" {{ in_array($item->id, $categoryIds) ? 'selected' : "" }} >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.app-user-child-categories.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
        var csrf = "{{ csrf_token() }}";
        var type = "{{ $appUserChildCategory->type }}";
        var url = "{{ route('get.child-category-by-type-and-subcategory') }}";
    </script>
    <script src="{{ asset('public/assets/backend/js/custom/app-user-child-category-edit.js') }}"></script>
@endsection