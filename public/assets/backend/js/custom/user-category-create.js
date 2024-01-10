'use strict';

$("#category").on("change", function(event) {
    event.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
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

            $('#lecture-sheet').find('option').remove().end().append("<option value=''>Select " + categoryText + "\'s category</option>");

            $.each(data.sheetCategories, function(i, item) {
                $("#lecture-sheet").append($('<option>', {
                    value: this.id,
                    text: this.name,
                }));
            });

            $('#ebook').find('option').remove().end().append("<option value=''>Select " + categoryText + "\'s category</option>");

            $.each(data.ebookCategories, function(i, item) {
                $("#ebook").append($('<option>', {
                    value: this.id,
                    text: this.name,
                }));
            });

            $('#mcq').find('option').remove().end().append("<option value=''>Select " + categoryText + "\'s category</option>");

            $.each(data.mcqCategories, function(i, item) {
                $("#mcq").append($('<option>', {
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