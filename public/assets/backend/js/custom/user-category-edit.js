'use strict';

$("#category").on("change", function(event) {
    event.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrf
        }
    });

    let category = $('#category').val();

    let categoryText = $('#category option:selected').text();

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            'categoryId': category,
        },

        success: function(data2) {

            let data = JSON.parse(data2);
            let categories;

            switch (type) {
                case 'Sheet':
                    categories = data.sheetCategories;
                    break;

                case 'Ebook':
                    categories = data.ebookCategories;
                    break;
            
                default:
                    categories = data.mcqCategories;
                    break;
            }

            $('#user-category').find('option').remove().end().append("<option value=''>Select " + categoryText + "\'s category</option>");

            $.each(categories, function(i, item) {
                $("#user-category").append($('<option>', {
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