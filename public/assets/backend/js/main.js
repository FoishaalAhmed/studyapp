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

function readPicture(input, imageId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + imageId)
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
