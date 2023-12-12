'use strict';

$(function() {
    CKEDITOR.replace('editor')
});

// preview exam photo on change
$(document).on('change','#exam-photo-input', function() {
    readPicture(this, '#exam-photo')
});

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

$('#exam_type').on('change', function() {
    let type = $('#exam_type').val();
    if (type == 1) {
        $('#chapter-div').hide();
        $('#subject-div').hide();
    } else if(type == 2) {
        $('#chapter-div').hide();
        $('#subject-div').show();
    } else {
        $('#chapter-div').show();
        $('#subject-div').show();
    }
});

$('#category_id').on('change', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    let categoryText = $('#category_id option:selected').text();
    let categoryId = $('#category_id').val();

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