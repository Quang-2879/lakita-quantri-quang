<!-- bây giờ viết trên local thì 2 file css và js để tạm như link dưới, lúc nào up lên thì chỉnh lại sau -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/css/bootstrap.min.css"  />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/css/datepicker.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/jquery-1.10.2.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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
    <div class="page-content"> 
        <div class="col-lg-12">
            <form method="get" class="form-horizontal" role="form" action="report_active_cod">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><strong>Từ ngày : </strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " name="start_date" id='dp1' data-date-format="dd-mm-yyyy" value="<?php if (isset($_GET['start_date'])) echo $_GET['start_date']; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><strong>Đến ngày : </strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " name="end_date" id='dp2' data-date-format="dd-mm-yyyy" value="<?php if (isset($_GET['end_date'])) echo $_GET['end_date']; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Lọc</button>
                    </div>
                </div>
            </form>
<div class="header1">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <th class="name1">
                        Tên
                    </th>
                    <th class="email1">
                        Email
                    </th>
                    <th>
                        Số điện thoại
                    </th>
                    <th>
                        Kích hoạt
                    </th>
                    <th>
                        Khóa
                    </th>
                    <th>
                        Ngày đăng ký
                    </th>
                    <th>
                        Ngày nhận tiền
                    </th>
                    <th>
                        Tỷ lệ hoàn thành
                    </th>
                    </thead>
                </table>
            </div>
            <table class="table_report table table-striped table-bordered table-hover"  >
                <thead>
                <th>
                    Tên
                </th>
                <th>
                    Email
                </th>
                <th>
                    Số điện thoại
                </th>
                <th>
                    Kích hoạt
                </th>
                <th>
                    Khóa
                </th>
                <th>
                    Ngày đăng ký
                </th>
                <th>
                    Ngày nhận tiền
                </th>
                <th>
                    Tỷ lệ hoàn thành
                </th>
                </thead>
                <tbody>
                    <?php
                    foreach ($student as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value['name']; ?>
                            </td>
                            <td>
                                <?php echo $value['email']; ?>
                            </td>
                            <td>
                                <?php echo $value['phone']; ?>
                            </td>
                            <td>
                                <?php echo $value['active']; ?>
                            </td>
                            <td>
                                <?php echo $value['course_code']; ?>
                            </td>
                            <td>
                                <?php echo $value['date_rgt']; ?>
                            </td>
                            <td>
                                <?php echo $value['date']; ?>
                            </td>
                            <td>
                                <?php echo $value['count_learn']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<script>

    var header = document.querySelector('.header1');
    var origOffsetY = header.offsetTop;

    function onScroll(e) {
        window.scrollY >= origOffsetY ? header.classList.add('sticky1') :
                header.classList.remove('sticky1');
    }

    document.addEventListener('scroll', onScroll);

</script>

<script type="text/javascript">
    
    var table_height = $('.table_report').height();
        
    $('.page-content').css('height', table_height + 200);
    
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
