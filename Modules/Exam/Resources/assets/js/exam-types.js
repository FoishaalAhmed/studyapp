'use strict';

$('#edit-modal').on("show.bs.modal", function(event) {
    let e = $(event.relatedTarget);
    let id = e.data('id');
    let name = e.data('name');
    $("#edit-form").attr('action', updateUrl);
    $("#id").val(id);
    $("#edit-name").val(name);
});