'use strict';

$(function() {
    CKEDITOR.replace('editor')
});
// preview add photo on change
$(document).on('change','#page-photo-input', function() {
    readPicture(this, '#page-photo')
});