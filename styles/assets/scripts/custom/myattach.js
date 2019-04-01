$(function() {    
    my_process_attach();

    $("#attach_link").observe_field(1, function( ) {
        var attach_link = $('#attach_link').val();
        var base_url = $('#base_url').val();
        $('#attach_link').val('');

        if(attach_link != '')
        {
            var name = attach_link.split('/').pop();
            var extension = attach_link.split('.').pop().toLowerCase();
            if(extension == 'png' || extension == 'gif' || extension == 'jpg' || extension == 'jpeg')
                show = attach_link;
            else if(extension == 'pdf' || extension == 'ppt' || extension == 'pptx' || extension == 'rar' || extension == 'zip' || extension == 'gzip' || extension == 'mp4' || extension == 'flv' || extension == 'mp3' || extension == 'doc' || extension == 'docx' || extension == 'xls' || extension == 'xlsx')
                show = base_url + 'data/img/' + extension + '.jpg';
            else
                show = base_url + 'data/img/unknow.jpg';

            var add = $('' +
            '<tr class="template-upload fade in">' +
                '<td>' +
                    '<span class="preview">' +
                        '<img width="50" height="40" src="'+show+'">' +
                    '</span>' +
                '</td>' +
                '<td class="input-medium">' +
                    '<input type="hidden" class="att_name" name="att_name[]" value="'+attach_link+'">' +
                    '<p class="name">'+name+'</p>' +
                '</td>' +
                '<td>' +
                    '<input class="form-control input-medium" type="text" placehold="Nhập mô tả" name="att_description[]" />' +
                '</td>' +
                '<td>' +
                    '<div class="pull-right">' +
                        '<a href="'+show+'" class="btn blue start btn-sm iframe-img">' +
                            '<i class="fa fa-eye"></i>' +                            
                        '</a>' +
                        '<button class="btn green btn-sm download">' +
                            '<i class="fa fa-download"></i>' +
                        '</button>' +
                        ' <button class="btn red cancel btn-sm delete_attach">' +
                            '<i class="fa fa-trash-o"></i>' +                            
                        '</button>' +
                    '</div>' +
                '</td>' +
            '</tr>');
    
            $(add).hide().insertAfter('.template-upload:last').slideDown('slow');

            my_process_attach();
        }
    });

    /*$('.download').click(function(){        
        var file_attach = $(this).parent().parent().parent().find('.att_name').val();
        var base_url = $('#base_url').val();
        console.log(file_attach);
        $.ajax({
            type: "POST",
            url: base_url +'home/download_via_url',
            data: {
                file_attach : file_attach,
                key : 'AZ813kdLSE',
                okkey : 'AZ813kdLSEAceTienDung',
            },
            dataType: "text",
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader("Ajax-Request", "true");
            },
            success: function(response)
            {
                alert(response);
                
                if(response==0)
                    alert('Bạn không có quyền download');
            }
        });
    });*/
});

function my_process_attach()
{
    $('.iframe-img').fancybox({ 
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });

    
    $('.delete_attach').click(function(){
        $(this).parent().parent().parent().remove();
    });
}