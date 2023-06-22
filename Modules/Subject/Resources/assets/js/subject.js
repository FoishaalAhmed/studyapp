'use strict';

// preview add photo on change
$(document).on('change','#subject-photo-input', function() {
    readPicture(this, '#subject-photo')
});