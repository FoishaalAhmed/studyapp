@extends('backend.layouts.app')

@section('title', __('Mcq Exam Result'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span class="span">|</span> {{ __('Mcq Exam Result') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $answerIndex = ['N/A', 'ক', 'খ', 'গ', 'ঘ'];
                @endphp
                <div class="row">
                    @foreach ($questions as $question)
                        <div class="col-lg-6 mb-3">
                            <p> {{ $loop->index + 1 }}. {{ $question->question }}</p>
                            @php
                                $answer = $question->answer == null ? 0 : $question->answer;
                                $answers = ['N/A', $question->answer1, $question->answer2, $question->answer3, $question->answer4];
                            @endphp
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_1_{{ $loop->index }}" value="1" {{ optional($question->given_answer)->given_answer == 1 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="mcq_1_{{ $loop->index }}">(ক). {{ $question->answer1 }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_2_{{ $loop->index }}" value="2" {{ optional($question->given_answer)->given_answer == 2 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="mcq_2_{{ $loop->index }}">(খ). {{ $question->answer2 }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_3_{{ $loop->index }}" value="3" {{ optional($question->given_answer)->given_answer == 3 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="mcq_3_{{ $loop->index }}">(গ). {{ $question->answer3 }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_4_{{ $loop->index }}" value="4" {{ optional($question->given_answer)->given_answer == 4 ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="mcq_4_{{ $loop->index }}">(ঘ). {{ $question->answer4 }}</label>
                                    </div>
                                </div>
                                <p class="bg-primary text-white mt-2 ml-2 w-fit"> {{ __('Right Answer') }} : ({{ $answerIndex[$answer] }}) | {{ $answers[$answer] }} </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </div>
@endsection