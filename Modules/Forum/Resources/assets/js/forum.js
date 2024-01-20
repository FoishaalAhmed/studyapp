'use strict';

$('#load-more').on('click', function() {
    var page = $(this).data('paginate');
    loadMoreData(page);
    $(this).data('paginate', page + 1);
});

function loadMoreData(paginate) {
    $.ajax({
        
        url:  url,
        type: 'get',
        datatype: 'html',
        data: {
            'page': paginate
        },
        beforeSend: function() {
            $('#load-more').text(loadingText);
        }
    })
    .done(function(data) {
        if(data.length == 0) {
            $('.invisible').removeClass('invisible');
            $('#load-more').hide();
            return false;
        } else {
            $('#load-more').text(loadMoreText);
            $('#new-forum-item').append(data);
        }
    })
}