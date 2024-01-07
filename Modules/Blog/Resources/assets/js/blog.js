'use strict';

$(function() {
    CKEDITOR.replace('editor')
});

// preview large logo on change
$(document).on('change','#blog-photo-input', function() {
    readPicture(this, '#blog-photo')
});


let tag = document.querySelector('input[name=tag]');
new Tagify(tag);