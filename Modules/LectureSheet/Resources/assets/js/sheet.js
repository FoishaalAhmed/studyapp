'use strict';

$('#type').on('change', function() {
    let type = $('#type').val();
    if (type == 'Premium') {
        $('#price-div').show();
        $('#price').attr('required', true);
    } else {
        $('#price-div').hide();
        $('#price').attr('required', false);
    }
});

$('#child_category_id').on('change', function() {
    
    let categoryText = $('#child_category_id option:selected').text();
    let categoryId = $('#child_category_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });
    
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            'category_id': categoryId,
        },
        success: function(data2) {
            let data = JSON.parse(data2);
            $('#subject_id').find('option').remove().end().append("<option value=''>Select " + categoryText +
                "\'s Subject</option>");
            $.each(data, function(i, item) {
                $("#subject_id").append($('<option>', {
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