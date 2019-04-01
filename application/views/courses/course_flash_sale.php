<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>
<link href="<?php echo base_url(); ?>styles/assets/DatetimePicker/css/datetimepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>styles/assets/DatetimePicker/js/datetimepicker.js" type="text/javascript"></script>
<style>
    .dtp_modal-win{
        z-index: 10051 !important;
    }
    .dtp_modal-content{
        z-index: 10052 !important;
    }
</style>
<div class="row">
    <!-- Large modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Flash sale</button>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="min-height: 500px; overflow: scroll">
                <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> Cài đặt flash sale</h4>
      </div>
      <div class="modal-body">
                <form id="list_flash_sale" class="form-horizontal" autocomplete="off" method="post" action="<?php echo base_url() ?>courses/courses_flash_sale">
                    <div class="">
                    <div class="control-group">
                        <label class="col-sm-2 control-label">Khóa :</label>
                        <select class="col-sm-10 selectpicker" name="courseIDcb[]" id="courseID" multiple title="Chọn khóa học" style="width:100%">
                    <?php
                    foreach ($courses as $key => $cour) {
                        ?>
                        <option style="width: 500px" value="<?php echo $cour['id']; ?>"><?php echo $cour['course_code'] . ' - ' . $cour['name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                    </div>
                    <div class="control-group">
                        <label class="col-sm-2 control-label">Bắt đầu :</label>
                        <div class="col-sm-10" id="start_sale">

                        </div>
                        <input id="result" type="hidden" class="form-control date-picker" name="start_sale" placeholder="Thời điểm bắt đầu bán đồng giá">
                    </div>
                    <div class="control-group">
                        <label class="col-sm-2 control-label">Kết thúc :</label>
                        <div class="col-sm-10" id="end_sale">

                        </div>
                        <input id="result2" type="hidden" class="form-control date-picker" name="end_sale" placeholder="Thời điểm bắt đầu bán đồng giá">
                    </div>
                    <div class="control-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Giá bán :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price_sale" placeholder="Giá bán đồng giá">
                        </div>
                    </div>
                    </div>
                    <div id="list_course" class="col-sm-11 col-sm-offset-1">
                    </div>
                    <button type="submit" style="float: right" id="btn_flash_sale" class="btn">Xác nhận</button>
                </form>
                
            </div>
            </div>
        </div>
    </div>

    <script>
        $('#start_sale').dateTimePicker({
            selectData: "now",
            title: "Chọn thời điểm bắt đầu",
            dateFormat: "DD-MM-YYYY HH:mm",
        });
        $('#end_sale').dateTimePicker({
            selectData: "now",
            title: "Chọn thời điểm kết thúc",
            dateFormat: "DD-MM-YYYY HH:mm",
        });



        $('#courseID').change(function () {
            $.ajax({
                url: "<?php echo base_url() ?>common/find_course",
                type: 'POST',
                dataType: 'json',
                data: {course_code: $('#courseID').val()},
                success: function (data) {
                    $('#list_course').remove();
                    $('#btn_flash_sale').remove();
                    $('#list_flash_sale').append("<div id='list_course' class='col-sm-11 col-sm-offset-1'></div>");
                    $.each(data['list_courses'], function (index, value) {
                        $('#list_course').append("<div class='control-group'>" +
                                "<input class='hidden' name='course_sale[]' value='" + value['id'] + "'>" +
                                "<label class='control-label'>" + value['course_code'] + ' - ' + value['name'] + "</label>");
                    });
                    $('#list_course').append('<button type="submit" style="float: right" id="btn_flash_sale" class="btn">Xác nhận</button>');

                }
            });

        });

 $("#list_flash_sale").submit(function (event) {
            event.preventDefault();
            console.log($("#courseID").val());
            var start_sale = $("input[name='start_sale']").val();
            var end_sale = $("input[name='end_sale']").val();
            var price_sale = $("input[name='price_sale']").val();

            
            start_sale = (start_sale == '')?(Math.round(new Date().getTime()/1000)):start_sale;
            end_sale = (end_sale == '')?(Math.round(new Date().getTime()/1000)):end_sale;
            
            
            $.ajax({
                type: "POST",
                url: $("#list_flash_sale").attr('action'),
                data: $("#list_flash_sale").serialize(),
                success: function (data)
                {
                    alert(data); // show response from the php script.
                }
            });
        });
       

    </script>

</div>
