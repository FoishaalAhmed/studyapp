@extends('backend.layouts.app')

@section('title', __('Mcq Exam'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"> <span class="span">|</span> {{ __('Mcq Exam') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            
                            <a href="{{ route('user.mcq.read', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-primary rounded-pill waves-effect waves-light text-white ml-2"> {{ __('Read') }} </a>
                            <a href="{{ route('user.mcq.practice', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-primary rounded-pill waves-effect waves-light text-white ml-2"> {{ __('Practice') }} </a>
                        </p>
                        @php
                            $answerIndex = ['N/A', 'ক', 'খ', 'গ', 'ঘ'];

                            $hour = round($model->time / 60);
                            $minute = $model->time - ($hour * 60);
                            $myDateTime = date('Y-m-d H:i:s', strtotime('+' . $hour . ' hours'. $minute . 'minutes'));

                            // dd($myDateTime);
                        @endphp
                        <div class="row">
                            <div class="col-lg-10">
                                <form action="{{ route('user.mcq.exam.store') }}" method="POST" id="mcq-form">
                                    @csrf
                                    <input type="hidden" name="right_answer" id="right" value="0">
                                    <input type="hidden" name="wrong_answer" id="wrong" value="0">
                                    <input type="hidden" name="total_time" id="totalTime">
                                    <input type="hidden" name="model_test_id" value="{{ $model->id }}">
                                    <div class="row">
                                        @foreach ($questions as $question)
                                            <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                            <div class="col-lg-6 mb-3">
                                                <p> {{ $loop->index + 1 }}. {{ $question->question }}</p>
                                                @php
                                                    $answer = $question->answer == null ? 0 : $question->answer;
                                                    $answers = ['N/A', $question->answer1, $question->answer2, $question->answer3, $question->answer4];
                                                @endphp
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-check mb-2 form-check-primary">
                                                            <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_1_{{ $loop->index }}" value="1" onclick="increaseDecreaseMark('{{ $question->answer1 }}', '{{ $loop->index }}')">
                                                            <label class="form-check-label" for="mcq_1_{{ $loop->index }}">(ক). {{ $question->answer1 }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check mb-2 form-check-primary">
                                                            <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_2_{{ $loop->index }}" value="2" onclick="increaseDecreaseMark('{{ $question->answer2 }}', '{{ $loop->index }}')">
                                                            <label class="form-check-label" for="mcq_2_{{ $loop->index }}">(খ). {{ $question->answer2 }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check mb-2 form-check-primary">
                                                            <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_3_{{ $loop->index }}" value="3" onclick="increaseDecreaseMark('{{ $question->answer3 }}', '{{ $loop->index }}')">
                                                            <label class="form-check-label" for="mcq_3_{{ $loop->index }}">(গ). {{ $question->answer3 }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check mb-2 form-check-primary">
                                                            <input class="form-check-input rounded-circle" type="checkbox" name="given_answer[]" id="mcq_4_{{ $loop->index }}" value="4" onclick="increaseDecreaseMark('{{ $question->answer4 }}', '{{ $loop->index }}')">
                                                            <label class="form-check-label" for="mcq_4_{{ $loop->index }}">(ঘ). {{ $question->answer4 }}</label>
                                                            <input type="hidden" id="correct_answer{{ $loop->index }}" value="{{ $answers[$answer] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <a href="{{ route('user.mcq.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                            <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-2">
                                <span class="btn btn-primary rounded-pill waves-effect waves-light text-white p-fixed r-35" id="demo"></span>
                            </div>

                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('js')
<script type="text/javascript">
    function increaseDecreaseMark(answer, index) {
        var correctAnswer = $('#correct_answer' + index).val();
        var right = $('#right').val();
        var wrong = $('#wrong').val();

        if (answer == correctAnswer) {
            var totalRight = parseInt(right) + 1;
            $('#right').val(totalRight);
        } else {
            var totalWrong = parseInt(wrong) + 1;
            $('#wrong').val(totalWrong);
        }

        $('#mcq_1_' + index).attr('disabled', true);
        $('#mcq_2_' + index).attr('disabled', true);
        $('#mcq_3_' + index).attr('disabled', true);
        $('#mcq_4_' + index).attr('disabled', true);
        
    }

    // Set the date we're counting down to
    var countDownDate = new Date("{{ $myDateTime }}").getTime();
    var remainingTime = "{{ __('Remaining Time') }}"

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = remainingTime + ' : ' + hours + "h " +
            minutes + "m " + seconds + "s ";

        document.getElementById("totalTime").value = hours + " " +
            minutes + " " + seconds + " ";

        //If the count down is over, submit the from
        if (distance < 0) {
            clearInterval(x);
             $('#mcq-form').trigger('submit');
        }
    }, 1000);

     $('#mcq-form').on('submit', function() {
            $('.form-check-input').removeAttr('disabled');
        });
</script>

    
@endsection