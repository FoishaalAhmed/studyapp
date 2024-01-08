@extends('backend.layouts.app')

@section('title', __('New App Home Data'))

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
                        <h4 class="header-title">{{ __('New App Home Data') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.app-home.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Data') }}</a>
                        </p>
                        <form action="{{ route('admin.app-home.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Common For') }}</label>
                                    <select class="form-control select2-multiple" name="category_id[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select Categories') }}">
                                        @foreach ($categories as $item)
                                            <option data-type="MCQ" value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <label for="age" class="form-label">{{ __('MCQ Common Category') }}</label>
                                    <select class="form-control select2-multiple" name="MCQ[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select MCQ Categories') }}">
                                        @foreach ($mcqCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
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
                                    <label for="age" class="form-label">{{ __('Ebook Common Category') }}</label>
                                    <select class="form-control select2-multiple" name="Ebook[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select Ebook Categories') }}">
                                        @foreach ($ebookCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
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
                                    <label for="age" class="form-label">{{ __('Lecture Sheet Common Category') }}</label>
                                    <select class="form-control select2-multiple" name="Sheet[]" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="{{ __('Select Lecture Sheet Categories') }}">
                                        @foreach ($sheetCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.app-home.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
@endsection