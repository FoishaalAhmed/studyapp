'use strict';

$('#edit-modal').on("show.bs.modal", function(event) {
    let e = $(event.relatedTarget);
    let id = e.data('id');
    let name = e.data('name');
    let photo = e.data('photo');
    $("#edit-form").attr('action', updateUrl);
    $("#id").val(id);
    $("#edit-name").val(name);
    $("#edit-photo").attr('src', basUrl + '/' + photo);
});

// preview add photo on change
$(document).on('change','#add-photo-input', function() {
    readPicture(this, '#add-photo')
});

// preview edit photo on change
$(document).on('change','#edit-photo-input', function() {
    readPicture(this, '#edit-photo')
});