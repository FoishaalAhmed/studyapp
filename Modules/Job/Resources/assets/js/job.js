'use strict';

// preview job photo on change
$(document).on('change','#job-photo-input', function() {
    readPicture(this, '#job-photo')
});

$(function() {
    CKEDITOR.replace('editor')
});

$('#new-link-button').on('click', function() {
    var newRow = '<input type="text" name="links[]" id="links" class="form-control mt-2" placeholder="' + LinkPlaceholder + '">';
    
    $('#new-row').append(newRow);
})