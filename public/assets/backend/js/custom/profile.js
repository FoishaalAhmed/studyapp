'use strict';

// preview add photo on change
$(document).on('change','#profile-photo-input', function() {
    readPicture(this, '#profile-photo')
});