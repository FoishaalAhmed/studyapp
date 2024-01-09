'use strict';

$("#sub-category-id-1, #sub-category-id-2, #sub-category-id-3").on("change", function(event) {
            
    let type = $(this).find(':selected').data('type');
    let subCategory = $(this).find(':selected').val();
    let htmlId;

    switch (type) {
        case 'MCQ':
            htmlId = "mcq";
            break;

        case 'Ebook':
            htmlId = "ebook";
            break;
    
        default:
            htmlId = "lecture-sheet";
            break;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrf
        }
    });

    $.ajax({

        url: url,
        method: 'POST',
        data: {
            'subCategory': subCategory,
            'type': type,
        },

        success: function(data2) {

            let data = JSON.parse(data2);
            
            $('#' + htmlId).find('option').remove().end();

            $.each(data, function(i, item) {
                $("#" + htmlId).append($('<option>', {
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