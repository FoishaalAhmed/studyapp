@extends('backend.layouts.app')

@section('title', __('Exam Detail'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                @if ($exam->exam_user_count == 0)
                                    <li class="breadcrumb-item"><a href="{{ route('user.exams.enroll', $exam->id) }}" class="btn btn-outline-primary waves-effect waves-light">{{ __('Enroll Now') }}</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" class="btn btn-outline-primary waves-effect waves-light">{{ __('Already Enrolled') }}</a></li>
                                @endif
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('Exam Detail') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @include('alert')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-family-primary fw-semibold text-warning">{{ __('Title') }} : {{ $exam->title }}</h5>
                            <h5 class="font-family-primary fw-semibold text-warning">{{ __('Type') }} : {{ optional($exam->types)->name }}</h5>

                            @if (isset($exam->subject))
                                <h5 class="font-family-primary fw-semibold text-warning">{{ __('Subject') }} : {{ optional($exam->subject)->name }}</h5>
                            @endif

                            @if (isset($exam->chapter))
                                <h5 class="font-family-primary fw-semibold text-warning">{{ __('Chapter') }} : {{ $exam->chapter }}</h5>
                            @endif

                            <h5 class="font-family-primary fw-semibold text-warning">{{ __('Total Enrolled') }} : {{ $exam->exam_users_count }}</h5>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-family-primary fw-semibold text-primary">{{ __('Total Question') }} : {{ $questions }}</h5>
                            <h5 class="font-family-primary fw-semibold text-primary">{{ __('Mark Per Question') }} : {{ $exam->mark_per_question }}</h5>
                            <h5 class="font-family-primary fw-semibold text-primary">{{ __('Negative Marking') }} : {{ $exam->negative_mark }}</h5>
                            <h5 class="font-family-primary fw-semibold text-primary">{{ __('Total Time') }} : {{ $exam->time }}</h5>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-family-primary fw-semibold text-danger">{{ __('Exam Date') }} : {{ date('d M, Y', strtotime($exam->start_date)) }}</h5>
                            <h5 class="font-family-primary fw-semibold text-danger">{{ __('Exam Time') }} : {{ date('h:i A', strtotime($exam->start_time)) }}</h5>
                            <h5 class="font-family-primary fw-semibold text-danger">{{ __('Result Date') }} : {{ date('d M, Y', strtotime($exam->result_date)) }}</h5>
                            <h5 class="font-family-primary fw-semibold text-danger">{{ __('Result Time') }} : {{ date('h:i A', strtotime($exam->result_time)) }}</h5>
                        </div>
                    </div>
                </div> <!-- end col -->

                @php
                    $examDateTime = date('d M, Y h:i A', strtotime($exam->start_date . $exam->start_time));
                @endphp

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-family-primary fw-semibold">{{ __('Exam Will be start at :startdateTime. Every question has :mark each and :negativeMark will be deducted for every wrong question.', ['startdateTime' => $examDateTime, 'mark' => $exam->mark_per_question, 'negativeMark' => $exam->negative_mark]) }}</h5>
                            @if ($exam->note)
                                <p class="mb-2"><span class="fw-semibold me-2">{{ __('Note') }}:</span> {{ $exam->note }}</p>
                            @endif
                            @if ($exam->description)
                                <p class="mb-2">{{ $exam->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        @php
                            $currentDateTime = date('Y-m-d H:i');
                            $examDateTime = date('Y-m-d H:i', strtotime($exam->start_date . $exam->start_time));
                            $resultDateTime = date('Y-m-d H:i', strtotime($exam->result_date . $exam->result_time));
                            $fiveMinuteExtra = date("Y-m-d H:i:s", strtotime('+5 minutes', strtotime($examDateTime)));
                        @endphp

                        @if ($currentDateTime < $fiveMinuteExtra)
                            <a href="{{ route('user.exams.exam', [$exam->id, strtolower(str_replace([' ', '_', '&'], '-', $exam->title))]) }}"
                            class="btn btn-outline-primary waves-effect waves-light">{{ __('Enter Exam') }}</a>
                        @endif

                        @if ($currentDateTime > $resultDateTime)
                            <a href="{{ route('user.exams.result', [$exam->id, strtolower(str_replace([' ', '_', '&'], '-', $exam->title))]) }}"
                            class="btn btn-outline-primary waves-effect waves-light">{{ __('See Result') }}</a>
                        @endif
                    </div>
                </div> <!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection