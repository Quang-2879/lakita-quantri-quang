var FormImageCrop = function () {
    var ace_crop = function() {
        // Create variables (in this scope) to hold the API and image size
        var jcrop_api,
            boundx,
            boundy,
            // Grab some information about the preview pane
            $height_img = $('.show_image_preview'),            
            //$preview = $('#preview-pane'),
           // $pcnt = $('#preview-pane .preview-container'),
          //  $pimg = $('#preview-pane .preview-container img'),
          //              
           /* xsize = $('#width_thumbnail').val(),
            ysize = $('#height_thumbnail').val();*/
            ratio = $('#ratio').val();

         //   console.log($preview);
          //  console.log($pcnt);
          //  console.log($pimg);
        
          //  console.log('init',[xsize,ysize]);

        $('#ace_crop').Jcrop({
          bgFade:     true,
          bgOpacity: .7,
          setSelect: [ 0, 0, 80, 80],
          allowSelect : true,
          allowResize : true,
          onChange: updatePreview,
          onSelect: updatePreview,
          /*aspectRatio: xsize / ysize*/
          aspectRatio: ratio
        },function(){
          // Use the API to get the real image size
          var bounds = this.getBounds();
          boundx = bounds[0];
          boundy = bounds[1];
          // Store the API in the jcrop_api variable
          jcrop_api = this;
          // Move the preview into the jcrop container for css positioning
          //$preview.appendTo(jcrop_api.ui.holder);
        });

        function updatePreview(c)
        {
          if (parseInt(c.w) > 0)
          {
            naturalWidth = document.getElementById("ace_crop").naturalWidth;
            naturalHeight = document.getElementById("ace_crop").naturalHeight;
            fixWidth = $height_img.width();
            fixHeight = $height_img.height();

            /*$pcnt.css({
              width: Math.round(xsize / ysize * $height_img.height()) + 'px',
              height: Math.round($height_img.height()) + 'px',
              marginLeft: '-' + Math.round(rx * c.x) + 'px',
              marginTop: '-' + Math.round(ry * c.y) + 'px'
            });

            $preview.css({
              left: '-' + Math.round(xsize / ysize * $height_img.height()) + 'px',
            });

            var rx = xsize / c.w;
            var ry = ysize / c.h;


            $pimg.css({
              width: Math.round(rx * boundx) + 'px',
              height: Math.round(ry * boundy) + 'px',
              marginLeft: '-' + Math.round(rx * c.x) + 'px',
              marginTop: '-' + Math.round(ry * c.y) + 'px'
            });*/
            
           /* console.log('naturalWidth2 = '+naturalWidth);
            console.log('fixWidth2 = '+fixWidth);
            console.log('row = '+naturalWidth/fixWidth);
            console.log('ch = '+c.h);
            console.log('total2 = '+c.h*naturalWidth/fixWidth);*/

            $('#crop_x').val(c.x*naturalWidth/fixWidth);
            $('#crop_y').val(c.y*naturalHeight/fixHeight);
            $('#crop_w').val(c.w*naturalWidth/fixWidth);
            $('#crop_h').val(c.h*naturalHeight/fixHeight);

          }
        };
    }

    var handleResponsive = function() {
      if ($(window).width() <= 1024 && $(window).width() >= 678) {
        $('.responsive-1024').each(function(){
          $(this).attr("data-class", $(this).attr("class"));
          $(this).attr("class", 'responsive-1024 col-md-12');
        }); 
      } else {
        $('.responsive-1024').each(function(){
          if ($(this).attr("data-class")) {
            $(this).attr("class", $(this).attr("data-class"));  
            $(this).removeAttr("data-class");
          }
        });
      }
    }

    return {
        //main function to initiate the module
        init: function () {
            
            if (!jQuery().Jcrop) {;
                return;
            }
            App.addResponsiveHandler(handleResponsive);
            handleResponsive();
            ace_crop();
        }

    };
}();