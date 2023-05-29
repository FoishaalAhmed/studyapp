'use strict';

// preview large logo on change
$(document).on('change','#large-logo-input', function() {
    readPicture(this, '#large-logo-photo')
});

// preview small logo on change
$(document).on('change','#small-logo-input', function() {
    readPicture(this, '#small-logo-photo')
});

// preview favicon on change
$(document).on('change','#favicon-input', function() {
    readPicture(this, '#favicon-photo')
});