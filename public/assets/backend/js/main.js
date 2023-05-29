'use script';

//logout script
$('#logout-button').on('click', function(event) {
    event.preventDefault();
    $('#logout-form').trigger('submit');
});

// delete script
$(document).on('click', '.delete-warning', function(e){
    e.preventDefault();
    let url = $(this).attr('href');
    $('#delete-form').attr('action', url);
    $('#delete-modal').modal('show');
});

//picture display on input
function readPicture(element, previewElement) {
    if (element.files && element.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(previewElement).attr('src', e.target.result);
        };
        reader.readAsDataURL(element.files[0]);
    }
}
