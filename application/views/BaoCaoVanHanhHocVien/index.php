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

                    <form method="get" class="form-horizontal" role="form" action="<?php if(isset($filter) && !empty($filter)){echo 'filter';}  else { echo 'BaoCaoVanHanhHocVien/filter';} ?>">
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
                    
                    

                    
                     <table class="table table-striped table-bordered table-hover"  >
                    <thead>
                    <th>
                        ten hoc vien
                    </th>
                    <th>
                        sdt
                    </th>
                    <th>
                        email
                    </th>
                    <th>
                        so bai da hoc
                    </th>
                    </thead>
                    <tbody>
                            <?php
                            foreach ($dem_bai as $khoa72 => $giatri72) {
                                ?>
                            <tr>
                                <?php
                                foreach ($student as $khoa => $giatri) {
                                    if ($giatri72['student_id'] == $giatri['id'] && $giatri72['courseID'] == 72) {
                                       ?>
                                <td>
                                    <?php echo $giatri['name'] ?>
                                </td>
                                <td>
                                    <?php echo $giatri['phone'] ?>
                                </td>
                                <td>
                                    <?php echo $giatri['email'] ?>
                                </td>
                                <td>
                                    <?php echo $giatri72['dem'] ?>
                                </td>
                                       <?php
                                } }
                                ?>
                            </tr>
    <?php
}
?>
                    </tbody>
                </table>
                    
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="header1">
                        <table class="table table-striped table-bordered table-hover">
                        <thead style="background-color: green; color: #FFF;">
                            <th style="width: 500px;">
                                TÍNH TỔNG TẤT CẢ KHÓA HỌC TỪ ĐẦU TỚI THỜI ĐIỂM HIỆN TẠI
                            </th>
                            <th style="width: 180px;">
                                Excel (ĐV :số đơn)
                            </th>
                            <th style="width: 180px;">
                                Kế toán (ĐV :số đơn)
                            </th>
                            <th>
                                Tổng
                            </th>
                        </thead>
                        </table>
                    </div>
                    
<!--                    <table class="table table-striped table-bordered table-hover"  style="margin-top: -35px;">
                       
                        <thead>
                            <th style="width: 500px;">
   
                            </th>
                            <th style="width: 180px;">
                 
                            </th>
                            <th style="width: 180px;">
   
                            </th>
                            <th>

                            </th>
                        </thead>
                     
                        <tbody>
                            <tr>
                                <td>
                                    Tổng số đơn giao hàng
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH kích hoạt ngay sau khi nhận COD
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh đã kích hoạt đến ngày
                                </td>
                                <td>
                                    <?php echo $active_course_E ?>
                                </td>
                                <td>
                                    <?php echo $active_course_KT ?>
                                </td>
                                <td>
                                    <?php echo $active_course_E+$active_course_KT; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học ít nhất 1 video
                                </td>
                                <td>
                                    <?php echo $E1video ?>
                                </td>
                                <td>
                                    <?php echo $KT1video ?>
                                </td>
                                <td>
                                    <?php echo $E1video+$KT1video ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học ít nhất 10 video
                                </td>
                                <td>
                                    <?php echo $E10video ?>
                                </td>
                                <td>
                                    <?php echo $KT10video ?>
                                </td>
                                <td>
                                    <?php echo $E10video+$KT10video ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học toàn bộ video
                                </td>
                                <td>
                                    <?php echo $Eallvideo ?>
                                </td>
                                <td>
                                    <?php echo $KTallvideo ?>
                                </td>
                                <td>
                                    <?php echo $Eallvideo+$KTallvideo ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng nhận hỗ trợ comment (comment + đã trả lời)
                                </td>
                                <td>
                                    <?php echo $replyE ?>
                                </td>
                                <td>
                                    <?php echo $replyKT ?>
                                </td>
                                <td>
                                    <?php echo $replyE+$replyKT ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng nhận hỗ trợ comment (comment + chưa trả lời)
                                </td>
                                <td>
                                    <?php echo $no_replyE ?>
                                </td>
                                <td>
                                    <?php echo $no_replyKT ?>
                                </td>
                                <td>
                                    <?php echo $no_replyE+$no_replyKT ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng viết cảm nhận
                                </td>
                                <td>
                                    <?php echo $rateE ?>
                                </td>
                                <td>
                                    <?php echo $rateKT ?>
                                </td>
                                <td>
                                    <?php echo $rateE+$rateKT ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 5 sao khóa học
                                </td>
                                <td>
                                    <?php echo $voteE5 ?>
                                </td>
                                <td>
                                    <?php echo $voteKT5 ?>
                                </td>
                                <td>
                                    <?php echo $voteE5+$voteKT5 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 4 sao khóa học
                                </td>
                                <td>
                                    <?php echo $voteE4 ?>
                                </td>
                                <td>
                                    <?php echo $voteKT4 ?>
                                </td>
                                <td>
                                    <?php echo $voteE4+$voteKT4 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 3 sao khóa học
                                </td>
                                <td>
                                    <?php echo $voteE3 ?>
                                </td>
                                <td>
                                    <?php echo $voteKT3 ?>
                                </td>
                                <td>
                                    <?php echo $voteE3+$voteKT3 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 2 sao khóa học
                                </td>
                                <td>
                                    <?php echo $voteE2 ?>
                                </td>
                                <td>
                                    <?php echo $voteKT2 ?>
                                </td>
                                <td>
                                    <?php echo $voteE2+$voteKT2 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 1 sao khóa học
                                </td>
                                <td>
                                    <?php echo $voteE1 ?>
                                </td>
                                <td>
                                    <?php echo $voteKT1 ?>
                                </td>
                                <td>
                                    <?php echo $voteE1+$voteKT1 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH mua >=2 khóa
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH mua 1 khóa
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                                <td>
                                    n/a
                                </td>
                            </tr>
                        </tbody>
                    </table>-->
                    
                    
<!--                    <table class="table table-striped table-bordered table-hover"> 
                        <thead style="background-color: green; color: #FFF">
                            <th style="width: 500px;">
                                Các tỷ lệ
                            </th>
                            <th style="width: 180px;">
                                Excel (ĐV :số đơn)
                            </th>
                            <th style="width: 180px;">
                                Kế toán (ĐV :số đơn)
                            </th>
                            <th>
                                Tổng
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Tỉ lệ kích hoạt/ Số lượng COD phát ra
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên comment được hỗ trợ/ Số học viên học
                                </td>
                                <td>
                                    <?php echo number_format(($replyE/$E1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($replyKT/$KT1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($replyE + $replyKT)/($E1video + $KT1video)*100),2).'%' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên comment chưa được hỗ trợ/ Số học viên học
                                </td>
                                <td>
                                    <?php echo number_format(($no_replyE/$E1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($no_replyKT/$KT1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($no_replyE + $no_replyKT)/($E1video + $KT1video)*100),2).'%' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên học/ Tổng số học viên
                                </td>
                                <td>
                                    <?php echo number_format(($E1video/$active_course_E*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($KT1video/$active_course_KT*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($E1video+$KT1video)/($active_course_E+$active_course_KT)*100 ),2).'%' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tỉ lệ học tiếp
                                </td>
                                <td>
                                    <?php echo number_format(($E10video/$E1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($KT10video/$KT1video*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($E10video+$KT10video)/($E1video+$KT1video)*100 ),2).'%' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên viết cảm nhận /Tổng số học viên
                                </td>
                                <td>
                                    <?php echo number_format(($rateE/$active_course_E*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($rateKT/$active_course_KT*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($rateE + $rateKT)/($active_course_E + $active_course_KT)*100),2).'%' ?>
                                </td>
                            </tr>
                            
                            <?php 
                                $voteE = $voteE1 + $voteE2 + $voteE3 + $voteE4 + $voteE5 ;
                                $voteKT = $voteKT1 + $voteKT2 + $voteKT3 + $voteKT4 + $voteKT5 ;
                            ?>
                            
                            <tr>
                                <td>
                                    Số khách đánh giá/ Tổng số học viên
                                </td>
                                <td>
                                    <?php echo number_format(($voteE/$active_course_E*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(($voteKT/$active_course_KT*100),2).'%' ?>
                                </td>
                                <td>
                                    <?php echo number_format(( ($voteE + $voteKT)/($active_course_E + $active_course_KT)*100),2).'%' ?>
                                </td>
                            </tr>
                        </tbody>  
                    </table>-->
                    
                    
                    
                </div>
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
