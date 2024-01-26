@extends('backend.layouts.app')

@section('title', __('Mcq Practice'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"> <span class="span">|</span> {{ __('Mcq Practice') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <span class="btn btn-primary rounded-pill waves-effect waves-light text-white" id="demo"></span>
                            <a href="{{ route('user.mcq.read', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-primary rounded-pill waves-effect waves-light text-white ml-2"> {{ __('Read') }} </a>
                            <a href="{{ route('user.mcq.exam', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]) }}" class="btn btn-primary rounded-pill waves-effect waves-light text-white ml-2"> {{ __('Take Exam') }} </a>
                        </p>
                        @php
                            $answerIndex = ['N/A', 'ক', 'খ', 'গ', 'ঘ'];

                            $hour = round($model->time / 60);
                            $minute = $model->time - ($hour * 60);
                            $myDateTime = date('Y-m-d H:i:s', strtotime('+' . $hour . ' hours'. $minute . 'minutes'));
                        @endphp
                        <div class="row">
                            <div class="col-lg-10">
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
                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:;" class="btn btn-primary rounded-pill waves-effect waves-light text-white p-fixed r-100" style="position: fixed; "> {{ __('Right') }} : <span id="right">0</span> </a>
                                <a href="javascript:;" class="btn btn-primary rounded-pill waves-effect waves-light text-white ml-2 p-fixed"> {{ __('Wrong') }} : <span id="wrong">0</span> </a>
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
        var right = $('#right').text();
        var wrong = $('#wrong').text();

        if (answer == correctAnswer) {
            var totalRight = parseInt(right) + 1;
            $('#right').text(totalRight);
        } else {
            var totalWrong = parseInt(wrong) + 1;
            $('#wrong').text(totalWrong);
        }

        $('#mcq_1_' + index).attr('disabled', true);
        $('#mcq_2_' + index).attr('disabled', true);
        $('#mcq_3_' + index).attr('disabled', true);
        $('#mcq_4_' + index).attr('disabled', true);
        
    }

    // Set the date we're counting down to
    var countDownDate = new Date("{{ $myDateTime }}").getTime();

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
        document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

    
@endsection