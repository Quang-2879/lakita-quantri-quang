<!-- bây giờ viết trên local thì 2 file css và js để tạm như link dưới, lúc nào up lên thì chỉnh lại sau -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/css/bootstrap.min.css"  />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/css/datepicker.css" />

<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/jquery-1.10.2.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->


<style>
    .sticky1 {
        position: fixed;
        top: 27px;
    }
    .header1 {
        width: 100%;
        padding: 15px 0;
    }
</style>


<div class="page-content-wrapper">
    <div class="page-content" style="height: 1100px"> 
        <div >
            <div class="col-lg-12">

                <form method="get" class="form-horizontal" role="form" action="BaoCaoVanHanhHocVien/report_student_learn">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Từ ngày : </strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " name="end_date" id='dp1' data-date-format="dd-mm-yyyy" value="<?php if (isset($_GET['start_date'])) echo $_GET['start_date']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Đến ngày : </strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " name="end_date" id='dp2' data-date-format="dd-mm-yyyy" value="<?php if (isset($_GET['end_date'])) echo $_GET['end_date']; ?>" />
                        </div>
                    </div>
                    <input type="text" name="filter" value="filter" style="display:none">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Lọc</button>
                        </div>
                    </div>
                </form>


                <?php
               // echo '<pre>';
              //  print_r($report);
                ?>

                <table class="table table-striped table-bordered table-hover"  >
                    <thead style="background-color: green; color: #FFF">
                    <th>LEVEL</th>
                    <th>Định nghĩa</th>
                    <th>Tổng số</th>
                    </thead>
                    <tbody>
                        <?php foreach ($report as $key => $value) { ?>
                        <tr <?php if($value[2] == 'parent'){echo 'style="font-weight: bold; font-size : 16px"';} ?>>
                            <td>
                                <?php echo $key; ?>
                            </td>
                            <td>
                                <?php echo $value[0]; ?>
                            </td>
                            <td>
                                <?php echo $value[1]; ?>
                            </td>
                        </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>























            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(function () {
        $('#dp1').datepicker();
    });
    $(function () {
        $('#dp2').datepicker();
    });
    $(function () {
        $('#datepicker2').datepicker();
    });
</script>
