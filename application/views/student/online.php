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
                    Học viên online <small>Danh sách</small>
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
                        <a href="<?php echo base_url(); ?>student/online">
                            Danh sách học viên online
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
                            <i class="fa fa-users"></i> Danh sách học viên (<?php echo number_format(@$total); ?> bản ghi)
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Điện thoại
                                    </th>
                                    <th>
                                        IP
                                    </th>
                                    <th>
                                        Thông tin trình duyệt
                                    </th>
                                    <th>
                                        Thời gian
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $key1 => $value1) { ?>
                                    <?php foreach ($student as $key2 => $value2){
                                        if($value1['student_id'] == $value2['id']){?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php echo $value2['email'];?>
                                        </td>
                                        <td>
                                            <?php echo $value2['phone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value1['ip'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value1['info'] ?>
                                        </td>
                                        <td>
                                            <?php echo date('H:i:s d/m/Y', $value1['time']) ?>
                                        </td>
                                    </tr>
                                <?php }}} ?>								
                                </tbody>
                                <tbody>
                                							
                                </tbody>
                        </table>

                      
<div class="btn-group pull-right">								   
                                <div class="dataTables_paginate paging_bootstrap pull-right">
                                    <?php echo @$paging ?>
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