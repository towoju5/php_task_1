$(document).ready( function () {
    $.noConflict();
    $('.select2').select2();
    $('.datatable').DataTable();
} );

function show_image_gallery(image, image_id)
{
    $('#image_gallery').modal('toggle');
    $('#image_gallery').attr('data-image_url_field', image);
    $('#image_gallery').attr('data-image_id_field', image_id);
}
$('.image-row').click(function()
{
    image_url = $(this).attr('data-image_url');
    $('.image-row').removeClass('active-image-row');
    $(this).addClass('active-image-row');
    $('#image_viewer').attr('src', image_url);
});

$('#select_image').click(function()
{
    image_url = $('.active-image-row').attr('data-image_url');
    image_id = $('.active-image-row').attr('data-image_id');
    image_url_field = $('#image_gallery').attr('data-image_url_field');
    image_id_field = $('#image_gallery').attr('data-image_id_field');
    $('#'+image_url_field).val(image_url);
    $('#'+image_id_field).val(image_id);
    $('#' + image_url_field + '_complete').html('Upload Completed');
    $('#image_gallery').modal('toggle');
});