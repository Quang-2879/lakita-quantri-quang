<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?php
            if (!empty($this->session->userdata('title')))
                echo $this->session->userdata('title');
            else
                echo 'Hệ thống quản trị';
            ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        <?php $this->load->view('common/' . $header); ?>

        <!-- END THEME STYLES -->
        <?php if (!empty($this->session->userdata('favicon'))) { ?>
            <link rel="shortcut icon" href="<?php echo WEBSITE . $this->session->userdata('favicon'); ?>"/>
        <?php } ?>
        <style>.my-border{border: 1px solid #cecece;} .w100{width: 100%!important;} .fileinput-preview img{width: 100%!important;}</style>
        <style>
            .snote{
                text-overflow: ellipsis;
                width: 171px;
            }
        </style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed">
        <?php $this->load->view('common/header'); ?>


        <!-- BEGIN CONTAINER -->
        <div class="page-container">
<?php  $controller = $this->uri->rsegment(1); 
if($controller != 'exercise') { ?>
            <?php $this->load->view('common/sidebar'); ?>
<?php }?>

            <?php if (isset($content)) $this->load->view($content); ?>

        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="footer">
            <div class="footer-inner">
                2015 &copy; Metronic by keenthemes.
            </div>
            <div class="footer-tools">
                <span class="go-top">
                    <i class="fa fa-angle-up"></i>
                </span>
            </div>
        </div>
        <!-- END FOOTER -->

        <?php $this->load->view('common/' . $footer); ?>
        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
        <script type="text/javascript">
            /*............ AJAX ............*/
            jQuery(function () {
                $(".directtab").click(function () {
                    $(".bank").hide();
                    $(".banktab").removeClass("active1");
                    $(".direct").show();
                    $(".directtab").addClass("active1");
                    $(".combo").hide();
                    $(".combotab").removeClass("active1");
                });
                $(".banktab").click(function () {
                    $(".bank").show();
                    $(".banktab").addClass("active1");
                    $(".direct").hide();
                    $(".directtab").removeClass("active1");
                    $(".combo").hide();
                    $(".combotab").removeClass("active1");
                });
                $(".combotab").click(function () {
                    $(".bank").hide();
                    $(".banktab").removeClass("active1");     
                    $(".direct").hide();
                    $(".directtab").removeClass("active1");
                    $(".combo").show();
                    $(".combotab").addClass("active1");
                    
                });
                

                
                $("#datepicker").hover(function () {
                    $("#datepicker").datepicker();
                });

                $("#datepicker").change(function () {
                    var selectDate = ($(this).datepicker("getDate").getTime()) / 1000;
                    $("#date1").val(selectDate);
                });
                $("#datepicker2").hover(function () {
                    $("#datepicker2").datepicker();
                });
                $("#datepicker2").change(function () {
                    var selectDate = ($(this).datepicker("getDate").getTime()) / 1000;
                    $("#date2").val(selectDate);
                });

                jQuery(".per_page").change(function () {
                    var base_url = jQuery("#base_url").val();
                    var per_page = jQuery(this).val();

                    var url = base_url + 'home/set_numper_product/' + per_page;
                    console.log("url" + url);
                    jQuery.ajax({
                        type: "POST",
                        url: url,
                        dataType: "text",
                        scriptCharset: "utf-8",
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        beforeSend: function (xhr)
                        {
                            xhr.setRequestHeader("Ajax-Request", "true");
                        },
                        success: function (response)
                        {
                            location.reload();
                            return false;
                        }
                    });
                });
             
             
             
                $('.curr_segment').on('click',function(e){
                var segment = $(location).attr('href');  
                var base_url = $('#base_url').val();
                var curr = segment.slice(base_url.length, segment.length);
                var page = $('#page').val();
                $.ajax({
                        type: "POST",
                        url: base_url + 'home/curr_segment',
                        data: {
                            curr: curr,
                            page: page
                        },
                        dataType: "text",
                        success: function (result)
                        {
                            console.log(result);
                        }
                    });
                });
                
            });
        </script>

        <script type="text/javascript">
            $(function () {

                document.getElementById("courseID").onchange = function () {
                    document.getElementById("courseSelected").value = this.value;
                };
                document.getElementById("courseID2").onchange = function () {
                    document.getElementById("courseSelected2").value = this.value;
                }
                $('#name').keyup(function (e) {
                    var url_input = $(this).val().replace(/[\n]/g, '<br />');
                    if (url_input.length == 0)
                    {
                        $("#slug").val('');
                        $("#title").val('');
                        return;
                    }

                    var base_url = $('#base_url').val();
                    $.ajax({
                        type: "POST",
                        url: base_url + 'home/get_slug',
                        data: {
                            url: url_input
                        },
                        dataType: "text",
                        beforeSend: function (xhr)
                        {
                            xhr.setRequestHeader("Ajax-Request", "true");
                        },
                        success: function (result)
                        {
                            $("#slug").val(result);
                            $("#title").val(url_input);
                        }
                    });
                });

                $('#description').keyup(function (e) {
                    var url_input = $(this).val().replace(/[\n]/g, '<br />');
                    $("#meta_description").val(url_input);
                });

            });
        </script> 
    </body>
    <!-- END BODY -->
</html>