<?php
$arrCode = array(
    '00' => 'Giao dịch thành công',
    '99' => 'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân',
    '01' => 'Lỗi, địa chỉ IP truy cập API của NgânLượng.vn bị từ chối',
    '02' => 'Lỗi, tham số gửi từ merchant tới NgânLượng.vn chưa chính xác (thường sai tên tham số hoặc thiếu tham số)',
    '03' => 'Lỗi, Mã merchant không tồn tại hoặc merchant đang bị khóa kết nối tới NgânLượng.vn',
    '04' => 'Lỗi, Mã checksum không chính xác (lỗi này thường xảy ra khi mật khẩu giao tiếp giữa merchant và NgânLượng.vn không chính xác, hoặc cách sắp xếp các tham số trong biến params không đúng)',
    '05' => 'Tài khoản nhận tiền nạp của merchant không tồn tại',
    '06' => 'Tài khoản nhận tiền nạp của merchant đang bị khóa hoặc bị phong tỏa, không thể thực hiện được giao dịch nạp tiền',
    '07' => 'Thẻ đã được sử dụng ',
    '08' => 'Thẻ bị khóa',
    '09' => 'Thẻ hết hạn sử dụng',
    '10' => 'Thẻ chưa được kích hoạt hoặc không tồn tại',
    '11' => 'Mã thẻ sai định dạng',
    '12' => 'Sai số serial của thẻ',
    '13' => 'Mã thẻ và số serial không khớp',
    '14' => 'Thẻ không tồn tại',
    '15' => 'Thẻ không sử dụng được',
    '16' => 'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
    '17' => 'Hệ thống Telco bị lỗi hoặc quá tải, thẻ chưa bị trừ',
    '18' => 'Hệ thống Telco bị lỗi hoặc quá tải, thẻ có thể bị trừ, cần phối hợp với NgânLượng.vn để tra soát',
    '19' => 'Kết nối từ NgânLượng.vn tới hệ thống Telco bị lỗi, thẻ chưa bị trừ (thường do lỗi kết nối giữa NgânLượng.vn với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)',
    '20' => 'Kết nối tới telco thành công, thẻ bị trừ nhưng chưa cộng tiền trên NgânLượng.vn');
?>

<script type="text/javascript">
    function delete_items()
    {
        var result = confirm('Bạn chắc chắn muốn xoá các bản ghi đã chọn?');
        if (result == false) {
            return false;
        }
        $('form#form-del').submit();
    }
</script>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Danh sách nạp thẻ
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url(); ?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>purchase">
                            Danh sách nạp thẻ
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <?php if (!empty($this->session->flashdata('success'))) { ?>
                    <div class="note note-success">
                        <h4 class="block">Thành công! Nội dung thao tác</h4>
                        <p>
                            <?php echo $this->session->flashdata('success'); ?>
                        </p>
                    </div>
                <?php } ?>

                <?php if (!empty($this->session->flashdata('error'))) { ?>
                    <div class="note note-danger">
                        <h4 class="block">Lỗi! Nội dung thao tác</h4>
                        <p>
                            <?php echo $this->session->flashdata('error'); ?>
                        </p>
                    </div>
                <?php } ?>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box light-grey">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i>  Danh sách nạp thẻ (<?php echo number_format($total); ?> bản ghi)
                        </div>
                    </div>

                    <div class="portlet-body">

                        <div class="table-toolbar">
                            <form action="<?php echo base_url(); ?>lichsugiaodich/search" method="post">
                                <div class="btn-group">

                                    Lọc nâng cao

                                </div>

                                <div class="divPickDate">

                                    <ul class="pickDate">
                                        <li>
                                            <label for="">
                                                <select size="1" class="per_page form-control input-small">
                                                    <?php
                                                    $session_per_page = $this->session->userdata('session_per_page');
                                                    if (isset($session_per_page) && $session_per_page > 0)
                                                        $per_page = $session_per_page;
                                                    else
                                                        $per_page = 10;
                                                    ?>
                                                    <option <?php if ($per_page == 10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                                    <option <?php if ($per_page == 20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                                    <option <?php if ($per_page == 30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                                    <option <?php if ($per_page == 50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                                </select>
                                            </label>
                                        </li>
                                        <li> <span> Ngày bắt đầu: </span> <input type="text" name ="datepicker" id="datepicker" value="<?php if (isset($date1)) echo date('m/d/Y', $date1); ?>">
                                            <input type="hidden" name ="date1" id="date1" value="<?php if (isset($date1)) echo $date1; ?>">
                                        </li>
                                        <li> <span>Ngày kết thúc: </span><input type="text" name = "datepicker2" id="datepicker2" value="<?php if (isset($date2)) echo date('m/d/Y', $date2); ?>">
                                            <input type="hidden" name ="date2" id="date2" value="<?php if (isset($date2)) echo $date2; ?>">
                                        </li>
                                       
                                        <li>
                                            <label><input type="text" name="key_word" <?php if (isset($key_word) && $key_word != 'empty') { ?> value="<?php echo $key_word; ?>" <?php } else { ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>
                                        </li>
                                         <li> <button type="submit"> OK </button></li> 
                                        <div class="clr"></div>
                                    </ul>


                            </form>
                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <!--
        <th class="table-checkbox center">
            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
        </th> -->
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Họ tên
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Điện thoại
                                    </th>

                                    <th>
                                        Số dư tài khoản
                                    </th>
                                    <th>
                                        Ngày giờ nạp thẻ
                                    </th>
                                    <th>
                                        Loại thẻ
                                    </th>
                                    <th>
                                        Mã thẻ
                                    </th>
                                    <th>
                                        Số seri
                                    </th>
                                    <th>
                                        Tình trang thẻ
                                    </th>
                                    <th>
                                        Giá trị thẻ
                                    </th>


<!--                                    <th>
      Thao tác
  </th>-->
                                </tr>
                            </thead>
                            <tbody>
                            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>lichsugiaodich/delete" method="POST" id="form-del">
                                <?php
                                $tong = 0;
                                foreach ($rows as $key => $value) {
                                    $tong+=intval($value['card_amount']);
                                    $user = $this->lib_mod->load_all('student', '', array('id' => $value['user_id']), '', '', '');
                                    ?>
                                    <tr class="odd gradeX">
                                        <!--
        <td class="center">
            <input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id']; ?>"/>
        </td>	-->
                                        <td class="center">
                                            <?php echo $value['id']; ?>
                                        </td>										
                                        <td class="center">
                                            <?php echo $user[0]['name']; ?>
                                        </td>	
                                        <td>
                                            <?php echo $user[0]['email']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $user[0]['phone']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $user[0]['balance']; ?>
                                        </td>
                                        <td>
                                            <?php echo date('H:i:s d/m/Y', $value['ngaynap']); ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['type_card']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['pin_card']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['card_serial']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $arrCode[$value['error_code']]; ?>
                                        </td>
                                        <td class="center">
                                            <?php
                                            $positveNum = intval($value['card_amount']);
                                            if ($positveNum > 0)
                                                echo '<span class="lakita">+' . number_format($value['card_amount'], 0, ",", ".") . ' VNĐ' . '</span>';
                                            else
                                                echo "0 VNĐ";
                                            ?>

                                        </td>

                    <!--                                        <td class="center">
                                        <?php echo number_format(intval($value['price']), 0, ",", ".") . " VNĐ"; ?>
                    </td>-->
                    <!--                                        <td class="center">
                        <a href="<?php echo base_url() . 'purchase/delete/' . $value['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red">
                            <i class="fa fa-trash-o"></i> Xóa
                        </a>
                    </td>-->
                                    </tr>
                                <?php } ?>								
                                </tbody>
                        </table>
                        <div class="red"> Tổng cộng : <?php echo $tong; ?> </div>
                        <div class="table-toolbar">
                            <br>
                            <div class="btn-group">
                                <a class="btn green" href="<?php echo base_url(); ?>student/update"><i class="fa fa-plus"></i> Thêm mới</a>
                                <button class="btn red" onClick="delete_items();">
                                    <i class="fa fa-minus"></i> Xóa chọn
                                </button>

                                <label for="">
                                    <select size="1" class="per_page form-control input-small">
                                        <?php
                                        $session_per_page = $this->session->userdata('session_per_page');
                                        if (isset($session_per_page) && $session_per_page > 0)
                                            $per_page = $session_per_page;
                                        else
                                            $per_page = 10;
                                        ?>
                                        <option <?php if ($per_page == 10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                        <option <?php if ($per_page == 20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                        <option <?php if ($per_page == 30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                        <option <?php if ($per_page == 50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                    </select>						    	
                                </label>
                            </div>

                            <div class="btn-group pull-right">								   
                                <div class="dataTables_paginate paging_bootstrap pull-right">
                                    <?php echo $paging ?>
                                </div>								
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->