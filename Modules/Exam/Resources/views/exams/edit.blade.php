@extends('backend.layouts.app')

@section('title', __('Update Exam'))

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
                        <h4 class="header-title">{{ __('Update Exam') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.exams.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Exam') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.sub-categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Category') }}</label>
                                            <select class="form-control" name="category_id" id="category_id" data-toggle="select2" data-width="100%" required="">
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
                                        <div class="col-lg-4 mb-3" style="display: {{ $exam->exam_type == 1 || old('exam_type') == 1 ? 'none' : '' }}" id="subject-div">
                                            <label for="name" class="form-label">{{ __('Subject') }}</label>
                                            <select class="form-control" name="subject_id" id="subject_id" data-toggle="select2" data-width="100%" required="">
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ $subject->id == old('subject_id') ? 'selected' : '' }}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subject_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $exam->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3" style="display: {{ $exam->exam_type != 3 ? 'none' : '' }}" id="chapter-div">
                                            <label class="form-label">{{ __('Chapter') }}</label>
                                            <input type="text" name="chapter" id="chapter" class="form-control" placeholder="{{ __('Chapter') }}" required="" value="{{ old('chapter', $exam->chapter) }}">
                                            @error('chapter')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Mark Per Question') }}</label>
                                            <input type="text" name="mark_per_question" id="mark_per_question" class="form-control" placeholder="{{ __('Mark Per Question') }}" required="" value="{{ old('mark_per_question', $exam->mark_per_question) }}">
                                            @error('mark_per_question')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Negative Mark') }}</label>
                                            <input type="text" name="negative_mark" id="negative_mark" class="form-control" placeholder="{{ __('Negative Mark') }}" required="" value="{{ old('negative_mark', $exam->negative_mark) }}">
                                            @error('negative_mark')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Time') }}</label>
                                            <input type="text" name="time" id="time" class="form-control" placeholder="{{ __('Time') }}" required="" value="{{ old('time', $exam->time) }}">
                                            @error('time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="name" class="form-label">{{ __('Type') }}</label>
                                            <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                                <option value="Free" {{ 'Free' == old('type') || $exam->type ? 'selected' : '' }}>{{ __('Free') }}</option>
                                                <option value="Premium" {{ 'Premium' == old('type') || $exam->type ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3" id="price-div" style="display:{{  $exam->type != 'Free' ? 'none' : '' }}">
                                            <label class="form-label">{{ __('Price') }}</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price', $exam->price) }}">
                                            @error('price')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Start Date') }}</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="{{ __('Start Date') }}" data-provide="datepicker" value="{{ old('start_date', date('m/d/Y', strtotime($exam->start_date))) }}" required="">
                                            @error('start_date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Start Time') }}</label>
                                            <input type="text" name="start_time" id="basic-timepicker" class="form-control" placeholder="{{ __('Start Time') }}" value="{{ old('start_time', date('H:i', strtotime($exam->start_time))) }}" required="">
                                            @error('start_time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Result Date') }}</label>
                                            <input type="text" name="result_date" id="result_date" class="form-control" placeholder="{{ __('Result Date') }}" data-provide="datepicker" value="{{ old('result_date', date('m/d/Y', strtotime($exam->result_date))) }}" required="">
                                            @error('result_date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Result Time') }}</label>
                                            <input type="text" name="result_time" id="preloading-timepicker" class="form-control" placeholder="{{ __('Result Time') }}" value="{{ old('result_time', date('H:i', strtotime($exam->result_time))) }}" required="">
                                            @error('result_time')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">{{ __('Note') }}</label>
                                            <input type="text" name="note" id="note" class="form-control" placeholder="{{ __('Note') }}" required="" value="{{ old('note', $exam->note) }}">
                                            @error('note')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="{{ __('Description') }}">{{ old('description', $exam->note) }}</textarea>
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