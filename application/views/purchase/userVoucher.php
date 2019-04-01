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
                    Danh sách mua khóa học
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
                            Danh sách mua khóa học
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
                            <i class="fa fa-users"></i> Danh sách mua khóa học có sử dụng mã voucher (<?php echo number_format($total); ?> bản ghi)
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <form action="<?php echo base_url(); ?>purchase/searchUseVoucher" method="post">
                                <div class="btn-group">
                                    Lọc nâng cao
                                </div>
                                <div class="btn-group">
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
                                    <label for="">
                                        <select size="1" class="form-control" name="method">
                                            <option <?php if (isset($method) && $method == "all") echo 'selected="selected"'; ?> value="all"> Tất cả</option>
                                            <option <?php if (isset($method) && $method == "cod") echo 'selected="selected"'; ?> value="cod">COD</option>
                                            <option  <?php if (isset($method) && $method == "bank") echo 'selected="selected"'; ?>  value="bank">Chuyển khoản ngân hàng</option>
                                            <option  <?php if (isset($method) && $method == "direct") echo 'selected="selected"'; ?>  value="direct">Nộp tiền tại văn phòng Lakita</option>
                                        </select>
                                    </label>

                                </div>

                                <div class="btn-group">
                                    <form action="<?php echo base_url(); ?>student/search" method="post">
                                        <label><input type="text" name="key_word" <?php if (isset($key_word) && $key_word != 'empty') { ?> value="<?php echo $key_word; ?>" <?php } else { ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>
                                        <label>
                                            <button class="btn purple">
                                                <i class="fa fa-search"></i> Tìm
                                            </button>
                                        </label>
                                </div>
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
                                        Hình thức mua
                                    </th>
                                    <th>
                                        Tên
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Khóa học
                                    </th>
                                    <th>
                                        Thành tiền
                                    </th>
                                    <th>
                                        Thời gian mua
                                    </th>

                                    <th>
                                        Người giới thiệu
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>student/delete" method="POST" id="form-del">
                                <?php
                                foreach ($rows as $key => $value) {
                                    if ($value['userID'] > 0) {
                                        $student = $this->lib_mod->load_all('student', '', array('id' => $value['userID']), '', '', '');
                                    }
                                    $merchant = $this->lib_mod->load_all('student', '', array('id' => $value['merchantID']), '', '', '');
                                    $course = $this->lib_mod->load_all('courses', '', array('id' => $value['courseID']), '', '', '');
                                    ?>
                                    <tr class="odd gradeX">
                                        <td class="center">
                                            <?php echo $value['id']; ?>
                                        </td>
                                        <td class="center">
                                            <?php
                                            $method = array(1 => 'COD',
                                                2 => 'Thanh toán trực tiếp lại văn phòng lakita',
                                                3 => 'Chuyển khoản ngân hàng',
                                                4 => 'Thẻ cào',
                                                5 => 'Số dư lakita',
                                                6 => 'Thanh toán trực tuyến ATM',
                                                7 => 'VISA');
                                            echo $method[$value['method']];
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($value['userID'] > 0) echo $student[0]['name']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value['userID'] > 0)
                                                echo $student[0]['email'];
                                            else
                                                echo $value['email'];
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $course[0]['name']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo number_format(intval($value['price']), 0, ",", ".") . " VNĐ"; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo date('F j, Y, g:i a', $value['time']);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $merchant[0]['name']." (".$merchant[0]['email'].")";
                                            ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                                </tbody>
                        </table>

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