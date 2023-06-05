'use strict';

$('#type').on('change', function() {
    let type = $('#type').val();
    $.ajaxSetup({
        headers: {'X-CSRF-Token': csrfToken}
    });

    $.ajax({
        url: getSubCategoryRoute,
        method: 'POST',
        data: {
            'type': type,
        },
        success: function(data2) {
            let data = JSON.parse(data2);
            $('#sub_category_id').find('option').remove();
            $.each(data, function(i, item) {
                $("#sub_category_id").append($('<option>', {
                    value: this.id,
                    text: this.name,
                }));
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
});

// preview photo on change
$(document).on('change','#category-photo-input', function() {
    readPicture(this, '#category-photo')
});