<?php $this->admin_id = $this->session->userdata('admin_id'); ?>
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
                    Học viên <small>Danh sách</small>
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
                        <a href="<?php echo base_url(); ?>student">
                            Danh sách học viên
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
                            <i class="fa fa-users"></i> Danh sách (<?php echo number_format(@$total); ?> bản ghi)
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-toolbar">
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
                                    <select size="1" class="per_page form-control input-small">
                                        <option <?php if ($per_page == 10) echo 'selected="selected"'; ?> value="0">Chưa học bao giờ</option>
                                        <option <?php if ($per_page == 20) echo 'selected="selected"'; ?> value="1">3->6 tháng</option>
                                        <option <?php if ($per_page == 30) echo 'selected="selected"'; ?> value="2">6->12 tháng</option>
                                        <option <?php if ($per_page == 50) echo 'selected="selected"'; ?> value="3">trên 12 tháng</option>
                                    </select>
                                </label>
                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="table-checkbox center">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                    </th>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Ảnh
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
                                        Tham gia
                                    </th>
                                    <th>
                                        Khóa học
                                    </th>
                                    <th>
                                        Hiện
                                    </th>
                                    <th>
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>student/delete" method="POST" id="form-del">
                                <?php foreach ($rows as $key => $value) { ?>
                                    <tr class="odd gradeX">
                                        <td class="center">
                                            <input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id']; ?>"/>
                                        </td>	
                                        <td class="center">
                                            <?php echo $value['id']; ?>
                                        </td>										
                                        <td class="center">
                                            <img style="width:50px!important;" src="<?php
                                            if (!empty($value['thumbnail']))
                                                echo WEBSITE . $value['thumbnail'];
                                            else
                                                echo base_url() . 'styles/assets/img/user-default.png';
                                            ?>" class="img-responsive" alt=""/>
                                        </td>	
                                        <td>
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>">
                                                <?php echo word_limiter($value['name'], 15); ?>
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['email']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['phone']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo date('d/m/Y', $value['createdate']); ?>
                                        </td>
                                        <td class="center">
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>" class="txt-center btn btn-sm green filter-cancel">												
                                                <?php
                                                $count = $this->lib_mod->count('student_courses', array('student_id' => $value['id']));
                                                echo $count . ' khóa học';
                                                ;
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($value['status']) { ?>
                                                <a href="<?php echo base_url() . 'student/status/' . $value['id'] . '/' . $value['status']; ?>" class="txt-center btn btn-sm green filter-cancel curr_segment"><i class="fa fa-check"></i></a>												
                                            <?php } else { ?>
                                                <a href="<?php echo base_url() . 'student/status/' . $value['id'] . '/' . $value['status']; ?>" class="txt-center btn btn-sm yellow filter-cancel curr_segment"><i class="fa fa-times"></i></a>												
                                            <?php } ?>

                                        </td>
                                        <td class="center">
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>" class="btn default btn-xs blue">
                                                <i class="fa fa-eye"></i> Xem
                                            </a>
                                            <?php if ($this->admin_id == 35 || $this->admin_id == 41) { ?>
                                                <a href="<?php echo base_url() . 'student/update/' . $value['id']; ?>" class="btn default btn-xs purple curr_segment">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>

                                                <a href="<?php echo base_url() . 'student/delete/' . $value['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red curr_segment">
                                                    <i class="fa fa-trash-o"></i> Xóa
                                                </a>
                                            <?php } ?>
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
                                    <?php echo @$paging ?>
                                </div>								
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                </form>
                <div class="panel panel-primary">
                    <div class="panel-heading">Cộng tiền hàng loạt
                    </div>
                    <div class="panel-body">

                        <form id="add_balance" action="<?php echo base_url(); ?>student/update_balance" method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Những học viên thuộc khóa :</label>
                                <select class="form-control selectpicker" name="courseID[]" required="required" id="courseID" multiple title="Chọn khóa học">
                                    <?php
                                    foreach ($courses as $key => $cour) {
                                        ?>
                                        <option style="width: 500px" value="<?php echo $cour['id']; ?>"><?php echo $cour['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Số tiền cộng thêm :</label>
                                <input type="number" class="form-control" name="balance_add" required="required" placeholder="nhập số tiền muốn cộng thêm vào tài khoản">
                            </div>
                            <input type="submit" class="btn btn-primary pull-right" value="Xác nhận">
                        </form>


                    </div>
                </div>

            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>
</div>
<input type="hidden" id="page" value="student">
<style>
    .popup-wrapper {
        position: fixed;
        bottom: 0;
        right: 0;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 999999;
        background: url(https://lakita.vn/styles/v2.0/img/modal_overlay.png);
    }
    .popup-wrapper .popup-loading{
        background-color: white;
        opacity: 0.7;
        filter:alpha(opacity=70);
        height: 100%;
        width: 100%;
        z-index: 21;
        position: absolute;
        top: 0px;
        left: 0px;

    }
    .popup-wrapper .popup-loading .loading-container{
        position: relative;
        height: 100%;
        background: url(https://lakita.vn/styles/images/loading.gif) center center no-repeat;
    }
    .popup-wrapper .popup-loading .loading-container span{
        position: absolute;
        top: 58%;
        left: 30%;
        opacity: 1;
        z-index: 1000000000000;
        font-size: 28px;
        font-weight: bold;
    }
</style>
<div id="Popup" class="popup-wrapper" style="display: none;z-index: 99999999999">
    <div class="popup-loading">
        <div class="loading-container">
            <span>
                Hệ thống đang xử lý, vui lòng đợi trong giây lát...
            </span>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">
        $("#add_balance").submit(function (event) {
            $(".popup-wrapper").show();
        });
</script>
<!-- END CONTENT -->