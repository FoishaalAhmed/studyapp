@extends('backend.layouts.app')

@section('title', __('Update Sub Category'))

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
                        <h4 class="header-title">{{ __('Update Sub Category') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Sub Category') }}</a>
                        </p>
                        <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                        <div class="row mb-3">
                                            <label for="name" class="col-4 col-xl-3 col-form-label text-end">{{ __('Name') }}</label>
                                            <div class="col-8 col-xl-8">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" required="" value="{{ old('name', $subCategory->name) }}">
                                                @error('name')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="title" class="col-4 col-xl-3 col-form-label text-end">{{ __('Category') }}</label>
                                            <div class="col-8 col-xl-8">
                                                <select class="form-control" name="category_id" data-toggle="select2" data-width="100%" required="">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') || $subCategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="title" class="col-4 col-xl-3 col-form-label text-end">{{ __('Type') }}</label>
                                            <div class="col-8 col-xl-8">
                                                <select class="form-control" name="type" data-toggle="select2" data-width="100%" required="">
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}" {{ $type->id == old('type') || $subCategory->type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback error">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="category-photo" src="{{ asset($subCategory->photo) }}" alt="{{ __('Category Image') }}">
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
    <script src="{{ asset('Modules/Category/Resources/assets/js/sub-category.js') }}"></script>
@endsection