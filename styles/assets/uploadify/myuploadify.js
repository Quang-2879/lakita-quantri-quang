$(function() {
    var website = $('#website').val();
	var base_url = $('#base_url').val();
	var token = $('#token').val();

    $('#file_upload').uploadify({
        'formData'     : {
            'token' : token,
            'verifyToken' : token + 'AceTienDung'
        },
        'swf'      : base_url + 'styles/assets/uploadify/uploadify.swf',
        'uploader' : base_url + 'home/myupload',
        'onSelect' : function(file) {
		},
        'onUploadSuccess' : function(file, data, response) {
            if(response==0)
            {
                return;
			}                    
			else
			{
                var res_data = '<video width="100%" controls autoplay>'
                        +'<source src="'+ website + data +'" type="video/mp4">'
                        +'Trình duyệt này không hỗ trợ chạy video'
                    +'</video>';

                $('#playvideo').html(res_data);                
                $('#video_file').val(data);                
			}
            console.log(response);
		}
    });
});