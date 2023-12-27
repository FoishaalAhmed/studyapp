'use strict';

$('#draft').on('click', function() {
    $('#button').val('draft');
    $('#mcq-question-form').trigger('submit');
})

$('#save').on('click', function() {
    $('#button').val('save');
    $('#mcq-question-form').trigger('submit');
})

$('#new-question').on('click', function() {
    newRowAppend();
})

var count = 2;

function newRowAppend() {

    var newRow = '<div class="row"><span><b> '+ count +'.</b></span><div class="col-lg-6 mb-3"><label class="form-label">'+ questionText +'</label><input type="text" name="question[]" id="question'+ count +'" class="form-control fs-4" placeholder="'+ questionText +'" required=""></div><div class="col-lg-6 mb-3"><label class="form-label">'+ answerOneText +'</label><input type="text" name="answer1[]" id="answer1'+ count +'" class="form-control fs-4" placeholder="'+ answerOneText +'" required=""></div><div class="col-lg-6 mb-3"><label class="form-label">'+ answerTwoText +'</label><input type="text" name="answer2[]" id="answer2'+ count +'" class="form-control fs-4" placeholder="'+ answerTwoText +'" required=""></div><div class="col-lg-6 mb-3"><label class="form-label">'+ answerThreeText +'</label><input type="text" name="answer3[]" id="answer3'+ count +'" class="form-control fs-4" placeholder="'+ answerThreeText +'" required=""></div><div class="col-lg-6 mb-3"><label class="form-label">'+ answerFourText +'</label><input type="text" name="answer4[]" id="answer4'+ count +'" class="form-control fs-4" placeholder="'+ answerFourText +'" required=""></div><div class="col-lg-6 mb-3"><label class="form-label text-success">'+ correctAnswerText +'</label><input type="number" name="answer[]" id="answer'+ count +'" class="form-control fs-4" placeholder="'+ correctAnswerText +'" required=""></div><div class="col-lg-12 mb-3"><label class="form-label">'+ explanationTextOne +'</label><textarea name="explanation[]" id="explanation'+ count +'" placeholder="'+ explanationTextTwo +'" rows="5" class="form-control fs-4"></textarea></div></div>';
    
    $('#new-row').append(newRow);

    var id = count -1 ;

    var model_test_id = $('#model_test_id').val(); 
    var question = $('#question' + id).val(); 
    var answer1 = $('#answer1' + id).val(); 
    var answer2 = $('#answer2' + id).val(); 
    var answer3 = $('#answer3' + id).val(); 
    var answer4 = $('#answer4' + id).val(); 
    var answer = $('#answer' + id).val(); 
    var explanation = $('#explanation' + id).val(); 
    count++;

    if (
        question != '' && answer1 != '' && 
        answer2 != '' && answer3 != '' && 
        answer4 != '' && answer != ''
    ) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': csrfToken
            }
        });

        $.ajax({
            url: ajaxQuestionSaveUrl,
            method: 'POST',
            data: {
                'model_test_id' : model_test_id,
                'question' : question,
                'answer1' : answer1,
                'answer2' : answer2,
                'answer3' : answer3,
                'answer4' : answer4,
                'answer' : answer,
                'explanation' : explanation,
            },
            success: function(data){
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
}

$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        newRowAppend();
    }
});