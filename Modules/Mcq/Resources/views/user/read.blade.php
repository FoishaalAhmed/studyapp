@extends('backend.layouts.app')

@section('title', __('Mcq Read'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li><a href="{{ route('user.mcq.practice', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-outline-primary rounded-pill waves-effect waves-light text-white"> {{ __('Practice') }} </a></li>
                                <li><a href="{{ route('user.mcq.exam', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-outline-primary rounded-pill waves-effect waves-light text-white ml-2"> {{ __('Take Exam') }} </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title"> <span class="span">|</span> {{ __('Mcq Read') }}</h4>
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
                                    <p>(ক). {{ $question->answer1 }}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p>(খ). {{ $question->answer2 }}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p>(গ). {{ $question->answer3 }}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p>(ঘ). {{ $question->answer4 }}</p>
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