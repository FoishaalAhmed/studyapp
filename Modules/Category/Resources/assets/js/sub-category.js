'use strict';

// preview add photo on change
$(document).on('change','#category-photo-input', function() {
    readPicture(this, '#category-photo')
});