'use strict';

$("#category").on("change", function() {
            
    let subCategory = $('#category').val();
    let categoryText = $('#category option:selected').text();

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

            $('#home-category').find('option').remove().end().append("<option value=''>Select " + categoryText + "\'s category</option>");

            $.each(data, function(i, item) {
                $("#home-category").append($('<option>', {
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