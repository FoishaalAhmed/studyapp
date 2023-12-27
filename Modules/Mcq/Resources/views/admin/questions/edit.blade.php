@extends('backend.layouts.app')

@section('title', __('Update Question'))

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
                        <h4 class="header-title">{{ __('Update Question') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Question') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.questions.update', $question->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Model Test') }}</label>
                                    <select class="form-control" name="model_test_id" id="model_test_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}" {{ $model->id == $question->model_test_id ? 'selected' : '' }}>{{ $model->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('model_test_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Question') }}</label>
                                    <input type="text" name="question" id="question" class="form-control" placeholder="{{ __('Question') }}" required="" value="{{ old('question', $question->question) }}">
                                    @error('question')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer1') }}</label>
                                    <input type="text" name="answer1" id="answer1" class="form-control" placeholder="{{ __('Answer1') }}" required="" value="{{ old('answer1', $question->answer1) }}">
                                    @error('answer1')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer2') }}</label>
                                    <input type="text" name="answer2" id="answer2" class="form-control" placeholder="{{ __('Answer2') }}" required="" value="{{ old('answer2', $question->answer2) }}">
                                    @error('answer2')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer3') }}</label>
                                    <input type="text" name="answer3" id="answer3" class="form-control" placeholder="{{ __('Answer3') }}" required="" value="{{ old('answer3', $question->answer3) }}">
                                    @error('answer3')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer4') }}</label>
                                    <input type="text" name="answer4" id="answer4" class="form-control" placeholder="{{ __('Answer4') }}" required="" value="{{ old('answer4', $question->answer4) }}">
                                    @error('answer4')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label text-success">{{ __('Correct Answer') }}</label>
                                    <input type="text" name="answer" id="answer" class="form-control" placeholder="{{ __('Answer') }}" required="" value="{{ old('answer', $question->answer) }}">
                                    @error('answer')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="explanation" class="form-label">{{ __('Explanation') }}</label>
                                    <textarea class="form-control" id="editor" name="explanation" placeholder="{{ __('Explanation') }}">{{ old('explanation', $question->explanation) }}</textarea>
                                    @error('explanation')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('Modules/Mcq/Resources/assets/js/question.js') }}"></script>
@endsection