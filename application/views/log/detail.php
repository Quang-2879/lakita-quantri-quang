<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Nhật ký website <small>thông tin nhật ký website</small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url();?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>log">
                            Thông tin nhật ký website
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row profile">
            <div class="col-md-12">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom tabbable-full-width">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">

                            <?php if(!empty($this->session->flashdata('success'))){ ?>
                            <div class="note note-success">
                                <h4 class="block">Thành công! Nội dung thao tác</h4>
                                <p>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </p>
                            </div>
                            <?php } ?>

                            <?php if(!empty($this->session->flashdata('error'))){ ?>
                            <div class="note note-danger">
                                <h4 class="block">Lỗi! Nội dung thao tác</h4>
                                <p>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </p>
                            </div>
                            <?php } ?>

                            <div class="row">                           

                                <div class="col-md-3">
                                    <ul class="list-unstyled profile-nav">
                                        <li>
                                            <img width="250" src="<?php if(!empty($customer[0]['admin_thumbnail']))echo base_url().$customer[0]['admin_thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>" class="img-responsive" alt=""/>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-9">                                   
                                    <div class="tabbable tabbable-custom tabbable-custom-profile">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_11">
                                                <div class="portlet-body">
                                                    <table class="table table-striped table-bordered table-advance table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Họ tên
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $customer[0]['admin_name'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $customer[0]['admin_email'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Di động
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $customer[0]['admin_phone'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Địa chỉ
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $customer[0]['admin_address'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Thời gian thao tác
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo date('H:i d/m/Y', $log[0]['log_time']);?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    IP thao tác
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $log[0]['log_ip'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Thao tác
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $log[0]['log_action'];?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--tab-pane-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="<?php echo base_url().'log/index';?>" class="btn yellow"><i class="fa fa-ban"></i> Trở lại</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
