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

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': csrf
    }
});

$('#forum-form').on('submit', function(event) {

    event.preventDefault();
    $.ajax({
        url: forumStoreUrl,
        method: 'POST',
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            $('#bs-example-modal-lg').modal('show');
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[
                        count] + '</div>';
                }
                $('#form-message').html(error_html);
            } else {
                $('#form-message').html(data.success);

                setTimeout(function() {
                    $('#forum-form')[0].reset();
                    window.location.reload();
                },2000);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});

$('#comment-form').on('submit', function(event) {

    event.preventDefault();
    $.ajax({
        url: commentStoreUrl,
        method: 'POST',
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            $('#comment-modal').modal('show');
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[
                        count] + '</div>';
                }
                $('#comment-message').html(error_html);
            } else {
                $('#comment-message').html(data.success);

                setTimeout(function() {
                    $('#comment-form')[0].reset();
                    window.location.reload();
                },2000);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});

$('#reply-form').on('submit', function(event) {

    event.preventDefault();
    $.ajax({
        url: replyStoreUrl,
        method: 'POST',
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            $('#reply-modal').modal('show');
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[
                        count] + '</div>';
                }
                $('#reply-message').html(error_html);
            } else {
                $('#reply-message').html(data.success);

                setTimeout(function() {
                    $('#reply-form')[0].reset();
                    window.location.reload();
                },2000);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});

$('#comment-modal').on("show.bs.modal", function(event) {
    var e = $(event.relatedTarget);
    var id = e.data('id');
    $("#forum-id").val(id);
});
$('#reply-modal').on("show.bs.modal", function(event) {
    var e = $(event.relatedTarget);
    var id = e.data('id');
    $("#forum-comment-id").val(id);
});