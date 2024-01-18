'use strict';

// preview job photo on change
$(document).on('change','#job-photo-input', function() {
    readPicture(this, '#job-photo')
});

$(function() {
    CKEDITOR.replace('editor')
});

$('#new-link-button').on('click', function() {
    var newRow = '<input type="text" name="links[]" id="links" class="form-control mt-2" placeholder="' + LinkPlaceholder + '">';
    
    $('#new-row').append(newRow);
})

let count = 2;

$('#new-document-button').on('click', function() {
    let jobApplyPhotoId = "#job-apply-photo-"+ count;
    let jobApplyPhotoInputId = "#job-apply-photo-input-"+ count ;
    var newRow = '<div class="row mb-3 d-flex justify-content-center align-items-center"><div class="col-lg-8 mb-3"><label class="form-label">'+ documentTitleText +'</label><input type="text" name="title[]" id="title" class="form-control" placeholder="'+ documentTitleText +'" required=""></div><div class="col-lg-4 mb-3"><label class="form-label">'+ documentText +'</label><div class="card card-border"><img class="card-img-top" id="'+ jobApplyPhotoId +'" src="'+ defaultPhoto +'" alt="" height="100px"><div class="card-body"><input type="file" name="photo" class="form-control file-upload" data-count="' + count + '" id="'+ jobApplyPhotoInputId +'" onchange="readPictureJobApply(this)"></div></div></div></div>';
    
    $('#new-row').append(newRow);
    count++;
})

// function readPictureJobApply(photo, display) {

//     alert(display);
//     readPicture(photo, display);
// }

function readPictureJobApply(photo) {


    var dataCount = $('.file-upload:last').data('count');
    var display = "#job-apply-photo-"+ dataCount;
    alert(display);
    readPicture(photo, display);

    // alert(dtatId);
    // readPicture(photo, display);
}