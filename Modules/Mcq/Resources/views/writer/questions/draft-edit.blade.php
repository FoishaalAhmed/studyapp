@extends('backend.layouts.app')

@section('title', __('Update Draft Mcq Question'))

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
                        <h4 class="header-title">{{ __('Update Draft Mcq Question') }}</h4>

                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.mcq-questions.index', ['model_test_id' => $modelTestId]) }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Mcq Question') }}</a>
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


                        <form action="{{ route('writer.mcq-questions.bulk.update') }}" method="post" id="mcq-question-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">{{ __('Model Test') }}</label>
                                    <select class="form-control" name="model_test_id" id="model_test_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}" {{ $model->id == old('model_test_id') || $model->id == $modelTestId ? 'selected' : '' }}>{{ $model->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('model_test_id')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            @php
                                $count = 1;
                            @endphp
                            
                            @foreach ($questions as $item)

                                <div class="row">
                                    <span><b>{{ $count }}.</b></span>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">{{ __('Question') }}</label>
                                        <input type="text" name="question[]" id="question<?= $count ?>" class="form-control" placeholder="{{ __('Question') }}" required="" value="{{ $item->question }}" >
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">{{ __('Answer1') }}</label>
                                        <input type="text" name="answer1[]" id="answer1<?= $count ?>" class="form-control" placeholder="{{ __('Answer1') }}" required="" value="{{ $item->answer1 }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">{{ __('Answer2') }}</label>
                                        <input type="text" name="answer2[]" id="answer2<?= $count ?>" class="form-control" placeholder="{{ __('Answer2') }}" required="" value="{{ $item->answer2 }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">{{ __('Answer3') }}</label>
                                        <input type="text" name="answer3[]" id="answer3<?= $count ?>" class="form-control" placeholder="{{ __('Answer3') }}" required="" value="{{ $item->answer3 }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">{{ __('Answer4') }}</label>
                                        <input type="text" name="answer4[]" id="answer4<?= $count ?>" class="form-control" placeholder="{{ __('Answer4') }}" required="" value="{{ $item->answer4 }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label text-success">{{ __('Correct Answer') }}</label>
                                        <input type="number" name="answer[]" id="answer<?= $count ?>" class="form-control" placeholder="{{ __('Correct Answer') }}" required="" value="{{ $item->answer }}">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">{{ __('Explanation') }}</label>
                                        <textarea name="explanation[]" id="explanation<?= $count ?>" placeholder="{{ __('Correct Answer Explanation') }}" rows="5" class="form-control fs-4">{{ $item->explanation }}</textarea>
                                    </div>
                                </div>

                                @php
                                    $count++;
                                @endphp

                            @endforeach

                            <div id="new-row"></div>

                            <div class="row">
                                <div class="col-lg-12 text-center">

                                    <input type="hidden" name="button" id="button">

                                    <a href="{{ route('writer.mcq-questions.index', ['model_test_id' => $modelTestId]) }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>

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
        let explanationTextOne = "{{ __('Explanation') }}";
        let explanationTextTwo = "{{ __('Correct Answer Explanation') }}";
        let csrfToken = "{{ csrf_token() }}";
        let ajaxQuestionSaveUrl = "{{ route('writer.mcq-questions.ajax.save') }}";
        let count = '{{ $count }}';
    </script>

    <script src="{{ asset('Modules/Mcq/Resources/assets/js/mcq-question-update.js') }}"></script>
@endsection