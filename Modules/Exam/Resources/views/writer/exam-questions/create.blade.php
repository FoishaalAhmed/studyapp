@extends('backend.layouts.app')

@section('title', __('New Exam Question'))

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
                        <h4 class="header-title">{{ __('New Exam Question') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.exam-questions.index', ['exam_id' => $examId]) }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Exam Question') }}</a>
                        </p>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="toast fade show d-flex align-items-center text-white bg-danger border-0 mt-4 w-100 text-center mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-body">
                                        {{ $error }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif


                        <form action="{{ route('writer.exam-questions.store') }}" method="post" id="exam-question-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">{{ __('Exam') }}</label>
                                    <select class="form-control" name="exam_id" id="exam_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}" {{ $exam->id == old('exam_id') || $exam->id == $examId ? 'selected' : '' }}>{{ $exam->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <span><b>1.</b></span>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Question') }}</label>
                                    <input type="text" name="question[]" id="question1" class="form-control" placeholder="{{ __('Question') }}" required="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer1') }}</label>
                                    <input type="text" name="answer1[]" id="answer11" class="form-control" placeholder="{{ __('Answer1') }}" required="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer2') }}</label>
                                    <input type="text" name="answer2[]" id="answer21" class="form-control" placeholder="{{ __('Answer2') }}" required="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer3') }}</label>
                                    <input type="text" name="answer3[]" id="answer31" class="form-control" placeholder="{{ __('Answer3') }}" required="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">{{ __('Answer4') }}</label>
                                    <input type="text" name="answer4[]" id="answer41" class="form-control" placeholder="{{ __('Answer4') }}" required="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label text-success">{{ __('Correct Answer') }}</label>
                                    <input type="number" name="correct_answer[]" id="correct_answer1" class="form-control" placeholder="{{ __('Correct Answer') }}" required="">
                                </div>
                            </div>

                            <div id="new-row"></div>

                            <div class="row">
                                <div class="col-lg-12 text-center">

                                    <input type="hidden" name="button" id="button">

                                    <a href="{{ route('writer.exam-questions.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>

                                    <button type="button" id="draft" class="btn btn-outline-info waves-effect waves-light"><i class="fe-info"></i> {{ __('Draft') }}</button>

                                    <button type="button" id="save" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Save') }}</button>

                                    <button type="button" id="new-question" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-plus-square"></i> {{ __('Add New Question') }}</button>

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
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>

    <script>
        let questionText = "{{ __('Question') }}";
        let answerOneText = "{{ __('Answer1') }}";
        let answerTwoText = "{{ __('Answer2') }}";
        let answerThreeText = "{{ __('Answer3') }}";
        let answerFourText = "{{ __('Answer4') }}";
        let correctAnswerText = "{{ __('Correct Answer') }}";
        let csrfToken = "{{ csrf_token() }}";
        let ajaxQuestionSaveUrl = "{{ route('writer.exam-questions.ajax.save') }}"
    </script>

    <script src="{{ asset('Modules/Exam/Resources/assets/js/exam-question-add.js') }}"></script>
@endsection