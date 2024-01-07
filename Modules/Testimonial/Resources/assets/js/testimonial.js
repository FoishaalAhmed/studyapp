'use strict';

$(function() {
    CKEDITOR.replace('editor')
});

// preview large logo on change
$(document).on('change','#testimonial-photo-input', function() {
    readPicture(this, '#testimonial-photo')
});