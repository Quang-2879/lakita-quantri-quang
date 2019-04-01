
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
    <script src="<?php echo base_url();?>styles/assets/plugins/respond.min.js"></script>
    <script src="<?php echo base_url();?>styles/assets/plugins/excanvas.min.js"></script> 
    <![endif]-->
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/typeahead/typeahead.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- CROP IMAGE -->
<script src="<?php echo base_url();?>styles/assets/plugins/jcrop/js/jquery.color.js"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jcrop/js/jquery.Jcrop.min.js"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>styles/assets/scripts/core/app.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/components-form-tools.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/components-pickers.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/form-image-crop.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/components-dropdowns.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- EDITOR -->
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/fancybox/jquery.observe_field.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/editor.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/myattach.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/thumb_filemanager.js"></script>

<?php if(isset($uploadify)){ ?>
<script src="<?php echo base_url();?>styles/assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/assets/uploadify/uploadify.css">
<script src="<?php echo base_url();?>styles/assets/uploadify/myuploadify.js"></script>
<?php } ?>

<script>
    jQuery(document).ready(function() {       
        // initiate layout and plugins
        App.init();
        ComponentsFormTools.init();
        ComponentsPickers.init();       
        ComponentsDropdowns.init();
    });   
</script>

<?php if(isset($courses_change)){ ?>
<script>
    jQuery(document).ready(function(){
        $('#courses_id').change(function(){
            var base_url = $('#base_url').val();
            var courses_id = $('#courses_id').val();
            $.ajax({
                type: "POST",
                url: base_url +'learn/courses_change',
                data: {
                    courses_id : courses_id,
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
                    if(response=='faild')
                        alert('Bạn không có quyền truy cập');
                    else
                        $('#chapter').html(response);
                }
            });
        });
    });
</script>
<?php } ?>

