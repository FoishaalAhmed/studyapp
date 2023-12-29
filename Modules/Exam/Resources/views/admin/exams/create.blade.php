@extends('backend.layouts.app')

@section('title', __('New Exam'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Exam') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.exams.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Exam') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.exams.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <input type="hidden" name="model_test_id" value="{{ $model->id }}">
                                    <div class="row mb-3">
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Category') }}</label>
                                            <select class="form-control" name="category_id" id="category_id" data-toggle="select2" data-width="100%" required="">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="name" class="form-label">{{ __('Exam Type') }}</label>
                                            <select class="form-control" name="exam_type" id="exam_type" data-toggle="select2" data-width="100%" required="">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}" {{ $type->id == old('exam_type') ? 'selected' : '' }}>{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('exam_type')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3" style="display: {{ old('exam_type') != 1 ? 'none' : '' }}" id="subject-div">
                                            <label for="name" class="form-label">{{ __('Subject') }}</label>
                                            <select class="form-control" name="subject_id" id="subject_id" data-toggle="select2" data-width="100%">
                                                <option value="">{{ __('Select Category First') }}</option>
                                            </select>
                                            @error('subject_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $model->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3" style="display: {{ old('exam_type') != 3 ? 'none' : '' }}" id="chapter-div">
                                            <label class="form-label">{{ __('Chapter') }}</label>
                                            <input type="text" name="chapter" id="chapter" class="form-control" placeholder="{{ __('Chapter') }}" value="{{ old('chapter') }}">
                                            @error('chapter')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Mark Per Question') }}</label>
                                            <input type="text" name="mark_per_question" id="mark_per_question" class="form-control" placeholder="{{ __('Mark Per Question') }}" required="" value="{{ old('mark_per_question') }}">
                                            @error('mark_per_question')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Negative Mark') }}</label>
                                            <input type="text" name="negative_mark" id="negative_mark" class="form-control" placeholder="{{ __('Negative Mark') }}" required="" value="{{ old('negative_mark') }}">
                                            @error('negative_mark')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Time') }}</label>
                                            <input type="text" name="time" id="time" class="form-control" placeholder="{{ __('Time') }}" required="" value="{{ old('time', $model->time) }}">
                                            @error('time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
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
                                        <div class="col-lg-4 mb-3" id="price-div" style="display:{{ old('type') != 'Premium' ? 'none' : '' }}">
                                            <label class="form-label">{{ __('Price') }}</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price') }}">
                                            @error('price')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Start Date') }}</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="{{ __('Start Date') }}" data-provide="datepicker" value="{{ old('start_date') }}" required="">
                                            @error('start_date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Start Time') }}</label>
                                            <input type="text" name="start_time" id="basic-timepicker" class="form-control" placeholder="{{ __('Start Time') }}" value="{{ old('start_time') }}" required="">
                                            @error('start_time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Result Date') }}</label>
                                            <input type="text" name="result_date" id="result_date" class="form-control" placeholder="{{ __('Result Date') }}" data-provide="datepicker" value="{{ old('result_date') }}" required="">
                                            @error('result_date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Result Time') }}</label>
                                            <input type="text" name="result_time" id="preloading-timepicker" class="form-control" placeholder="{{ __('Result Time') }}" value="{{ old('result_time') }}" required="">
                                            @error('result_time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Note') }}</label>
                                            <input type="text" name="note" id="note" class="form-control" placeholder="{{ __('Note') }}" value="{{ old('note') }}">
                                            @error('note')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="{{ __('Description') }}">{{ old('description', $model->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="exam-photo" src="{{ asset('public/images/dummy/exam.webp') }}" alt="{{ __('Exam Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="exam-photo-input">
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
                                    <a href="{{ route('admin.exams.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>

    <script>
        'use strict';
        let csrfToken = "{{ csrf_token() }}";
        let url = "{{ route('get.category-subject') }}";
    </script>

    <script src="{{ asset('Modules/Exam/Resources/assets/js/exam.js') }}"></script>
@endsection