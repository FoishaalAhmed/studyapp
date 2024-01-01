'use strict';

$(function() {
    CKEDITOR.replace('editor')
});

// preview quiz photo on change
$(document).on('change','#quiz-photo-input', function() {
    readPicture(this, '#quiz-photo')
});


$('#type').on('change', function() {
    let type = $('#type').val();
    if (type == 'Premium') {
        $('#price-div').show();
        $('#price').attr('required', true);
    } else {
        $('#price-div').hide();
        $('#price').attr('required', false);
    }
});