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

