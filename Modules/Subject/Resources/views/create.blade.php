@extends('backend.layouts.app')

@section('title', __('New Subject'))

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
                        <h4 class="header-title">{{ __('New Subject') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Subject') }}</a>
                        </p>
                        <form action="{{ route('admin.subjects.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Name') }}</label>
                                <div class="col-8 col-xl-7">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" required="" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Category') }}</label>
                                <div class="col-8 col-xl-7">
                                    <select class="form-control select2-multiple" name="category_ids[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Choose Prefered Categories') }}">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, old('category_ids')) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_ids')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="photo" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Photo') }}</label>
                                <div class="col-8 col-xl-7">
                                    <input type="file" id="subject-photo-input" class="form-control" name="photo">
                                    <p class="font-13 text-muted mb-2 fw-bolder">{{ __('*Recommended Dimension: 22 px * 22 px') }}</p>

                                    <img src="" alt="{{ __('Photo') }}" class="large-logo" id="subject-photo">

                                    @error('photo')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('Modules/Subject/Resources/assets/js/subject.js') }}"></script>
@endsection