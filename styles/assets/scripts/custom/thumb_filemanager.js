$(function() {
    $("#image_link").observe_field(1, function( ) {
        $('#select_image').hide();
        $('#remove_image').show();
        $('#thumbnail').val($('#image_link').val());                
        $('.show_image_preview').show();
        $('.show_image_default').empty();
        $('.image_preview').attr('src', this.value).show();
        FormImageCrop.init();
    });

    $('#remove_image').click(function(){
        var image_default = $('#image_default').val();
        $('.show_image_preview').hide();
        $('#remove_image').hide();
        $('.show_image_default').html('<img src="'+image_default+'">');
        $('.image_preview').attr('src', '').hide();             
        $('.jcrop-holder img').attr('src', '').hide();              
        $('#thumbnail').val('');                
    });
});